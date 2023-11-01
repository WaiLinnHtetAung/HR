@extends('layouts.app')
@section('title', 'Attendance Scan')

@section('content')
    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.attendance_scan.title') }}</span>
        </div>
        <div class="card-body attendance-scan">
            <div class="img d-flex justify-content-center my-4">
                <img src="{{ asset('images/qr-scan.png') }}" alt="">
            </div>
            <p class="text-center">Please scan attendance QR</p>
            <div class="text-center py-3">
                <button class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#attendance-scan">Scan</button>

                <!-- Modal -->
                <div class="modal fade" id="attendance-scan" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Attendance Scan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <hr>
                            <div class="modal-body">
                                <video id="scanner" style="width: 100%; height: 300px;"></video>
                            </div>
                            <hr>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3 overflow-scroll">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.attendance.fields.overview') }} List</span>
        </div>
        <div class="card-body">
            <div class="row mb-3">
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

            <div class="emp_attendance_table"></div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>Attendance Records</span>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped w-100 " id="DataTable">
                <thead>
                    <th class="no-sort "></th>
                    <th>Employee</th>
                    <th>Date</th>
                    <th>Checkin Time</th>
                    <th>Checkout Time</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('assets/js/qr-scanner.umd.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let scanner = document.getElementById('scanner');
            let scan_modal = document.getElementById('attendance-scan')
            const qrScanner = new QrScanner(
                scanner,
                result => {
                    if (result) {
                        $('#attendance-scan').modal('hide');
                        qrScanner.stop();

                        $.ajax({
                            url: '/admin/attendance-scan/store',
                            type: 'post',
                            data: {
                                value: result
                            },
                            success: function(res) {
                                if (res.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success !',
                                        text: res.message,
                                    })

                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error !',
                                        text: res.message,
                                    })
                                }
                            }
                        })
                    }
                },
            );

            scan_modal.addEventListener('show.bs.modal', function(event) {
                qrScanner.start();
            })

            scan_modal.addEventListener('hide.bs.modal', function(event) {
                qrScanner.stop();
            })

            //datatable
            const table = new DataTable('#DataTable', {
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: '/admin/employee-attendance-datatable',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon'
                    },
                    {
                        data: 'employee',
                        name: 'employee'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'checkin_time',
                        name: 'checkin_time'
                    },
                    {
                        data: 'checkout_time',
                        name: 'checkout_time'
                    },

                ],
                order: [
                    [3, 'desc']
                ],
                columnDefs: [{
                        targets: 'no-sort',
                        sortable: false,
                        searchable: false
                    },
                    {
                        targets: [0],
                        class: "control"
                    }
                ]
            })

            attendanceOverviewTable();

            function attendanceOverviewTable() {
                let year = $('.year').val();
                let month = $('.month').val();

                $.ajax({
                    url: `/admin/employee-attendance-overview?month=${month}&year=${year}`,
                    type: 'get',
                    success: function(res) {
                        $('.emp_attendance_table').html(res);
                    }
                })

                table.ajax.url(`/admin/employee-attendance-datatable?month=${month}&year=${year}`).load();
            }

            $(document).on('click', '.filter', function() {
                attendanceOverviewTable();
            })


        })
    </script>
@endsection
