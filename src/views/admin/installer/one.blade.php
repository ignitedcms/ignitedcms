@extends('ignitedcms::admin.layout')

@section('content')
    <div class="v-screen h-screen bg-light-gray">
        <div class="gap"></div>
        <div class="small-container" id="app" v-cloak>
            <div class="panel fade-in-bottom">
                <div class="row">
                    <div class="col-12">
                        <h3>Terms and conditions</h3>
                        MIT License <br /> <br />

                        Copyright 2024, IgnitedCMS (c) <br /> <br />

                        Permission is hereby granted, free of charge, to any person obtaining
                        a copy of this software and associated documentation files ("IgnitedCMS"),
                        to deal in the Software without restriction, including without limitation
                        the rights to use, copy, modify, merge, publish, distribute, sublicense,
                        and/or sell copies of the Software, and to permit persons to whom
                        the Software is furnished to do so, subject to the following conditions:
                        <br /> <br />

                        The above copyright notice and this permission notice shall be included
                        in all copies or substantial portions of the Software.
                        <br /><br />

                        THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
                        EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
                        OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
                        NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
                        HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
                        WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
                        FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
                        OTHER DEALINGS IN THE SOFTWARE.
                        <div class="form-group">
                            <a href="{{ url('installer/db') }}">
                                 <button-component variant="primary" class="w-full">
                                       Next
                                 </button-component>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="gap"></div>
    </div>
@endsection
