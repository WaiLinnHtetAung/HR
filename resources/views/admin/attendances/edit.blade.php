@extends('layouts.app')
@section('title', 'Create Attendance')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-calendar' style="color:rgb(15, 175, 15);"></i>
        <div>Create {{ __('messages.attendance.title') }}</div>
    </div>
    <div class="card mt-3 p-4 mt-3">
        <span class="mb-4">{{ __('messages.attendance.title') }} Creation</span>
        <form action="{{ route('admin.attendances.update', $attendance->id) }}" method="post" id="attendance_update">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-3">
                        <label for="">{{ __('messages.attendance.fields.employee') }}</label>
                        <select name="user_id" id="" class="select2 form-control"
                            data-placeholder="--- Please Select ---">
                            <option></option>
                            @foreach ($employee as $key => $value)
                                <option value="{{ $key }}"
                                    {{ old('user_id') || $attendance->user_id == $key ? 'selected' : '' }}
                                    {{ $attendance->user_id != $key ? 'disabled' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-3">
                        <label for="">{{ __('messages.attendance.fields.date') }}</label>
                        <input type="" name="date" class="form-control " readonly placeholder="YYYY-MM-DD"
                            value="{{ old('date', $attendance->date) }}">
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-3">
                        <label for="">{{ __('messages.attendance.fields.checkin_time') }}</label>
                        <input type="" name="checkin_time" class="form-control time" placeholder="00 : 00"
                            value="{{ old('checkin_time', $attendance->checkin_time ? date('H:i:s', strtotime($attendance->checkin_time)) : '') }}">
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-3">
                        <label for="">{{ __('messages.attendance.fields.checkout_time') }}</label>
                        <input type="" name="checkout_time" class="form-control time" placeholder="00 : 00"
                            value="{{ old('checkout_time', $attendance->checkout_time ? date('H:i:s', strtotime($attendance->checkout_time)) : '') }}">
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button class="btn btn-secondary back-btn">Cancel</button>
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateAttendanceRequest', '#attendance_update') !!}

    <script>
        $(document).ready(function() {
            $(function() {
                let date = $('.date');
                if (date) {
                    date.flatpickr({
                        dateFormat: "Y-m-d",
                        readonly: true
                    })
                }

                let time = $('.time');
                if (time) {
                    time.flatpickr({
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i:s",
                        time_24hr: true
                    })
                }
            })
        })
    </script>
@endsection
