<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');

        // ambil data setting
        $setting = \App\Models\Setting::first();

        // kirim data setting ke semua view
        View::share('setting', $setting);
    }

    public function index()
    {

        $user = auth()->user();
        return view ('profile.index', compact('user'));
    }
}
