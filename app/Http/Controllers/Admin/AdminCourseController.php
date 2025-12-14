<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * AdminCourseController - Controller untuk CRUD kursus (Admin/Mentor)
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Create/Update/Delete functionality disabled in dummy mode (returns success message only)
 */
class AdminCourseController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display course listing
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // DUMMY DATA: Get courses based on role
        if ($user && $user->role === 'superadmin') {
            $courses = $this->dummyService->getAllCourses();
        } else {
            // For mentor, filter by mentor_id
            $courses = $this->dummyService->getCoursesByMentor($user->id ?? 2);
        }
        
        return view('admin.courses.view', compact('courses'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        // DUMMY DATA
        $categories = $this->dummyService->getAllCategories();
        $tools = $this->dummyService->getAllTools();
        return view('admin.courses.create', compact('categories', 'tools'));
    }

    /**
     * Store course (DUMMY MODE - shows success message only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:5048',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer|min:0',
            'level' => 'required|in:beginner,intermediate,expert',
            'sort_description' => 'required|string|max:500',
            'long_description' => 'required|string',
            'link_resources' => 'nullable|url',
            'link_groups' => 'nullable|url',
            'tools' => 'required|array',
        ]);

        // DUMMY MODE: Cannot actually create, just show success message
        return redirect()->route('admin.course')->with('success', 'Kursus berhasil dibuat (Demo Mode)');
    }

    /**
     * Show edit form
     */
    public function edit(Request $request, $id)
    {
        // DUMMY DATA
        $category = $this->dummyService->getAllCategories();
        $course = $this->dummyService->getCourseById((int) $id);
        $tools = $this->dummyService->getAllTools();
        
        if (!$course) {
            return redirect()->route('admin.course')->with('error', 'Kursus tidak ditemukan');
        }
        
        // coursetool is the course with tools relation loaded (already included in dummy data)
        $coursetool = $course;
        
        return view('admin.courses.update', compact('course', 'category', 'coursetool', 'tools'));
    }

    /**
     * Update course (DUMMY MODE - shows success message only)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer|min:0',
            'level' => 'required|in:beginner,intermediate,expert',
            'sort_description' => 'required|string|max:500',
            'long_description' => 'required|string',
            'link_resources' => 'nullable|url',
            'link_groups' => 'nullable|url',
            'tools' => 'required|array',
        ]);

        // DUMMY MODE: Cannot actually update, just show success message
        return redirect()->route('admin.course')->with('success', 'Kursus berhasil diubah! (Demo Mode)');
    }

    /**
     * Delete course (DUMMY MODE - shows success message only)
     */
    public function delete(Request $request, $id)
    {
        // DUMMY MODE: Cannot actually delete, just show success message
        return redirect()->route('admin.course')->with('success', 'Kursus berhasil dihapus (Demo Mode)');
    }
}
