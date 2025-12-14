<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * MemberTransactionController - Controller untuk halaman transaksi member
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Delete/Cancel functionality disabled in dummy mode (returns success message only)
 */
class MemberTransactionController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display user's transactions list
     */
    public function index(Request $request)
    {
        $status = $request->input('status');
        $userId = Auth::id();

        // DUMMY DATA: Get user transactions with optional status filter
        $transactions = $this->dummyService->getTransactionsByUser($userId, $status);

        return view('member.dashboard.transaction.view', compact('transactions', 'status'));
    }

    /**
     * Show transaction detail
     */
    public function show(Request $request, $transaction_code)
    {
        // DUMMY DATA: Get transaction by code
        $transaction = $this->dummyService->getTransactionByCode($transaction_code);
        
        if ($transaction) {
            if ($transaction->status == 'success' || $transaction->status == 'failed') {
                return view('member.dashboard.transaction.show-payment', compact('transaction'));
            } else {
                Alert::error('Error', 'Maaf Anda Tidak Bisa Akses Detail Transaction, Status Anda Masih Pending!!!');
                return redirect()->route('member.transaction');
            }
        }

        return view('error.page404');
    }

    /**
     * Cancel a transaction (DUMMY MODE - just shows success message)
     */
    public function cancel($id)
    {
        // DUMMY MODE: In dummy data mode, we cannot actually delete data
        // Just show success message for demo purposes
        Alert::success('Success', 'Transaction Berhasil Di Cancel (Demo Mode)');
        return redirect()->route('member.transaction');
    }
}
