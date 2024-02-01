@extends('ignitedcms::admin.dashboard.layout')

@section('content')

   <div>
        <div class="gap"></div>
        <div class="gap"></div>
        <div class="small-container" id="app">

         <dark-mode>
         </dark-mode>
    
            @if (session('status'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-4">
                  <div class="text-danger">Failed</div>
                  <div class="text-danger small">
                     {{ session('status') }}
                  </div>
               </div>
               </toast>

            </div>
                
            @endif

            @if (session('errors'))
            <div class="toasts">
               <toast ref="toast">
               <div class="p-4">
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

            <div class="panel mt-2">
                <h2 class="text-center text-dark">Login</h2>
                <form method="POST" action="{{ url('login/validate_login') }}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email" class="text-dark">Email (Admin)</label>
                                <div class="small text-muted text-dark">Enter a valid email address you can access</div>

                                <input type="text" name="email" class="form-control form-dark" placeholder="Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            
                                 <password name="password"></password>
                                @error('password')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror
                            
                            <div class="row v-a mt-4 ">
                                 <button-component variant="primary" class="w-full">
                                    Login
                                 </button-component>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
            <div class="m-b"></div>
            <div class="row">
               <div class="col text-center underline text-dark">
                  <a href="{{ url('login/forgot') }}">Forgot password</a>
               </div>
            </div>
        </div>

    </div>
@endsection
