@extends('layouts.app')
@section('title', 'Employee')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-user' style="color: rgb(8, 184, 8);"></i>
        <div>{{ __('messages.employee.title') }}</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.employee.title') }} List</span>
            @can('user_create')
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary text-decoration-none text-white"><i
                        class='bx bxs-plus-circle me-2'></i>
                    Create New {{ __('messages.employee.title') }}</a>
            @endcan
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped w-100" id="DataTable">
                <thead>
                    <th class="no-sort"></th>
                    <th class="no-sort">{{ __('messages.employee.fields.profile') }}</th>
                    <th>{{ __('messages.employee.fields.employee_id') }}</th>
                    <th>{{ __('messages.employee.fields.name') }}</th>
                    <th>{{ __('messages.employee.fields.position') }}</th>
                    <th>{{ __('messages.employee.fields.email') }}</th>
                    <th>{{ __('messages.employee.fields.phone') }}</th>
                    <th>{{ __('messages.employee.fields.department') }}</th>
                    <th>{{ __('messages.employee.fields.role') }}</th>
                    <th class="no-sort">{{ __('messages.employee.fields.is_present') }}</th>
                    <th class="no-sort text-nowrap">Action</th>
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
                serverSide: true,
                responsive: true,
                ajax: '/admin/users-datatable',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                    },
                    {
                        data: 'profile',
                        name: 'profile'
                    },
                    {
                        data: 'employee_id',
                        name: 'employee_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'position_id',
                        name: 'position_id',
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'dep_id',
                        name: 'dep_id'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'is_present',
                        name: 'is_present'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ],
                columnDefs: [{
                        targets: 'no-sort',
                        sortable: false,
                        searchable: false,

                    },
                    {
                        "targets": [0],
                        "class": "control"
                    }
                ],
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
                            url: "/admin/roles/" + id,
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
