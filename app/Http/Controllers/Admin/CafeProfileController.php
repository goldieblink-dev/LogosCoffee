<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CafeProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CafeProfileController extends Controller
{
    public function show()
    {
        $profile = CafeProfile::firstOrCreate([], [
            'name' => 'Logos Coffe',
            'opening_hours' => [
                'Senin - Jumat' => '08:00 - 22:00',
                'Sabtu - Minggu' => '09:00 - 23:00'
            ]
        ]);
        return view('admin.profile.show', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = CafeProfile::first();

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'contact' => 'nullable|string',
            'logo' => 'nullable|image|max:1024',
        ]);

        $data = $request->except('logo', 'opening_hours');

        // Handle Opening Hours
        if ($request->has('days') && $request->has('times')) {
            $hours = [];
            foreach ($request->days as $index => $day) {
                if ($day && $request->times[$index]) {
                    $hours[$day] = $request->times[$index];
                }
            }
            $data['opening_hours'] = $hours;
        }

        if ($request->hasFile('logo')) {
            if ($profile->logo) {
                Storage::disk('public')->delete($profile->logo);
            }
            $data['logo'] = $request->file('logo')->store('cafe', 'public');
        }

        $profile->update($data);

        return back()->with('success', 'Profil cafe berhasil diperbarui.');
    }
}