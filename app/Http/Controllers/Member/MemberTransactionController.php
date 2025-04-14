<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\detailTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Transaction;



class MemberTransactionController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');

        $transactions = Transaction::with([
            'course' => function ($query) {
                $query->select('id', 'name', 'cover', 'price');
            }
        ])
            ->where('user_id', Auth::id())
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('member.dashboard.transaction.view', compact('transactions', 'status'));
    }

    public function show(Request $requests, $transaction_code)
    {
        $transaction = Transaction::with('course')->where('transaction_code', $transaction_code)->first();
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



    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        Alert::success('Success', 'Transaction Berhasil Di Cancel');
        return redirect()->route('member.transaction');
    }
}
