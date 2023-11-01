@extends('layouts.app')
@section('title', 'Attendance Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-calendar' style="color:rgb(15, 175, 15);"></i>
        <div>{{ __('messages.attendance.title') }} Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.attendance.title') }} Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <td width="20%">{{ __('messages.attendance.fields.employee') }}</td>
                    <td>{{ $attendance->employee->name }}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.attendance.fields.date') }}</td>
                    <td>{{ $attendance->date }}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.attendance.fields.checkin_time') }}</td>
                    <td>{{ $attendance->checkin_time }}</td>
                </tr>
                <tr>
                    <td>{{ __('messages.attendance.fields.checkout_time') }}</td>
                    <td>{{ $attendance->checkout_time }}</td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
