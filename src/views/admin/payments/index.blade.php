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
               
               <tabs>
               <tab-item title="Payment options">
                  <div class="">
                     <div class="form-group">
                        <div class="p-2 bg-white b br">
                           <div class="row">
                              <div class="col no-margin">
                                 <div class="row">
                                    <div class="col no-margin">
                                       <div class="text-black">Enable Stripe</div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col no-margin">
                                       <div class="small text-muted">
                                          Please install Laravel cashier first
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col no-margin right">
                                 <div>
                                    <label for="title"></label>
                                    <div class="m-b"></div>
                                    <div>
                                       <div class="m-b"></div>
                                       <switch-ios name="stripe" value=""></switch-ios>
                                       
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="p-2 bg-white b br">
                           <div class="row">
                              <div class="col no-margin">
                                 <div class="row">
                                    <div class="col no-margin">
                                       <div class="text-black">Enable Paypal</div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col no-margin">
                                       <div class="small text-muted">
                                          Paypal settings
                                      </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col no-margin right">
                                 <div>
                                    <label for="title"></label>
                                    <div class="m-b"></div>
                                    <div>
                                       <div class="m-b"></div>
                                          <switch-ios name="paypal" value=""></switch-ios>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group right">
                        <button type="submit" class="btn btn-primary">Save</button>
                     </div>

                  </div>
               </tab-item>
               <tab-item title="Paypal settings">
                  <div class="p">
                     <div class="form-group">
                        <tooltip text="To test your paypal settings you can use the sandbox mode">
                        <div>
                           <input type="checkbox" name="" class="form-check-input">
                           <label for="the label">Sandbox mode</label>
                        </div>
                        </tooltip>
                        

                     </div>
                     <div class="form-group">
                        <label for="title">Live paypal email address</label>
                        <div class="m-b"></div>
                        <input class="form-control" 
                              type="text"
                              name="email_address" 
                              placeholder="" />
                     </div>
                     <div class="form-group">
                        <label for="title">Live merchant Id</label>
                        <div class="m-b"></div>
                        <input class="form-control" 
                              type="text"
                              name="merchant_id" 
                              placeholder="" />
                     </div>
                     <div class="form-group">
                        <label for="title">Live client Id</label>
                        <div class="m-b"></div>
                        <input class="form-control" 
                              type="text"
                              name="client_id" 
                              placeholder="" />
                     </div>
                     <div class="form-group">
                        <label for="title">Live secret key</label>
                        <div class="m-b"></div>
                        <input class="form-control" 
                              type="text"
                              name="secret_key" 
                              placeholder="" />
                     </div>
                     <div class="form-group right">
                        <button type="submit" class="btn btn-primary">Save</button>
                     </div>
                  </div>
               </tab-item>
               <tab-item title="Stripe settings">
                  <div class="p">
                     <div class="form-group">
                        <tooltip text="To test your Stripe settings you can use the 'test' mode">
                        <div>
                           <input type="checkbox" name="" class="form-check-input">
                           <label for="the label">Test mode</label>
                        </div>
                        </tooltip>


                     </div>
                     <div class="form-group">
                        <label for="title">Live publishable key</label>
                        <div class="small text-muted">Only values starting with 'pk_live' will be saved</div>
                        <div class="m-b"></div>
                        <input class="form-control" 
                               type="text"
                               name="publishable_key" 
                               placeholder="" />
                     </div>
                     <div class="form-group">
                        <label for="title">Live secret key</label>
                        <div class="small text-muted">Only values starting with 'sk_live' or 'rk_live' will be saved</div>
                        <div class="m-b"></div>
                        <input class="form-control" 
                               type="text"
                               name="secret_key" 
                               placeholder="" />
                     </div>
                     <div class="form-group">
                        <modal button-title="Webhook endpoint" modal-header="Endpoint">
                        <div class="p-3">
                           <p>
                           Add the following pre-generated webhook endpoint 
                             <span class="text-black" class="font-weight:500;">'https://siteurl'</span>
                              to your <a href="#">Stripe account settings</a> (if there isn't one already)
                              This will enable you to receive notifications on the charge statuses.
                           </p>
                        </div>
                        </modal>
                     </div>
                     <div class="form-group">
                        <label for="title">Webhook secret</label>
                        <div class="small text-muted">Get your webhook signing secret from the webhooks section in your Stripe account</div>
                        <div class="m-b"></div>
                        <input class="form-control" 
                               type="text"
                               name="webhook_secret" 
                               placeholder="" />
                     </div>

                     
                     
                     <div class="form-group right">
                        <button type="submit" class="btn btn-primary">Save</button>
                     </div>
                  </div>
               </tab-item>
               </tabs>


            </div>

            <div class="gap"></div>
        </div>

    </div>
@endsection


