@extends('layouts.app')
@section('title', 'Departments')

@section('content')
    <div class="card-head-icon">
        <i class='bx bx-sitemap' style="color: rgb(0, 148, 185);"></i>
        <div>{{ __('messages.department.title') }}</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.department.title') }} List</span>
            @can('department_create')
                <a href="{{ route('admin.departments.create') }}" class="btn btn-primary text-decoration-none text-white"><i
                        class='bx bxs-plus-circle me-2'></i>
                    Create New {{ __('messages.department.title') }}</a>
            @endcan
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped w-100 " id="DataTable">
                <thead>
                    <th class="no-sort "></th>
                    <th>ID</th>
                    <th>Name</th>
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
                ajax: '/admin/departments-datatable',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        data: 'action',
                    }
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
                            url: "/admin/departments/" + id,
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
