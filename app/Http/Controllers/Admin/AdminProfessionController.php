<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;

/**
 * AdminProfessionController - Controller untuk CRUD profesi
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Create/Update/Delete functionality disabled in dummy mode (returns success message only)
 */
class AdminProfessionController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display profession listing
     */
    public function index(Request $request)
    {
        // DUMMY DATA: Get all professions
        $professions = $this->dummyService->getAllProfessions();
        return view('admin.profession.view', compact('professions'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.profession.create');
    }

    /**
     * Store profession (DUMMY MODE - shows success message only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // DUMMY MODE: Cannot actually create, just show success message
        return redirect()->route('admin.profession')->with('success', 'Profesi berhasil dibuat (Demo Mode)');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        // DUMMY DATA: Get profession by ID
        $profession = $this->dummyService->getProfessionById((int) $id);
        
        if (!$profession) {
            return redirect()->route('admin.profession')->with('error', 'Profesi tidak ditemukan');
        }
        
        return view('admin.profession.update', compact('profession'));
    }

    /**
     * Update profession (DUMMY MODE - shows success message only)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        // DUMMY MODE: Cannot actually update, just show success message
        return redirect()->route('admin.profession')->with('success', 'Profesi berhasil diubah (Demo Mode)');
    }

    /**
     * Delete profession (DUMMY MODE - shows success message only)
     */
    public function delete($id)
    {
        // DUMMY MODE: Cannot actually delete, just show success message
        return redirect()->route('admin.profession')->with('success', 'Profesi berhasil dihapus (Demo Mode)');
    }
}
