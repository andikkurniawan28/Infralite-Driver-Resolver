<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('device.index', compact('devices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:devices,name',
        ]);

        Device::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Device added successfully.');
    }

    public function update(Request $request, $id)
    {
        $device = Device::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:devices,name,' . $device->id,
        ]);

        $device->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Device updated successfully.');
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->back()->with('success', 'Device deleted successfully.');
    }
}
