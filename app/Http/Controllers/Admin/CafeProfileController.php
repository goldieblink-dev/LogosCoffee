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
        $profile = CafeProfile::first() ?? new CafeProfile();
        return view('admin.profile.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string',
            'contact' => 'nullable|string|max:50',
            'logo'    => 'nullable|image|max:2048',
        ]);

        $profile = CafeProfile::first() ?? new CafeProfile();

        $data = $request->only('name', 'address', 'contact');

        // Handle logo upload
        if ($request->hasFile('logo')) {
            if ($profile->logo) {
                Storage::disk('public')->delete($profile->logo);
            }
            $data['logo'] = $request->file('logo')->store('cafe', 'public');
        }

        // Handle opening hours
        $days = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        $openingHours = [];
        foreach ($days as $day) {
            $key = strtolower($day);
            $openingHours[$day] = [
                'open'   => $request->input("hours_open_{$key}"),
                'close'  => $request->input("hours_close_{$key}"),
                'closed' => $request->has("hours_closed_{$key}"),
            ];
        }
        $data['opening_hours'] = $openingHours;

        $profile->fill($data);
        $profile->save();

        return back()->with('success', 'Profil cafe berhasil diperbarui.');
    }
}
