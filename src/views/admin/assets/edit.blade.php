@extends('ignitedcms::admin.assets.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">
            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/assets') }}">Assets</a>
                </div>

                <div class="breadcrumb-item">View asset</div>
            </div>

            <!--main part for section styles -->
            <div class="panel br drop-shadow">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            @foreach ($data as $row)
                                <label for="title">Alt Title</label>
                                <div class="small text-muted m-b">If you have an
                                    image you can add an Alt title
                                </div>
                                <input class="form-control" type="text" name="alt_title" value="{{ $row->alt_title }}"
                                    placeholder="Start typing" />
                        </div>

                        <div class="form-group">
                            <label for="Filename">Filename</label>
                            <div class="small text-muted">The file name </div>
                            {{ $row->filename }}
                        </div>
                        @if (in_array($row->kind, ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'svg']))
                            <div class="form-group">
                                <img src="{{ $row->url }}" class="img-responsive"></img>
                            </div>
                        @else
                            <a href="{{ $row->url }}">Download</a>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col right">
                    <button type="submit" class="btn btn-primary">Save</button>

                </div>
            </div>
            <div class="gap"></div>
        </div>
    </div>
@endsection

