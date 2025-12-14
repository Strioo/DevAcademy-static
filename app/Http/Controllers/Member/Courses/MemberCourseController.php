<?php

namespace App\Http\Controllers\Member\Courses;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

/**
 * MemberCourseController - Controller untuk halaman course member
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 */
class MemberCourseController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display course listing page with category filter
     */
    public function index(Request $request)
    {
        $categoryFilter = $request->input('filter-kelas');

        // DUMMY DATA: Get all categories
        $category = $this->dummyService->getAllCategories();

        // DUMMY DATA: Get courses (filtered by category if specified)
        if ($categoryFilter && $categoryFilter != 'semua') {
            $courses = $this->dummyService->getCoursesByCategory($categoryFilter);
        } else {
            $courses = $this->dummyService->getPublishedCourses();
        }

        return view('member.courses.course', compact('courses', 'category'));
    }

    /**
     * Display course join/detail page
     */
    public function join($slug)
    {
        // DUMMY DATA: Get course by slug
        $courses = $this->dummyService->getCourseBySlug($slug);

        if ($courses) {
            // DUMMY DATA: Get chapters with lessons
            $chapters = $this->dummyService->getChaptersByCourse($courses->id);
            
            // DUMMY DATA: Course tools sudah include di course object
            $coursetools = $courses;

            // Get first lesson if chapters exist
            $lesson = null;
            if ($chapters->isNotEmpty() && $chapters->first()->lessons->isNotEmpty()) {
                $lesson = $chapters->first()->lessons->first();
            }

            // DUMMY MODE: Semua user dianggap sudah memiliki akses (transaction success)
            // Tidak perlu proses pembayaran
            $transaction = (object) [
                'status' => 'success',
                'user_id' => Auth::check() ? Auth::user()->id : 1,
                'course_id' => $courses->id,
            ];

            // DUMMY DATA: Get reviews
            $reviews = $this->dummyService->getReviewsByCourse($courses->id);

            return view('member.courses.join-course', compact('chapters', 'courses', 'lesson', 'transaction', 'coursetools', 'reviews'));
        } else {
            return redirect()->route('pages.error');
        }
    }

    /**
     * Display course play page (video player)
     */
    public function play($slug, $episode)
    {
        // DUMMY DATA: Get course by slug
        $courses = $this->dummyService->getCourseBySlug($slug);
        
        if (!$courses) {
            return redirect()->route('pages.error');
        }

        // DUMMY DATA: Get chapters with lessons
        $chapters = $this->dummyService->getChaptersByCourse($courses->id);

        // DUMMY DATA: Get current lesson by episode slug
        $play = $this->dummyService->getLessonBySlug($episode);
        
        if (!$play) {
            return redirect()->route('pages.error');
        }

        $userId = Auth::user()->id;

        // DUMMY MODE: Semua user dianggap sudah memiliki akses
        // Tidak perlu check transaction

        // DUMMY DATA: Check if user has reviewed
        $checkReview = $this->dummyService->getReviewByUserAndCourse($userId, $courses->id);

        // DUMMY DATA: Get completed episodes
        $epComplete = $this->dummyService->getCompletedEpisodeIds($userId, $courses->id);

        // DUMMY MODE: Langsung akses tanpa pembayaran
        return view('member.courses.play', compact('play', 'chapters', 'slug', 'courses', 'checkReview', 'epComplete'));
    }

    /**
     * Display course detail page
     */
    public function detail($slug)
    {
        // DUMMY DATA: Get course by slug
        $courses = $this->dummyService->getCourseBySlug($slug);
        
        if (!$courses) {
            return redirect()->route('pages.error');
        }

        // DUMMY DATA: Get reviews
        $reviews = $this->dummyService->getReviewsByCourse($courses->id);

        // DUMMY DATA: Get mentor
        $user = $this->dummyService->getUserById($courses->mentor_id);

        // DUMMY DATA: Get chapters
        $chapters = $this->dummyService->getChaptersByCourse($courses->id);

        $userId = Auth::user()->id;

        // DUMMY MODE: Semua user dianggap sudah memiliki akses
        $checkTrx = (object) ['status' => 'success'];

        // DUMMY DATA: Check review
        $checkReview = $this->dummyService->getReviewByUserAndCourse($userId, $courses->id);

        // DUMMY DATA: Course tools already included
        $coursetools = $courses;

        // DUMMY DATA: Get progress
        $progress = $this->dummyService->getUserCourseProgress($userId, $courses->id);
        $compeleteEps = collect(); // Collection for compatibility
        
        // Calculate total lessons
        $totalLesson = $progress['total'];

        // Check if user completed all episodes
        $checkSertifikat = $progress['is_completed'];

        return redirect()->back();
    }

    /**
     * Generate certificate PDF
     */
    public function generateSertifikat($slug)
    {
        // DUMMY DATA: Get course
        $course = $this->dummyService->getCourseBySlug($slug);
        
        if (!$course) {
            return redirect()->back();
        }

        $userId = Auth::user()->id;
        
        // DUMMY DATA: Check if user has course
        $hasCourse = $this->dummyService->userHasCourse($userId, $course->id);
        
        if ($hasCourse) {
            $data = [
                'name' => Auth::user()->name,
                'course' => $course->category . ' : ' . $course->name,
                'date' => \Carbon\Carbon::now()->format('d F Y')
            ];

            $pdf = Pdf::loadView('sertifikat.view', $data)->setPaper('A4', 'landscape');

            return $pdf->download('sertifikat-' . Auth::user()->name . '.pdf');
        }
        
        return redirect()->back();
    }
}
