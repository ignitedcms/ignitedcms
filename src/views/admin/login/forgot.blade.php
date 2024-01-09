@extends('ignitedcms::admin.dashboard.layout')

@section('content')
    <div class="full-screen bg-light-grey">
        <div class="gap"></div>
        <div class="small-container" id="app">
            @if (session('status'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-2">
                  <div class="text-black">Success</div>
                  <div class="text-muted small">
                     {{ session('status') }}
                  </div>
               </div>
               </toast>

            </div>
                
            @endif

            @if (session('errors'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-2">
                  <div class="text-danger">Error</div>
                  <div class="text-danger small">
                     @foreach ($errors->all() as $error)
                        {{ $error }}<br/>
                     @endforeach
                  </div>
               </div>
               </toast>

            </div>
                
            @endif

            <div class="panel m-t-2 br drop-shadow">
                <h2 class="center">Forgot password</h2>
                <form method="POST" action="{{ url('login/forgot') }}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="small text-muted">Enter a valid email address you can access</div>

                                <input type="text" name="email" class="form-control" placeholder="Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            
                            <div class="row v-a m-t">
                                <button class="col btn btn-primary " type="submit">Reset</button>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
            <div class="m-b"></div>
            <div class="row">
               <div class="col center">
                  <a href="{{ url('login') }}">Go back</a></div>
            </div>
        </div>

    </div>
@endsection

