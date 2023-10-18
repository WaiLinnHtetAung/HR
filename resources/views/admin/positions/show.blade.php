@extends('layouts.app')
@section('title', 'Position Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-briefcase' style="color: goldenrod;"></i>
        <div>{{ __('messages.position.title') }} Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.position.title') }} Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <td width="20%">ID</td>
                    <td>{{ $position->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $position->name }}</td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
