<?php

namespace App\Http\Controllers\Admin\Sdm;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;

/**
 * AdminStudentController - Controller untuk CRUD student
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Create/Update/Delete functionality disabled in dummy mode (returns success message only)
 */
class AdminStudentController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display student listing
     */
    public function index(Request $request)
    {
        // DUMMY DATA: Get all students
        $students = $this->dummyService->getUsersByRole('students');
        return view('admin.sdm.students.view', compact('students'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        // DUMMY DATA: Get all professions
        $professions = $this->dummyService->getAllProfessions();
        return view('admin.sdm.students.create', compact('professions'));
    }

    /**
     * Store student (DUMMY MODE - shows success message only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
            'profession' => 'required|string',
        ]);

        // DUMMY MODE: Cannot actually create, just show success message
        return redirect()->route('admin.students')->with('success', 'Students berhasil ditambahkan (Demo Mode)');
    }

    /**
     * Show edit form
     */
    public function edit(Request $request, $id)
    {
        // DUMMY DATA
        $student = $this->dummyService->getUserById((int) $id);
        $professions = $this->dummyService->getAllProfessions();
        
        if (!$student) {
            return redirect()->route('admin.students')->with('error', 'Student tidak ditemukan');
        }
        
        return view('admin.sdm.students.update', compact('student', 'professions'));
    }

    /**
     * Update student (DUMMY MODE - shows success message only)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8',
            'profession' => 'nullable|string|max:255',
        ]);

        // DUMMY MODE: Cannot actually update, just show success message
        return redirect()->route('admin.students')->with('success', 'Students berhasil diubah (Demo Mode)');
    }

    /**
     * Delete student (DUMMY MODE - shows success message only)
     */
    public function delete($id)
    {
        // DUMMY MODE: Cannot actually delete, just show success message
        return redirect()->route('admin.students')->with('success', 'Students berhasil dihapus (Demo Mode)');
    }
}
