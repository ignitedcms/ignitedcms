@extends('ignitedcms::admin.payments.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')

        <div class="main-content p-3">
            
           <drawer title="Help">
              <div class="p-3">
                 <h4>Payment</h4>
                 <p class="text-muted">For more help please see</p>
                 <a href="https://www.ignitedcms.com/documentation/payment" target="_blank">Payment</a>
              </div>
           </drawer>

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Payment gateway</div>
            </div>

            @if (session('status'))
                <div class="alert alert-success m-b-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="alert alert-success">
               <div class="text-black">Information</div>
               <div class="small text-muted">
                  Easily configure a payment gateway.
                  <br>
                   Please note, if you are using Stripe 
                   you will need to install Laravel Cashier
                  via composer.
               </div>
            </div>
            <div class="m-b-3"></div>

            <div class="panel br drop-shadow">

               <div class="row">
                  <div class="col no-margin">
                     <h4>Payments</h4>
                  </div>
               </div>
               
               

            </div>

        </div>

    </div>
@endsection


