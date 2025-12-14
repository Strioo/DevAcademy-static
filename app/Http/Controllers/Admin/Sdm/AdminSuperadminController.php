<?php

namespace App\Http\Controllers\Admin\Sdm;

use App\Http\Controllers\Controller;
use App\Services\DummyDataService;
use Illuminate\Http\Request;

/**
 * AdminSuperadminController - Controller untuk view superadmin list
 * 
 * REFACTORED: Menggunakan DummyDataService sebagai pengganti Eloquent
 */
class AdminSuperadminController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    /**
     * Display superadmin listing
     */
    public function index(Request $request)
    {
        // DUMMY DATA: Get all superadmins
        $superadmins = $this->dummyService->getUsersByRole('superadmin');
        return view('admin.sdm.superadmin.view', compact('superadmins'));
    }
}
