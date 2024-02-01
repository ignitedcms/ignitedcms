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

            <div class="panel mt-2 ">
                <h2 class="text-center text-dark">Forgot password</h2>
                <form method="POST" action="{{ url('login/forgot') }}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email" class="text-dark">Email</label>
                                <div class="small text-muted text-dark">Enter a valid email address you can access</div>

                                <input type="text" name="email" class="form-control form-dark" placeholder="Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            
                            <div class="row v-a mt-4">
                               <button-component variant="primary" class="w-full">
                                Reset
                               </button-component>
                            </div>

                        </div>
                    </div>

                </form>
            </div>
            <div class="mb"></div>
            <div class="row">
               <div class="col text-center underline text-dark">
                  <a href="{{ url('login') }}">Go back</a></div>
            </div>
        </div>

    </div>
@endsection

