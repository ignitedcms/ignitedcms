@extends('admin.dashboard.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('admin.sidebar')

        <div class="main-content p-3">

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Profile</div>
            </div>

            @if (session('status'))
                <div class="alert alert-success m-b-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="panel br drop-shadow">
                <form action="{{ url('admin/profile/update') }} " method="POST">
                    @csrf
                    <h3>Profile</h3>
                    <div class="form-group">
                        <label for="title">Full name</label>
                        <div class="small text-muted">Please enter your full name</div>
                        <input class="form-control" name="fullname" value="{{ old('fullname', $data->fullname) }}"
                            placeholder="Start typing" />
                        @error('fullname')
                            <div class="small text-danger">{{ $message }}</div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="title">Email</label>
                        <div class="small text-muted">Current email address, [you cannot change this]</div>
                        <input class="form-control" name="email" value="{{ old('email', $data->email) }}"
                            placeholder="Start typing" readonly />
                    </div>
                    <div class="form-group right">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection
