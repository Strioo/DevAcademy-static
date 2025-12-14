<?php

namespace App\Http\Controllers\Admin\Sdm;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;

/**
 * AdminMentorController - Controller untuk CRUD mentor
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Create/Update/Delete functionality disabled in dummy mode (returns success message only)
 */
class AdminMentorController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display mentor listing
     */
    public function index(Request $request)
    {
        // DUMMY DATA: Get all mentors with their courses
        $mentors = $this->dummyService->getUsersByRole('mentor');
        
        // Add courses relation to each mentor
        foreach ($mentors as $mentor) {
            $mentor->courses = $this->dummyService->getCoursesByMentor($mentor->id);
        }
        
        return view('admin.sdm.mentor.view', compact('mentors'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        // DUMMY DATA: Get all professions
        $professions = $this->dummyService->getAllProfessions();
        return view('admin.sdm.mentor.create', compact('professions'));
    }

    /**
     * Store mentor (DUMMY MODE - shows success message only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profession' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        // DUMMY MODE: Cannot actually create, just show success message
        return redirect()->route('admin.mentor')->with('success', 'Mentor berhasil ditambahkan (Demo Mode)');
    }

    /**
     * Show edit form
     */
    public function edit(Request $request, $id)
    {
        // DUMMY DATA
        $mentor = $this->dummyService->getUserById((int) $id);
        $professions = $this->dummyService->getAllProfessions();
        
        if (!$mentor) {
            return redirect()->route('admin.mentor')->with('error', 'Mentor tidak ditemukan');
        }
        
        return view('admin.sdm.mentor.update', compact('mentor', 'professions'));
    }

    /**
     * Update mentor (DUMMY MODE - shows success message only)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string|in:mentor,superadmin',
            'profession' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // DUMMY MODE: Cannot actually update, just show success message
        return redirect()->route('admin.mentor')->with('success', 'Mentor berhasil diubah (Demo Mode)');
    }

    /**
     * Delete mentor (DUMMY MODE - shows success message only)
     */
    public function delete(Request $request, $id)
    {
        // DUMMY MODE: Cannot actually delete, just show success message
        return redirect()->route('admin.mentor')->with('success', 'Mentor berhasil dihapus (Demo Mode)');
    }
}
