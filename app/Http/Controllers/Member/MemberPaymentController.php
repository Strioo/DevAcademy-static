<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

/**
 * MemberPaymentController - Controller untuk halaman pembayaran member
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Payment processing (Midtrans) disabled in dummy mode
 *       Store/checkout will simulate success for demo purposes
 */
class MemberPaymentController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display payment page
     */
    public function index(Request $request)
    {
        $courseId = $request->query('course_id');

        // DUMMY DATA: Get all discounts
        $discount = $this->dummyService->getAllDiscounts();

        // DUMMY DATA: Get course by ID
        $course = $this->dummyService->getCourseById((int) $courseId);

        return view('member.payment', [
            'course' => $course,
            'discount' => $discount,
        ]);
    }

    /**
     * Store payment (DUMMY MODE - simulates success)
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'nullable|integer',
            'price' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'termsCheck' => 'required|accepted',
        ]);

        // DUMMY DATA: Get course
        $course = $this->dummyService->getCourseById((int) $request->input('course_id'));
        
        if (!$course) {
            Alert::error('error', 'Kursus tidak ditemukan');
            return redirect()->back();
        }

        $user = Auth::user();
        $transaction_code = 'DEVACADEMY-' . strtoupper(Str::random(10));

        // Calculate price
        $price = 0;
        if ($request->price > 0) {
            $price = $course->price + 5000; // Admin fee
        }

        // Apply discount if provided
        $diskon = 0;
        $code_discount = '';
        if ($request->input('diskon')) {
            $discountData = $this->dummyService->getDiscountByRate((int) $request->input('diskon'));
            if ($discountData) {
                $diskon = ($request->input('diskon') / 100) * $price;
                $price -= $diskon;
                $code_discount = $request->input('diskon');

                if ($price < 0) {
                    Alert::error('error', 'Pembayaran Tidak Valid');
                    return redirect()->back()->withErrors(['price' => 'Harga Tidak Valid']);
                }
            }
        }

        // DUMMY MODE: Simulate success for demo
        // In real implementation, this would process via Midtrans
        
        if ($price == 0) {
            // Free course - immediate success
            Alert::success('success', 'Kelas Berhasil Dibeli (Demo Mode - Gratis)');
            return redirect()->route('member.course.join', $course->slug);
        } else {
            // Paid course - simulate success in demo mode
            Alert::success('success', 'Pembayaran Berhasil! (Demo Mode - Midtrans Disabled)');
            return redirect()->route('member.course.join', $course->slug);
        }
    }

    /**
     * Midtrans webhook checkout (DUMMY MODE - disabled)
     */
    public function checkout()
    {
        // DUMMY MODE: Midtrans webhook is disabled
        // This would normally handle payment confirmation from Midtrans
        
        return response()->json([
            'status' => 'demo_mode',
            'message' => 'Midtrans webhook disabled in dummy mode'
        ]);
    }

    /**
     * View transaction detail
     */
    public function viewTransaction(Request $request, $transaction_code)
    {
        // DUMMY DATA: Get transaction by code
        $transaction = $this->dummyService->getTransactionByCode($transaction_code);
        
        if (!$transaction) {
            return redirect()->route('pages.error');
        }

        return view('member.dashboard.transaction.show-payment', compact('transaction'));
    }
}
