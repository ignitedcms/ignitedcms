@extends('ignitedcms::admin.sections.layout')
@section('content')
    <div class="full-screen" id="app">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3">
            <form action='{{ url("admin/section/update/$id") }}' method="POST">
                @csrf

                <div class="breadcrumb m-b-3">
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">
                        <a href="{{ url('admin/section') }}">Sections</a>
                    </div>
                    <div class="breadcrumb-item">Edit section</div>
                </div>
                <!--main part for section styles -->
                <div class="panel br drop-shadow">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h3>Sections</h3>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <div class="small text-muted">Disabled</div>
                                <input class="form-control" name="name" value="{{ $data2->name }}" placeholder="test"
                                    readonly />
                                @error('name')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="sectiontype">Section type</label>
                                <div class="small text-muted">Disabled</div>
                                <select name="sectiontype" class="form-select" aria-label="Default select example" disabled>
                                    <option value="single" selected>Single</option>
                                    <option value="multiple">Multiple</option>
                                    <option value="global">Global</option>
                                </select>
                                @error('sectiontype')
                                    <div class="small text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="divider"></div>
                        </div>
                    </div>

                    <!--drag and drop content-->
                    <div class="nothing">
                        <div class="alert alert-info m-t-2 m-b-2">Drag and drop the fields you need, reorder and click save
                        </div>
                    </div>

                    <!--create hidden input and sent to controller-->
                    <div class="row">
                        <input style="display:none;" class="form-control" name="order" value="" placeholder="order"
                            v-model="hiddenOrder" />
                        @error('order')
                            <div class="small text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="row">
                        <div class="col-8">

                            <div class="nothing">
                                <h4>Page</h4>
                            </div>
                            <div id='list1' class='scroll-y bg-white cross-grid p-2 b br' style="height:500px;">
                                @foreach ($data3 as $field)
                                    <div class="pill" id="{{ $field->id }}">
                                        <div>{{ $field->name }}</div>
                                        <div>
                                            <span class="small text-muted">
                                                {{ $field->type }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                                <!--add pills here-->

                            </div>
                        </div>
                        <div class="col-4">
                            <div class="nothing">
                                <h4>Fields</h4>
                            </div>
                            <div id='list2' class='scroll-y bg-grey b br p-2'>

                                @foreach ($data as $field)
                                    <?php if(Helper::isFieldInSection($field->id, $id)) : ?>
                                    <div class="pill" id="{{ $field->id }}">
                                        <div>{{ $field->name }}</div>
                                        <div>
                                            <span class="small text-muted">
                                                {{ $field->type }}
                                            </span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--end-->

                </div>

                <div class="row">
                    <div class="col-12 right">
                        <button @click="onClicking" type="submit" class="m-l btn btn-primary">Save</button>
                    </div>
                </div>

                <div class="gap"></div>
                <!--end main part-->

            </form>
        </div>
    </div>
@endsection
