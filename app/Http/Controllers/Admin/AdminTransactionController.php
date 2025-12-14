<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;

/**
 * AdminTransactionController - Controller untuk manajemen transaksi
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Accept/Cancel functionality disabled in dummy mode (returns success message only)
 */
class AdminTransactionController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display transaction listing
     */
    public function index(Request $request)
    {
        // DUMMY DATA: Get all transactions (sorted with pending first)
        $transactions = $this->dummyService->getAllTransactions();
        
        // Sort: pending first, then by created_at desc
        $transactions = $transactions->sortBy(function($item) {
            return [
                $item->status === 'pending' ? 0 : 1,
                -strtotime($item->created_at ?? '2024-01-01')
            ];
        })->values();
        
        return view('admin.transaction.view', compact('transactions'));
    }

    /**
     * Accept transaction (DUMMY MODE - shows success message only)
     */
    public function accept($id)
    {
        // DUMMY MODE: Cannot actually update, just show success message
        return redirect()->route('admin.transaction')->with('success', 'Transaksi Berhasil Di Selesaikan (Demo Mode)');
    }

    /**
     * Cancel transaction (DUMMY MODE - shows success message only)
     */
    public function cancel($id)
    {
        // DUMMY MODE: Cannot actually update, just show success message
        return redirect()->route('admin.transaction')->with('success', 'Transaksi Berhasil Di Batalkan (Demo Mode)');
    }
}
