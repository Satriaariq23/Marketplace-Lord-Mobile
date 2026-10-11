<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::latest()->paginate(15);

        return view('admin.dashboard', compact('products'));
    }

    public function create(): View
    {
        return view('admin.product-form', [
            'product' => new Product(),
            'isEdit' => false,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);
        $validated['category'] = 'Lord Mobile';

        $validated['slug'] = Str::slug($validated['title']).'-'.Str::lower(Str::random(5));
        $validated['image_path'] = $this->storeMedia($request, 'image', 'products/images');
        $validated['video_path'] = $this->storeMedia($request, 'video', 'products/videos');

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        return view('admin.product-form', [
            'product' => $product,
            'isEdit' => true,
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $this->validateData($request);
        $validated['category'] = 'Lord Mobile';

        if ($request->hasFile('image')) {
            $this->deleteFileIfExists($product->image_path);
            $validated['image_path'] = $this->storeMedia($request, 'image', 'products/images');
        }

        if ($request->hasFile('video')) {
            $this->deleteFileIfExists($product->video_path);
            $validated['video_path'] = $this->storeMedia($request, 'video', 'products/videos');
        }

        if ($product->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']).'-'.Str::lower(Str::random(5));
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->deleteFileIfExists($product->image_path);
        $this->deleteFileIfExists($product->video_path);

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'castle_level' => ['nullable', 'integer', 'min:1', 'max:25'],
            'might' => ['nullable', 'integer', 'min:0'],
            'troop_t4' => ['nullable', 'integer', 'min:0'],
            'troop_t5' => ['nullable', 'integer', 'min:0'],
            'kingdom' => ['nullable', 'string', 'max:50'],
            'account_role' => ['nullable', 'string', 'max:50'],
            'bind_status' => ['nullable', 'string', 'max:50'],
            'migration_ticket_ready' => ['nullable', 'boolean'],
            'hero_grade' => ['nullable', 'string', 'max:120'],
            'familiar_grade' => ['nullable', 'string', 'max:120'],
            'research_summary' => ['nullable', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:1000'],
            'stock' => ['required', 'integer', 'min:0'],
            'whatsapp_number' => ['nullable', 'string', 'max:30'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:3072'],
            'video' => ['nullable', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:51200'],
        ]);
    }

    private function storeMedia(Request $request, string $key, string $path): ?string
    {
        if (! $request->hasFile($key)) {
            return null;
        }

        return $request->file($key)->store($path, 'public');
    }

    private function deleteFileIfExists(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
