<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function buy(Request $request, Product $product): RedirectResponse
    {
        abort_if(! $product->is_active || $product->stock < 1, 422, 'Produk tidak tersedia.');

        $user = $request->user();

        $order = Order::create([
            'order_code' => 'ORD-'.now()->format('YmdHis').'-'.Str::upper(Str::random(6)),
            'user_id' => $user->id,
            'product_id' => $product->id,
            'amount' => $product->price,
            'status' => 'pending',
        ]);

        $paymentData = $this->createMidtransTransaction($order);

        if ($paymentData !== null) {
            $order->update([
                'midtrans_transaction_id' => (string) ($paymentData['transaction_id'] ?? ''),
                'midtrans_snap_token' => (string) ($paymentData['token'] ?? ''),
                'midtrans_redirect_url' => (string) ($paymentData['redirect_url'] ?? ''),
                'meta' => $paymentData,
            ]);

            if (! empty($paymentData['redirect_url'])) {
                return redirect()->away($paymentData['redirect_url']);
            }
        }

        return redirect()->away('https://midtrans.com/id/product/snap');
    }

    private function createMidtransTransaction(Order $order): ?array
    {
        $serverKey = (string) config('services.midtrans.server_key');

        if ($serverKey === '') {
            return null;
        }

        $baseUrl = config('services.midtrans.is_production')
            ? 'https://app.midtrans.com'
            : 'https://app.sandbox.midtrans.com';

        $payload = [
            'transaction_details' => [
                'order_id' => $order->order_code,
                'gross_amount' => $order->amount,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->user->phone,
            ],
            'item_details' => [
                [
                    'id' => $order->product->id,
                    'price' => $order->amount,
                    'quantity' => 1,
                    'name' => Str::limit($order->product->title, 45, ''),
                ],
            ],
        ];

        try {
            $response = Http::withBasicAuth($serverKey, '')
                ->acceptJson()
                ->post($baseUrl.'/snap/v1/transactions', $payload);

            if (! $response->successful()) {
                return null;
            }

            return $response->json();
        } catch (\Throwable $exception) {
            report($exception);

            return null;
        }
    }
}
