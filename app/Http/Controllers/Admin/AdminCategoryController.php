<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;

/**
 * AdminCategoryController - Controller untuk CRUD kategori (Admin)
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Create/Update/Delete functionality disabled in dummy mode (returns success message only)
 */
class AdminCategoryController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display category listing
     */
    public function index(Request $request)
    {
        // DUMMY DATA: Get all categories
        $categories = $this->dummyService->getAllCategories();
        return view('admin.category.view', compact('categories'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store category (DUMMY MODE - shows success message only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // DUMMY MODE: Cannot actually create, just show success message
        return redirect()->route('admin.category')->with('success', 'Kategori berhasil ditambahkan (Demo Mode)');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        // DUMMY DATA: Get category by ID
        $category = $this->dummyService->getCategoryById((int) $id);
        
        if (!$category) {
            return redirect()->route('admin.category')->with('error', 'Kategori tidak ditemukan');
        }
        
        return view('admin.category.update', compact('category'));
    }

    /**
     * Update category (DUMMY MODE - shows success message only)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // DUMMY MODE: Cannot actually update, just show success message
        return redirect()->route('admin.category')->with('success', 'Kategori berhasil diubah (Demo Mode)');
    }

    /**
     * Delete category (DUMMY MODE - shows success message only)
     */
    public function delete($id)
    {
        // DUMMY MODE: Cannot actually delete, just show success message
        return redirect()->route('admin.category')->with('success', 'Kategori berhasil dihapus (Demo Mode)');
    }
}
