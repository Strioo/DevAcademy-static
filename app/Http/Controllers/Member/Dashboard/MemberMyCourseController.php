<?php

namespace App\Http\Controllers\Member\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * MemberMyCourseController - Controller untuk halaman kelas saya (dashboard member)
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 */
class MemberMyCourseController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display user's purchased courses with progress
     */
    public function index(Request $request) 
    {
        $filter = $request->input('filter');
        $userId = Auth::user()->id;

        // DUMMY DATA: Get user's course list
        $courses = $this->dummyService->getUserCourseList($userId);

        // Apply filter if needed (currently only 'kursus' is handled)
        switch ($filter) {
            case 'kursus':
            default:
                // No additional filtering needed
                break;
        }

        // Add progress information to each course
        $coursesProgress = $courses->map(function ($course) use ($userId) {
            // DUMMY DATA: Get progress for this course
            $progress = $this->dummyService->getUserCourseProgress($userId, $course->id);
            
            $course->total_lesson = $progress['total'];
            $course->lesson_progress = $progress['completed'];
            $course->status = $progress['is_completed'] ? 'Selesai' : 'Belum Selesai';
            
            // Add transactions relation (needed for view check)
            $transaction = $this->dummyService->getTransactionByUserAndCourse($userId, $course->id);
            $course->transactions = $transaction ? collect([$transaction]) : collect([]);

            return $course;
        });

        // DUMMY DATA: Count successful transactions
        $total_course = $this->dummyService->countSuccessfulTransactions($userId);

        return view('member.dashboard.mycourse.view', compact('coursesProgress', 'total_course'));
    }
}
