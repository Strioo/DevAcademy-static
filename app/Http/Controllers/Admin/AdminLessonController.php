<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;

/**
 * AdminLessonController - Controller untuk CRUD lesson dalam chapter
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Create/Update/Delete functionality disabled in dummy mode (returns success message only)
 */
class AdminLessonController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display lessons for a chapter
     */
    public function index($slug_course, $id_chapter)
    {
        // DUMMY DATA: Get lessons by chapter
        $lessons = $this->dummyService->getLessonsByChapter((int) $id_chapter);
        
        return view('admin.courses.lessons.view', compact('lessons', 'slug_course', 'id_chapter'));
    }

    /**
     * Show create form
     */
    public function create($slug_course, $id_chapter)
    {
        return view('admin.courses.lessons.create', compact('slug_course', 'id_chapter'));
    }

    /**
     * Store lesson (DUMMY MODE - shows success message only)
     */
    public function store(Request $request, $slug_course, $id_chapter)
    {
        $request->validate([
            'name' => 'required',
            'link_videos' => 'required|url',
        ]);

        // DUMMY MODE: Cannot actually create, just show success message
        return redirect()->route('admin.lesson', ['slug_course' => $slug_course, 'id_chapter' => $id_chapter])
            ->with('success', 'Lesson berhasil dibuat (Demo Mode)');
    }

    /**
     * Show edit form
     */
    public function edit($slug_course, $id_chapter, $id_lesson)
    {
        // DUMMY DATA: Get lesson by ID
        $lesson = $this->dummyService->getLessonById((int) $id_lesson);
        
        if (!$lesson) {
            return redirect()->route('admin.lesson', ['slug_course' => $slug_course, 'id_chapter' => $id_chapter])
                ->with('error', 'Lesson tidak ditemukan');
        }
        
        return view('admin.courses.lessons.update', compact('lesson', 'slug_course', 'id_chapter'));
    }

    /**
     * Update lesson (DUMMY MODE - shows success message only)
     */
    public function update(Request $request, $slug_course, $id_chapter, $id_lesson)
    {
        $request->validate([
            'name' => 'required',
            'link_videos' => 'required|url',
        ]);

        // DUMMY MODE: Cannot actually update, just show success message
        return redirect()->route('admin.lesson', ['slug_course' => $slug_course, 'id_chapter' => $id_chapter])
            ->with('success', 'Lesson berhasil diubah (Demo Mode)');
    }

    /**
     * Delete lesson (DUMMY MODE - shows success message only)
     */
    public function delete($slug_course, $id_chapter, $id_lesson)
    {
        // DUMMY MODE: Cannot actually delete, just show success message
        return redirect()->route('admin.lesson', [
            'slug_course' => $slug_course,
            'id_chapter' => $id_chapter
        ])->with('success', 'Lesson berhasil dihapus (Demo Mode)');
    }
}
