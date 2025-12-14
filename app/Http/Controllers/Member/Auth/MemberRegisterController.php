<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Services\DummyDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

// model yang di butuhkan
use App\Models\User;

/**
 * MemberRegisterController - Controller untuk registrasi member
 * 
 * DUMMY MODE: Registrasi tidak menyimpan ke database, langsung login dengan user dummy
 */
class MemberRegisterController extends Controller
{
    protected DummyDataService $dummyService;

    public function __construct()
    {
        $this->dummyService = new DummyDataService();
    }

    // Sesi pertama: Form registrasi akun (hanya nama, email, dan password)
    public function index()
    {
        // DUMMY DATA: Get professions from dummy
        $profession = $this->dummyService->getAllProfessions();
        return view('member.auth.register', compact('profession'));
    }

    public function store(Request $requests)
    {
        $requests->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'profession' => 'required',
            'password' => [
                'required',
                'string',
                'min:6',
            ]
        ]);

        // DUMMY MODE: Tidak menyimpan ke database
        // Langsung redirect ke halaman kursus dengan pesan sukses
        Alert::success('Success', 'Registrasi berhasil! (Demo Mode - Silakan login dengan akun dummy)');

        return redirect()->route('member.login');
    }
}
