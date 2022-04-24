@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (Auth::user()->role == "admin")
                        <div class="alert alert-success" role="alert">
                            <a href="{{ route('admin.index') }}">Menu Admin</a>
                        </div>
                    @else 
                        <div class="alert alert-success" role="alert">
                            <a href="{{ route('employee.index') }}">Menu Employee</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
