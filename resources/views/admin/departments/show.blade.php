@extends('layouts.app')
@section('title', 'Department Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bx-sitemap' style="color: rgb(0, 148, 185);"></i>
        <div>{{ __('messages.department.title') }} Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.department.title') }} Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <td width="20%">ID</td>
                    <td>{{ $department->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $department->name }}</td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
