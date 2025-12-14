<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;

/**
 * LandingpageController - Controller untuk halaman utama (homepage)
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Original: Course::with('users')->where('status', 'published')->inRandomOrder()->take(8)->get()
 */
class LandingpageController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display the homepage with random published courses
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // DUMMY DATA: Mengambil 8 kursus acak yang sudah dipublikasikan
        // Original: Course::with('users')->where('status', 'published')->inRandomOrder()->take(8)->get()
        $courses = $this->dummyService->getRandomCourses(8);

        return view('member.home', compact('courses'));
    }
}
