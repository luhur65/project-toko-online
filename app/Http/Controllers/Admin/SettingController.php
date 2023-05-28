<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function index()
    {
        $setting = \App\Models\Setting::first();
        return \view('admin.setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'website' => 'required',
            'tagline' => 'required',
            'deskripsi' => 'required',
            'keyword' => 'required',
            'author' => 'required',
            'logo' => 'required',
            'email' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
            'youtube' => 'required',
            'twitter' => 'required',
            'whatsapp' => 'required',
            'googlemaps' => 'required',
        ]);

        $setting = \App\Models\Setting::first();

        // ambil gambar logo
        $logo = $request->file('logo');
    
        // jika ada gambar yang diupload
        if($logo) {
            // ambil nama file
            $logo_name = \time() . Str::random(8) . '.' . $logo->getClientOriginalExtension();
            // upload ke folder public\img
            $logo->storeAs('/storage/logo', $logo_name);
        } else {
            // jika tidak ada gambar yang diupload
            $logo_name = $setting->logo;
        }

        $setting->website = $request->website;
        $setting->tagline = $request->tagline;
        $setting->deskripsi = $request->deskripsi;
        $setting->keyword = $request->keyword;
        $setting->author = $request->author;
        $setting->logo = $logo_name;
        $setting->email = $request->email;
        $setting->telepon = $request->telepon;
        $setting->alamat = $request->alamat;
        $setting->facebook = $request->facebook;
        $setting->instagram = $request->instagram;
        $setting->youtube = $request->youtube;
        $setting->twitter = $request->twitter;
        $setting->whatsapp = $request->whatsapp;
        $setting->googlemaps = $request->googlemaps;

        $setting->save();

        return redirect()->back()->with('success', 'Setting berhasil diupdate');
    }
}
