@extends('admin.layout')

@section('content')
    <div class="full-screen bg-light-grey">
        <div class="gap"></div>
        <div class="small-container" id="app">
            @if (session('status'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('final'))
                <div class="alert alert-success">
                    {{ session('final') }}
                </div>
            @endif
            <div class="panel m-t-2 br drop-shadow">
                <h2 class="center">Login</h2>
                <form method="POST" action="{{ url('login/validate_login') }}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email (Admin)</label>
                                <div class="small text-muted">Enter a valid email address you can access</div>

                                <input type="text" name="email" class="form-control" placeholder="Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="small text-muted">Your password [needed to access the dashboard]</div>
                                <input type="password" name="password" class="form-control" placeholder="password"
                                    value="">
                                @error('password')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row v-a m-t">
                                <button class="col btn btn-primary " type="submit">Login</button>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
