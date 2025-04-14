<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


use App\Models\Transaction;
use App\Models\Course;
use App\Models\MyListCourse;
use App\Models\DiskonKelas;
use App\Models\detailTransactions;
use App\Models\Discount;

class MemberPaymentController extends Controller
{
    public function index(Request $request)
    {
        $courseId = $request->query('course_id');

        $discount = Discount::all();

        $course = Course::find($courseId);
        return view('member.payment', [
            'course' => $course,
            'discount' => $discount,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'nullable|exists:tbl_courses,id',
            'price' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'termsCheck' => 'required|accepted',
        ]);

        $course = Course::find($request->input('course_id'));
        $user = Auth::user();
        $transaction_code = 'DEVACADEMY-' . strtoupper(Str::random(10));

        $price = 0;
        $code_discount = '';

        if ($request->price > 0) {
            $price = $course->price + 5000;
        }

        $diskon = 0;

        if ($request->input('diskon') && $validDiskon = Discount::where('rate_discount', $request->input('diskon'))->first()) {
            $diskon = ($request->input('diskon') / 100) * $price;
            $price -= $diskon;

            $code_discount = $request->input('diskon');

            if ($price < 0) {
                Alert::error('error', 'Pembayaran Tidak Valid');
                return redirect()->back()->withErrors(['price' => 'Harga Tidak Valid']);
            }
        }

        if ($price == 0) $status = 'success';
        else $status = 'pending';

        $transaction_code = 'DEVACADEMY-' . strtoupper(Str::random(10));

        // Cek apakah sudah ada transaksi pending
        $checkTransaction = Transaction::where('course_id', $course->id)
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        $dataTransaction = $course ? [
            'user_id' => $user->id,
            'course_id' => $course->id,
            'transaction_code' => $transaction_code,
            'code_discount' => $code_discount,
            'price' => $price,
            'status' => $status,
            'snap_token' => '',
        ] : [];

        $myListCourse = $course ? [
            'user_id' => $user->id,
            'course_id' => $course->id,
        ] : [];

        if (!isset($checkTransaction)) {
            if ($status == 'success') {

                Transaction::create($dataTransaction);
                MyListCourse::create($myListCourse);

                Alert::success('success', 'Kelas Berhasil Dibeli');
                return redirect()->route('member.course.join', $course->slug);
            } else {
                // Lakukan pemrosesan Midtrans jika belum sukses
                \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                \Midtrans\Config::$isProduction = env('MIDTRANS_PRODUCTION');
                \Midtrans\Config::$isSanitized = true;
                \Midtrans\Config::$is3ds = true;

                $params = [
                    'transaction_details' => [
                        'order_id' => $transaction_code,
                        'gross_amount' => intval($price),
                    ],
                    'customer_details' => [
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                    'enabled_payments' => [
                        'bank_transfer',
                        'va_bank',
                        'qris',
                        'gopay',
                        'shopeepay'
                    ],
                    'callbacks' => [
                        'finish' => route('member.transaction'),
                        'error' => route('member.transaction'),
                    ],
                ];


                $createdTransactionMidtrans = \Midtrans\Snap::createTransaction($params);
                $midtransRedirectUrl = $createdTransactionMidtrans->redirect_url;

                $dataTransaction['snap_token'] = $createdTransactionMidtrans->token;
                Transaction::create($dataTransaction);
                return redirect($midtransRedirectUrl);
            }
        } else {
            if ($status == 'success') {

                Transaction::create($dataTransaction);
                MyListCourse::create($myListCourse);

                Alert::success('success', 'Kelas Berhasil Dibeli');
                return redirect()->route('member.course.join', $course->slug);
            } else {
                $url = env('MIDTRANS_PRODUCTION')
                    ? "https://app.midtrans.com/snap/v4/redirection/{$checkTransaction->snap_token}"
                    : "https://app.sandbox.midtrans.com/snap/v4/redirection/{$checkTransaction->snap_token}";

                return redirect($url);
            }
            // Redirect ke transaksi pending sebelumnya jika ada
        }
    }

    public function checkout()
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_PRODUCTION');
        $notif = new \Midtrans\Notification();

        $transactionStatus = $notif->transaction_status;
        $type = $notif->payment_type;
        $transaction_code = $notif->order_id;
        $fraudStatus = $notif->fraud_status;

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $status = 'success';
            }
        } elseif ($transactionStatus == 'settlement') {
            $status = 'success';
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $status = 'failed';
        } elseif ($transactionStatus == 'pending') {
            $status = 'pending';
        }

        $transaction = Transaction::where('transaction_code', $transaction_code)->first();
        $transaction->update(['status' => $status]);

        if ($status == 'success') {
            try {

                if ($transaction->course_id != null) {
                    MyListCourse::create([
                        'user_id' => $transaction->user_id,
                        'course_id' => $transaction->course_id, // Pastikan ini valid
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Failed to create MyListCourse: ' . $e->getMessage());
            }
        }
    }

    public function viewTransaction(Request $requests, $transaction_code)
    {
        $transaction = Transaction::where('transaction_code', $transaction_code)->first();

        $url = "https://app.sandbox.midtrans.com/snap/v4/redirection/$transaction->snap_token";
        if (env('MIDTRANS_PRODUCTION') === true) {
            $url = "https://app.midtrans.com/snap/v4/redirection/$transaction->snap_token";
        }

        return redirect()->to($url);
    }
}
