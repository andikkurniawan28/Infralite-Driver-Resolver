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
                <li class="breadcrumb-item active" aria-current="page">
                    Driver
                </li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Drivers</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">+ Add Driver</button>
        </div>

        <div class="alert alert-info" role="alert">
            <strong>Disclaimer:</strong>
            <small class="d-block mt-1">
                Official download links are provided solely for user convenience. <br>
                All copyrights and trademarks belong to their respective manufacturers.
            </small>
        </div>

        <div class="card">
            <div class="card-body">
                <table id="driversTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Device</th>
                            <th>Brand</th>
                            <th>OS / Arch</th>
                            <th>Name</th>
                            {{-- <th>Serial</th>
                            <th>Version</th> --}}
                            {{-- <th>URL</th> --}}
                            {{-- <th>Status</th> --}}
                            {{-- <th>Created</th> --}}
                            <th>Actions</th> {{-- New --}}
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('driver.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Driver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Device</label>
                            <select name="device_id" class="form-select" required>
                                <option disabled selected>-- Choose Device --</option>
                                @foreach ($devices as $device)
                                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Brand</label>
                            <select name="brand_id" class="form-select" required>
                                <option disabled selected>-- Choose Brand --</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Operating System</label>
                            <select name="operation_system_id" class="form-select" required>
                                <option disabled selected>-- Choose OS --</option>
                                @foreach ($operationSystems as $os)
                                    <option value="{{ $os->id }}">{{ $os->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Architecture</label>
                            <select name="architecture" class="form-select" required>
                                <option disabled selected>-- Select --</option>
                                <option value="32bit">32bit</option>
                                <option value="64bit">64bit</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Driver Name</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Intel Chipset Driver" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Version</label>
                            <input type="text" name="version" class="form-control" placeholder="Optional">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Download URL</label>
                            <input type="url" name="download_url" class="form-control" placeholder="https://vendor.com/driver" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="deprecated">Deprecated</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Serial Number</label>
                            <input type="text" name="serial_number" class="form-control" placeholder="Optional">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="3" placeholder="Installation instructions, etc."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Driver</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#driversTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('driver.index') }}",
                order: [[0, 'desc']],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'device_name', name: 'device.name' },
                    { data: 'brand_name', name: 'brand.name' },
                    { data: 'operation_system_name', name: 'operation_system.name' },
                    { data: 'name', name: 'name' },
                    // { data: 'serial_number', name: 'serial_number' },
                    // { data: 'version', name: 'version' },
                    // { data: 'download_url', name: 'download_url', orderable: false, searchable: false },
                    // { data: 'status', name: 'status' },
                    // { data: 'created_at', name: 'created_at' },
                     { data: 'action', name: 'action', orderable: false, searchable: false }, // New
                ]
            });
        });
    </script>
@endsection
