<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function edit(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $profile = $user->profile ?? new Profile();

        return view('profil.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'headline' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        /** @var \App\Models\User $user */
        $user = $request->user();
        $current = $user->profile;

        if ($request->hasFile('photo')) {
            if ($current && $current->photo) {
                Storage::disk('public')->delete($current->photo);
            }
            $data['photo'] = $request->file('photo')->store('profil', 'public');
        } else {
            unset($data['photo']);
        }

        Profile::updateOrCreate(['user_id' => $user->id], $data);

        return back()->with('success', 'Profil berhasil disimpan.');
    }
}