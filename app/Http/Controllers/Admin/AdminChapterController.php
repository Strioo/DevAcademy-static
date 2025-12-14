<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;

/**
 * AdminChapterController - Controller untuk CRUD chapter dalam kursus
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Create/Update/Delete functionality disabled in dummy mode (returns success message only)
 */
class AdminChapterController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display chapters for a course
     */
    public function index($slug_course)
    {
        // DUMMY DATA: Get course by slug
        $course = $this->dummyService->getCourseBySlug($slug_course);
        
        if (!$course) {
            return redirect()->route('admin.course')->with('error', 'Kursus tidak ditemukan');
        }
        
        // Chapters are already loaded in course relation
        $chapters = $course->chapters ?? collect([]);
        
        return view('admin.courses.chapters.view', compact('course', 'chapters'));
    }

    /**
     * Show create form
     */
    public function create($slug_course)
    {
        $course = $this->dummyService->getCourseBySlug($slug_course);
        
        if (!$course) {
            return redirect()->route('admin.course')->with('error', 'Kursus tidak ditemukan');
        }
        
        return view('admin.courses.chapters.create', compact('course'));
    }

    /**
     * Store chapter (DUMMY MODE - shows success message only)
     */
    public function store(Request $request, $slug_course)
    {
        $request->validate(['name' => 'required|string|max:255']);

        // DUMMY MODE: Cannot actually create, just show success message
        return redirect()->route('admin.chapter', $slug_course)->with('success', 'Chapter berhasil dibuat (Demo Mode)');
    }

    /**
     * Show edit form
     */
    public function edit($slug_course, $id)
    {
        $course = $this->dummyService->getCourseBySlug($slug_course);
        
        if (!$course) {
            return redirect()->route('admin.course')->with('error', 'Kursus tidak ditemukan');
        }
        
        // Find chapter in course chapters
        $chapter = $this->dummyService->getChapterById((int) $id);
        
        if (!$chapter) {
            return redirect()->route('admin.chapter', $slug_course)->with('error', 'Chapter tidak ditemukan');
        }
        
        return view('admin.courses.chapters.update', compact('course', 'chapter'));
    }

    /**
     * Update chapter (DUMMY MODE - shows success message only)
     */
    public function update(Request $request, $slug_course, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);

        // DUMMY MODE: Cannot actually update, just show success message
        return redirect()->route('admin.chapter', $slug_course)->with('success', 'Chapter berhasil diubah (Demo Mode)');
    }

    /**
     * Delete chapter (DUMMY MODE - shows success message only)
     */
    public function delete($slug_course, $id)
    {
        // DUMMY MODE: Cannot actually delete, just show success message
        return redirect()->route('admin.chapter', $slug_course)->with('success', 'Chapter berhasil dihapus (Demo Mode)');
    }
}
