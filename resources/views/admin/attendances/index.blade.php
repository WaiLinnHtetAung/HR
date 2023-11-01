@extends('layouts.app')
@section('title', 'Attendance')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-calendar' style="color:rgb(15, 175, 15);"></i>
        <div>{{ __('messages.attendance.title') }}</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.attendance.title') }} List</span>
            @can('attendance_create')
                <a href="{{ route('admin.attendances.create') }}" class="btn btn-primary text-decoration-none text-white"><i
                        class='bx bxs-plus-circle me-2'></i>
                    Create New {{ __('messages.attendance.title') }}</a>
            @endcan
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped w-100 " id="DataTable">
                <thead>
                    <th class="no-sort "></th>
                    <th>Employee</th>
                    <th>Date</th>
                    <th>Checkin Time</th>
                    <th>Checkout Time</th>
                    <th class="no-sort">Action</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            //datatable
            const table = new DataTable('#DataTable', {
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: '/admin/attendances-datatable',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon'
                    },
                    {
                        data: 'employee_name',
                        name: 'employee_name'
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
                    {
                        data: 'action',
                        data: 'action',
                    }
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

            //delete function
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();

                let id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure to delete ?',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/attendances/" + id,
                            type: "DELETE",
                            success: function() {
                                table.ajax.reload();
                            }
                        })
                    }
                })
            })
        })
    </script>
@endsection
