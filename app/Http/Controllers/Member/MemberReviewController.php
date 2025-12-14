<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

/**
 * MemberReviewController - Controller untuk halaman review member
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Store functionality disabled in dummy mode (returns success message only)
 */
class MemberReviewController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display review form for a course
     */
    public function index($slug)
    {
        // DUMMY DATA: Get course by slug
        $course = $this->dummyService->getCourseBySlug($slug);

        if (!$course) {
            return redirect()->route('pages.error');
        }

        $userId = Auth::user()->id;

        // DUMMY DATA: Check if user has purchased the course
        $checkTrx = $this->dummyService->getTransactionByUserAndCourse($userId, $course->id);

        if ($checkTrx && $checkTrx->status === 'success') {
            return view('member.review', compact('course'));
        } else {
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }
    }

    /**
     * Store a review (DUMMY MODE - shows success message only)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|integer',
            'note' => 'nullable|string|min:1|max:100',
        ]);

        // DUMMY DATA: Get course
        $course = $this->dummyService->getCourseById((int) $validated['course_id']);

        if (!$course) {
            Alert::error('error', 'Kursus tidak ditemukan');
            return redirect()->back();
        }

        $userId = Auth::user()->id;

        // DUMMY DATA: Check if user already reviewed
        $checkReview = $this->dummyService->getReviewByUserAndCourse($userId, $course->id);

        if ($checkReview) {
            Alert::error('error', 'Anda Sudah Melakukan Review.');
            return redirect()->route('member.course.detail', ['slug' => $course->slug])
                ->with('error', 'Review gagal ditambahkan.');
        } else {
            // DUMMY MODE: Cannot actually store review, just show success message
            Alert::success('success', 'Review berhasil ditambahkan (Demo Mode).');
            return redirect()->route('member.course.join', ['slug' => $course->slug]);
        }
    }

    /**
     * Display review form for ebook
     */
    public function ebookFormReview($slug)
    {
        // DUMMY MODE: Ebook functionality not implemented
        Alert::error('error', 'Fitur eBook tidak tersedia dalam mode demo');
        return redirect()->back();
    }

    /**
     * Store ebook review (DUMMY MODE - disabled)
     */
    public function storeReviewEbook(Request $request)
    {
        // DUMMY MODE: Ebook functionality not implemented
        Alert::error('error', 'Fitur eBook tidak tersedia dalam mode demo');
        return redirect()->back();
    }
}
