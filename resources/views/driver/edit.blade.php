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
                    Edit Info
                </li>
            </ol>
        </nav>

        <h4>Edit Driver</h4>

        <form action="{{ route('driver.update', $driver->id) }}" method="POST">
            @csrf
            @method('PUT')

            @include('driver._form', ['submit' => 'Update'])
        </form>
    </div>
@endsection
