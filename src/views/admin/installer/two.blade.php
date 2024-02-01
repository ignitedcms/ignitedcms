@extends('ignitedcms::admin.layout')

@section('content')
    <div class="v-screen h-screen bg-light-gray">
        <div class="gap"></div>
        <div class="small-container" id="app">
            <div class="panel">
                <form method="POST" action="{{ url('installer/validate_form') }}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email (Admin)</label>
                                <div class="small text-muted">Enter a valid email address you can access</div>

                                <input type="text" name="email"
                                    class="form-control @error('email') form-error @enderror" placeholder="Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="small text-muted">Your password [needed to access the dashboard]</div>
                                <input type="password" name="password"
                                    class="form-control @error('password') form-error @enderror" placeholder="password"
                                    value="">
                                @error('password')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row v-a m-t">
                                <button class="col btn btn-primary " type="submit">Create admin user</button>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
