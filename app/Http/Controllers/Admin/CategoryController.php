<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Category list (+inline create form).
     */
    public function index(): View
    {
        $categories = Category::withCount('products')->orderBy('sort_order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store a new category.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        $data['slug'] = $this->uniqueSlug($data['slug']);

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', "ক্যাটাগরি '{$data['name']}' তৈরি হয়েছে!");
    }

    /**
     * Edit form.
     */
    public function edit(int $id): View
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update a category.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $data = $this->validatedData($request);
        $data['slug'] = $data['slug'] ?: Str::slug($data['name']);
        if ($data['slug'] !== $category->slug) {
            $data['slug'] = $this->uniqueSlug($data['slug'], $category->id);
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', "ক্যাটাগরি '{$category->name}' আপডেট হয়েছে!");
    }

    /**
     * Delete a category (products keep existing with NULL category).
     */
    public function destroy(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $name = $category->name;
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', "ক্যাটাগরি '{$name}' ডিলিট করা হয়েছে।");
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:120',
            'slug' => 'nullable|string|max:120',
            'type' => 'required|in:game_topup,giftcard_buy,giftcard_sell,subscription,software',
            'icon' => 'nullable|string|max:20',
            'description' => 'nullable|string|max:500',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]) + ['is_featured' => $request->boolean('is_featured', true)];
    }

    private function uniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = $slug;
        $counter = 2;
        while (Category::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $counter;
            $counter++;
        }
        return $slug;
    }
}
