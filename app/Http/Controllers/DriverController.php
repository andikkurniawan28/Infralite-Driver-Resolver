<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Device;
use App\Models\Driver;
use App\Models\OperationSystem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        $devices = Device::all();
        $brands = Brand::all();
        $operationSystems = OperationSystem::all();
        if ($request->ajax()) {
            $data = Driver::with(['device', 'brand', 'operation_system'])->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('device_name', fn($row) => $row->device->name ?? '-')
                ->addColumn('brand_name', fn($row) => $row->brand->name ?? '-')
                ->addColumn('operation_system_name', function ($row) {
                    $os = $row->operation_system->name ?? '-';
                    $arch = $row->architecture ?? '';
                    return trim("$os / $arch");
                })
                // ->addColumn('download_url', fn($row) => '<a class="btn btn-sm" href="' . $row->download_url . '" target="_blank">Download</a>')
                ->addColumn('action', function ($row) {
                    $info = '<a href="' . route('driver.show', $row->id) . '" class="btn btn-sm btn-info me-1">Info</a>';
                    $edit = '<a href="' . route('driver.edit', $row->id) . '" class="btn btn-sm btn-warning me-1">Edit</a>';
                    $download = '<a class="btn btn-sm" href="' . $row->download_url . '" target="_blank">Download</a>';
                    $delete = '
                        <form action="' . route('driver.destroy', $row->id) . '" method="POST" class="d-inline" onsubmit="return confirm(\'Delete this driver?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>';
                    // return $info . $edit . $delete;
                    return $info . $edit . $download;
                })
                ->rawColumns(['download_url', 'action'])
                ->make(true);
        }

        return view('driver.index', compact('devices', 'brands', 'operationSystems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id'           => 'required|exists:devices,id',
            'brand_id'            => 'required|exists:brands,id',
            'operation_system_id' => 'required|exists:operation_systems,id',
            'architecture'        => 'required|in:32bit,64bit',
            'name'                => 'required|string|max:255|unique:drivers,name',
            'version'             => 'nullable|string|max:100',
            'serial_number'       => 'nullable|string|max:255',
            'download_url'        => 'required|url|max:500',
            'status'              => 'required|in:active,inactive,deprecated',
            'notes'               => 'nullable|string',
        ]);

        Driver::create($validated);

        return redirect()->route('driver.index')->with('success', 'Driver successfully added.');
    }

    public function show(Driver $driver)
    {
        return view('driver.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        $devices = Device::all();
        $brands = Brand::all();
        $operationSystems = OperationSystem::all();
        return view('driver.edit', compact('driver', 'devices', 'brands', 'operationSystems'));
    }

    public function update(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'device_id'           => 'required|exists:devices,id',
            'brand_id'            => 'required|exists:brands,id',
            'operation_system_id' => 'required|exists:operation_systems,id',
            'architecture'        => 'required|in:32bit,64bit',
            'name'                => 'required|string|max:255|unique:drivers,name,' . $driver->id,
            'version'             => 'nullable|string|max:100',
            'serial_number'       => 'nullable|string|max:255',
            'download_url'        => 'required|url|max:500',
            'status'              => 'required|in:active,inactive,deprecated',
            'notes'               => 'nullable|string',
        ]);

        $driver->update($validated);

        return redirect()->route('driver.index')->with('success', 'Driver successfully updated.');
    }

}
