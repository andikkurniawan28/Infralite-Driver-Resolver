@extends('template.master')

@section('content')
    <div class="container py-1">

        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white rounded px-3 py-2 shadow-sm">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}">
                        <i class="bi bi-house-door"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('driver.index') }}">
                        Driver
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Driver Info
                </li>
            </ol>
        </nav>

        <h4>Driver Info</h4>

        <a href="{{ route('driver.index') }}" class="btn btn-secondary btn-sm mb-3">← Back</a>

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td>{{ $driver->name }}</td>
            </tr>
            <tr>
                <th>Device</th>
                <td>{{ $driver->device->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Brand</th>
                <td>{{ $driver->brand->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>OS</th>
                <td>{{ $driver->operation_system->name ?? '-' }} / {{ $driver->architecture }}</td>
            </tr>
            <tr>
                <th>Version</th>
                <td>{{ $driver->version ?? '-' }}</td>
            </tr>
            <tr>
                <th>Serial</th>
                <td>{{ $driver->serial_number ?? '-' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($driver->status) }}</td>
            </tr>
            <tr>
                <th>Download</th>
                <td><a href="{{ $driver->download_url }}" target="_blank">{{ $driver->download_url }}</a></td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>{{ $driver->notes ?? '-' }}</td>
            </tr>
        </table>
    </div>
@endsection
