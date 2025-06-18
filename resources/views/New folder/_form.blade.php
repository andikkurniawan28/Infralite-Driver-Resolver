<div class="row mb-3">
    <div class="col-md-6">
        <label>Device</label>
        <select name="device_id" class="form-select">
            @foreach ($devices as $d)
                <option value="{{ $d->id }}" {{ old('device_id', $driver->device_id ?? '') == $d->id ? 'selected' : '' }}>
                    {{ $d->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label>Brand</label>
        <select name="brand_id" class="form-select">
            @foreach ($brands as $b)
                <option value="{{ $b->id }}" {{ old('brand_id', $driver->brand_id ?? '') == $b->id ? 'selected' : '' }}>
                    {{ $b->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label>OS</label>
        <select name="operation_system_id" class="form-select">
            @foreach ($operationSystems as $os)
                <option value="{{ $os->id }}" {{ old('operation_system_id', $driver->operation_system_id ?? '') == $os->id ? 'selected' : '' }}>
                    {{ $os->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label>Architecture</label>
        <select name="architecture" class="form-select">
            <option value="32bit" {{ old('architecture', $driver->architecture ?? '') == '32bit' ? 'selected' : '' }}>32bit</option>
            <option value="64bit" {{ old('architecture', $driver->architecture ?? '') == '64bit' ? 'selected' : '' }}>64bit</option>
        </select>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label>Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $driver->name ?? '') }}">
    </div>
    <div class="col-md-6">
        <label>Version</label>
        <input type="text" name="version" class="form-control" value="{{ old('version', $driver->version ?? '') }}">
    </div>
</div>

<div class="mb-3">
    <label>Serial Number</label>
    <input type="text" name="serial_number" class="form-control" value="{{ old('serial_number', $driver->serial_number ?? '') }}">
</div>

<div class="mb-3">
    <label>Download URL</label>
    <input type="url" name="download_url" class="form-control" value="{{ old('download_url', $driver->download_url ?? '') }}">
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-select">
        @foreach(['active', 'inactive', 'deprecated'] as $status)
            <option value="{{ $status }}" {{ old('status', $driver->status ?? '') == $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Notes</label>
    <textarea name="notes" class="form-control">{{ old('notes', $driver->notes ?? '') }}</textarea>
</div>

<button class="btn btn-success">{{ $submit ?? 'Save' }}</button>
<a href="{{ route('driver.index') }}" class="btn btn-secondary">Cancel</a>
