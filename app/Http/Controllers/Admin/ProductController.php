<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPackage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Product list with search & category filter.
     */
    public function index(Request $request): View
    {
        $query = Product::with(['category', 'packages'])->orderBy('sort_order');

        if ($request->filled('q')) {
            $q = trim($request->query('q'));
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('slug', 'like', "%{$q}%");
            });
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->query('category_id'));
        }

        $products = $query->paginate(15)->withQueryString();
        $categories = Category::orderBy('sort_order')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Create form.
     */
    public function create(): View
    {
        $categories = Category::orderBy('sort_order')->get();
        return view('admin.products.form', [
            'product' => new Product(),
            'categories' => $categories,
            'isEdit' => false,
        ]);
    }

    /**
     * Store a new product (+packages).
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['slug'] = trim((string) ($data['slug'] ?? '')) ?: Str::slug($data['title']);
        $data['slug'] = $this->uniqueSlug($data['slug']);
        $data['input_fields_schema'] = $this->parseSchema($request->input('input_fields_schema_raw'));

        $product = Product::create($data);
        $this->syncPackages($product, $request);

        return redirect()->route('admin.products.index')
            ->with('success', "প্রোডাক্ট '{$product->title}' তৈরি হয়েছে!");
    }

    /**
     * Edit form.
     */
    public function edit(int $id): View
    {
        $product = Product::with('packages')->findOrFail($id);
        $categories = Category::orderBy('sort_order')->get();

        return view('admin.products.form', [
            'product' => $product,
            'categories' => $categories,
            'isEdit' => true,
        ]);
    }

    /**
     * Update an existing product (+packages).
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $data = $this->validatedData($request);
        $data['slug'] = trim((string) ($data['slug'] ?? '')) ?: Str::slug($data['title']);
        if ($data['slug'] !== $product->slug) {
            $data['slug'] = $this->uniqueSlug($data['slug'], $product->id);
        }
        $data['input_fields_schema'] = $this->parseSchema($request->input('input_fields_schema_raw'));

        $product->update($data);
        $this->syncPackages($product, $request);

        return redirect()->route('admin.products.index')
            ->with('success', "প্রোডাক্ট '{$product->title}' আপডেট হয়েছে!");
    }

    /**
     * Quick toggle active/inactive.
     */
    public function toggle(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();

        return back()->with('success', $product->is_active
            ? "'{$product->title}' এখন সাইটে দৃশ্যমান।"
            : "'{$product->title}' সাইট থেকে লুকানো হয়েছে।");
    }

    /**
     * Delete product (cascades packages via FK).
     */
    public function destroy(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $title = $product->title;
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', "প্রোডাক্ট '{$title}' ডিলিট করা হয়েছে।");
    }

    /**
     * Shared validation rules.
     */
    private function validatedData(Request $request): array
    {
        return $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'title' => 'required|string|max:190',
            'slug' => 'nullable|string|max:190',
            'tag_badge' => 'nullable|string|max:60',
            'short_desc' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:190',
            'brand_color' => 'nullable|string|max:20',
            'currency_symbol' => 'nullable|string|max:5',
            'base_price_bdt' => 'required|numeric|min:0',
            'base_price_usd' => 'nullable|numeric|min:0',
            'rate_percentage' => 'nullable|numeric|min:0|max:1',
            'stock_type' => 'required|in:manual_topup,auto_code,account_login',
            'instructions' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]) + [
            'is_active' => $request->boolean('is_active'),
            'is_featured' => $request->boolean('is_featured'),
            'base_price_usd' => (float) $request->input('base_price_usd', 0),
            'rate_percentage' => (float) $request->input('rate_percentage', 0.85),
            'brand_color' => $request->input('brand_color') ?: '#10B981',
            'currency_symbol' => $request->input('currency_symbol') ?: '৳',
        ];
    }

    /**
     * Parse the JSON textarea of custom input fields.
     */
    private function parseSchema(?string $raw): ?array
    {
        $raw = trim((string) $raw);
        if ($raw === '') {
            return null;
        }

        $decoded = json_decode($raw, true);
        return json_last_error() === JSON_ERROR_NONE ? $decoded : null;
    }

    /**
     * Replace all packages from the dynamic rows in the form.
     */
    private function syncPackages(Product $product, Request $request): void
    {
        $names = $request->input('pkg_name', []);
        $amounts = $request->input('pkg_amount', []);
        $prices = $request->input('pkg_price', []);
        $originals = $request->input('pkg_original', []);
        $badges = $request->input('pkg_badge', []);

        $product->packages()->delete();

        foreach ($names as $i => $name) {
            $name = trim((string) $name);
            if ($name === '') {
                continue;
            }

            ProductPackage::create([
                'product_id' => $product->id,
                'name' => $name,
                'amount_val' => (float) ($amounts[$i] ?? 0),
                'price_bdt' => (float) ($prices[$i] ?? 0),
                'original_price_bdt' => ($originals[$i] ?? '') !== '' ? (float) $originals[$i] : null,
                'badge' => trim((string) ($badges[$i] ?? '')) ?: null,
                'sort_order' => $i + 1,
            ]);
        }
    }

    /**
     * Generate a slug not used by another product.
     */
    private function uniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = $slug;
        $counter = 2;
        while (Product::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $counter;
            $counter++;
        }
        return $slug;
    }
}
