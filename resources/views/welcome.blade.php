@extends('template.master')

@section('breadcrumb')

@endsection

@section('content')
    <main class="container py-1">

        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white rounded px-3 py-2 shadow-sm">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('welcome') }}">
                        <i class="bi bi-house-door"></i>
                    </a>
                </li>
                {{-- <li class="breadcrumb-item active" aria-current="page">
                    Database Connection
                </li> --}}
            </ol>
        </nav>

        <div class="row g-4">

            <!-- User -->
            <div class="col-sm-6 col-md-4">
                <div class="card card-menu h-100">
                    <div class="card-body text-center">
                        <div class="card-icon"><i class="bi bi-person-gear"></i></div>
                        <h5 class="card-title">User</h5>
                        <p class="card-text">Manage application users.</p>
                        <a href="{{ route('user.index') }}" class="btn btn-dark">Manage</a>
                    </div>
                </div>
            </div>

            <!-- Device -->
            <div class="col-sm-6 col-md-4">
                <div class="card card-menu h-100">
                    <div class="card-body text-center">
                        <div class="card-icon"><i class="bi bi-cpu-fill"></i></div>
                        <h5 class="card-title">Device</h5>
                        <p class="card-text">Manage supported devices.</p>
                        <a href="{{ route('device.index') }}" class="btn btn-dark">Manage</a>
                    </div>
                </div>
            </div>

            <!-- Brand -->
            <div class="col-sm-6 col-md-4">
                <div class="card card-menu h-100">
                    <div class="card-body text-center">
                        <div class="card-icon"><i class="bi bi-tags-fill"></i></div>
                        <h5 class="card-title">Brand</h5>
                        <p class="card-text">Manage device brands.</p>
                        <a href="{{ route('brand.index') }}" class="btn btn-dark">Manage</a>
                    </div>
                </div>
            </div>

        </div>

    </main>
@endsection
