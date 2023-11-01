@extends('layouts.app')
@section('title', 'Attendance')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-user-account' style="color:rgb(20, 116, 180);"></i>
        <div>{{ __('messages.attendance.fields.overview') }}</div>
    </div>

    <div class="card mt-3 overflow-scroll">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.attendance.fields.overview') }} List</span>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-4 col-md-2">
                    <div class="form-group">
                        <select name="" id="" class="form-control select2 employee"
                            data-placeholder="--- Select Employee ---">
                            <option></option>
                            @foreach ($employee as $key => $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="form-group">
                        <select name="year" id="" class="form-control select2 year"
                            data-placeholder="--- Select Year ---">
                            <option></option>
                            @for ($i = 0; $i < 5; $i++)
                                <option value={{ now()->subYears($i)->format('Y') }}
                                    {{ now()->format('Y') ==now()->subYears($i)->format('Y')? 'selected': '' }}>
                                    {{ now()->subYears($i)->format('Y') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <div class="form-group">
                        <select name="month" id="" class="form-control select2 month"
                            data-placeholder="--- Select Month ---">
                            <option></option>
                            <option value="01" {{ now()->format('m') == '01' ? 'selected' : '' }}>Jan</option>
                            <option value="02" {{ now()->format('m') == '02' ? 'selected' : '' }}>Feb</option>
                            <option value="03" {{ now()->format('m') == '03' ? 'selected' : '' }}>Mar</option>
                            <option value="04" {{ now()->format('m') == '04' ? 'selected' : '' }}>Apr</option>
                            <option value="05" {{ now()->format('m') == '05' ? 'selected' : '' }}>May</option>
                            <option value="06" {{ now()->format('m') == '06' ? 'selected' : '' }}>Jun</option>
                            <option value="07" {{ now()->format('m') == '07' ? 'selected' : '' }}>Jul</option>
                            <option value="08" {{ now()->format('m') == '08' ? 'selected' : '' }}>Aug</option>
                            <option value="09" {{ now()->format('m') == '09' ? 'selected' : '' }}>Sep</option>
                            <option value="10" {{ now()->format('m') == '10' ? 'selected' : '' }}>Oct</option>
                            <option value="11" {{ now()->format('m') == '11' ? 'selected' : '' }}>Nov</option>
                            <option value="12" {{ now()->format('m') == '12' ? 'selected' : '' }}>Dec</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4 col-md-2">
                    <button class="btn btn-info w-100 filter"><i class='bx bx-filter-alt me-2'></i>Filter</button>
                </div>
            </div>

            <div class="attendance_table"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            attendanceOverviewTable();

            function attendanceOverviewTable() {
                let year = $('.year').val();
                let month = $('.month').val();
                let employee = $('.employee').val();

                $.ajax({
                    url: `/admin/attendances-overview-table?month=${month}&year=${year}&employee=${employee}`,
                    type: 'get',
                    success: function(res) {
                        $('.attendance_table').html(res);
                    }
                })
            }

            $(document).on('click', '.filter', function() {
                attendanceOverviewTable();
            })


        })
    </script>
@endsection
