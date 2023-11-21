@extends('ignitedcms::admin.sections.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('ignitedcms::admin.sidebar')
        <div class="main-content p-3" id="main-content">

            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Sections</div>
            </div>

            <div class="row">
                <div class="col-12 right">
                    <a href="{{ url('admin/section/create') }}">
                        <button type="button" class="btn btn-primary">New section</button>
                    </a>
                </div>
            </div>
            <!--main part for section styles -->
            <div class="panel br drop-shadow p-b-5">

                <h3>Sections</h3>

                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>title</th>
                            <th>type</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $section)
                            <tr>
                                <td>{{ $section->id }}</td>
                                <td><a href="{{ url('admin/section/update', $section->id) }}">{{ $section->name }}</a></td>

                                <td>{{ $section->sectiontype }}</td>
                                <td>
                                    <span class="right">
                                        <tooltip link="delete">

                                            <form action="{{ url('/admin/section/delete', $section->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn  rm-btn-styles">ok</button>
                                            </form>

                                        </tooltip>
                                    </span>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>
@endsection
