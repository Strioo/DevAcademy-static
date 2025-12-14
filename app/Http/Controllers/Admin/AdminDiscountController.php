<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;

/**
 * AdminDiscountController - Controller untuk CRUD diskon
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Create/Update/Delete functionality disabled in dummy mode (returns success message only)
 */
class AdminDiscountController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display discount listing
     */
    public function index()
    {
        // DUMMY DATA: Get all discounts
        $discounts = $this->dummyService->getAllDiscounts();
        return view('admin.discount.view', compact('discounts'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store discount (DUMMY MODE - shows success message only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_discount' => 'required',
            'rate_discount' => 'required|numeric|min:0|max:100',
        ]);

        // DUMMY MODE: Cannot actually create, just show success message
        return redirect()->route('admin.discount')->with('success', 'Diskon berhasil ditambahkan (Demo Mode)');
    }

    /**
     * Show edit form
     */
    public function edit(Request $request, $id)
    {
        // DUMMY DATA: Get discount by ID
        $discount = $this->dummyService->getDiscountById((int) $id);
        
        if (!$discount) {
            return redirect()->route('admin.discount')->with('error', 'Diskon tidak ditemukan');
        }
        
        return view('admin.discount.update', compact('discount'));
    }

    /**
     * Update discount (DUMMY MODE - shows success message only)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code_discount' => 'required',
            'rate_discount' => 'required|numeric|min:0|max:100',
        ]);

        // DUMMY MODE: Cannot actually update, just show success message
        return redirect()->route('admin.discount')->with('success', 'Diskon berhasil diubah (Demo Mode)');
    }

    /**
     * Delete discount (DUMMY MODE - shows success message only)
     */
    public function delete(Request $request, $id)
    {
        // DUMMY MODE: Cannot actually delete, just show success message
        return redirect()->route('admin.discount')->with('success', 'Diskon berhasil dihapus (Demo Mode)');
    }
}
