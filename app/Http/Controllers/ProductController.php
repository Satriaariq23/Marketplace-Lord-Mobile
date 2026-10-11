<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show(Product $product): View
    {
        abort_if(! $product->is_active, 404);

        $whatsappNumber = $product->whatsapp_number ?: config('services.whatsapp.number');
        $whatsappMessage = rawurlencode('Halo admin, saya tertarik dengan akun: '.$product->title);
        $whatsappLink = $whatsappNumber ? 'https://wa.me/'.preg_replace('/\D+/', '', $whatsappNumber).'?text='.$whatsappMessage : null;

        return view('product-show', [
            'product' => $product,
            'whatsappLink' => $whatsappLink,
        ]);
    }
}
