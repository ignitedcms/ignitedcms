@extends('admin.dashboard.layout')
@section('content')
    <div id="app" class="full-screen">
        @include('admin.sidebar')
        <div class="main-content p-3" id="main-content">
            <div class="breadcrumb m-b-3">
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ url('admin/permissions') }}">Permissions</a>
                </div>
                <div class="breadcrumb-item">Add new group</div>
            </div>

            <!--main part for section styles -->
            <div class="panel br drop-shadow">
                <div class="form-group">
                    <label for="groupname">Group Name [*]</label>
                    <div class="small text-muted m-b">Suitable name, no spaces or special characters allowed, eg bloggers
                    </div>
                    <input class="form-control" name="groupname" value="" placeholder="Start typing" />
                </div>

                <div class="divider"></div>
                <div class="form-group">

                    <label for="permissions">Permissions</label>
                    <div class="small text-muted">Pick what things they will see in their dashboard</div>

                    <div class="m-t-2">
                        <input type="checkbox" name="" class="form-check-input">
                        <label for="the label">Site settings</label>
                    </div>
                    <div>
                        <input type="checkbox" name="" class="form-check-input" checked>
                        <label for="the label">Field builder</label>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-12 right">
                    <button type="submit" class="m-l btn btn-primary">Save</button>
                </div>
            </div>

        </div>
    </div>
@endsection
