<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;

/**
 * AdminToolsController - Controller untuk CRUD tools/teknologi
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 * Note: Create/Update/Delete functionality disabled in dummy mode (returns success message only)
 */
class AdminToolsController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display tools listing
     */
    public function index(Request $request)
    {
        // DUMMY DATA: Get all tools
        $tools = $this->dummyService->getAllTools();
        return view('admin.tools.view', compact('tools'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.tools.create');
    }

    /**
     * Store tool (DUMMY MODE - shows success message only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_tools' => 'required',
            'logo_tools' => 'required|image|mimes:jpeg,png,jpg',
            'link_tools' => 'required|url',
        ]);

        // DUMMY MODE: Cannot actually create, just show success message
        return redirect()->route('admin.tools')->with('success', 'Tools Berhasil Di Buat (Demo Mode)');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        // DUMMY DATA: Get tool by ID
        $tools = $this->dummyService->getToolById((int) $id);
        
        if (!$tools) {
            return redirect()->route('admin.tools')->with('error', 'Tools tidak ditemukan');
        }
        
        return view('admin.tools.update', compact('tools'));
    }

    /**
     * Update tool (DUMMY MODE - shows success message only)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_tools' => 'required',
            'link_tools' => 'required|url',
            'logo_tools' => 'sometimes|image|mimes:jpeg,png,jpg',
        ]);

        // DUMMY MODE: Cannot actually update, just show success message
        return redirect()->route('admin.tools')->with('success', 'Tools Berhasil Diubah (Demo Mode)');
    }

    /**
     * Delete tool (DUMMY MODE - shows success message only)
     */
    public function delete($id)
    {
        // DUMMY MODE: Cannot actually delete, just show success message
        return redirect()->route('admin.tools')->with('success', 'Tools berhasil dihapus (Demo Mode)');
    }
}
