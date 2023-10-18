@extends('layouts.app')
@section('title', 'Employee Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-user' style="color: rgb(8, 184, 8);"></i>
        <div>{{ __('messages.employee.title') }} Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.employee.title') }} Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <th width="25%">{{ __('messages.employee.fields.profile') }}</th>
                    <td>
                        @if ($user->profile)
                            <img src="{{ $user->profile }}" style="width: 250px;" alt="">
                        @else
                            <img src="{{ asset('logo.png') }}" style="width: 250px;" alt="">
                        @endif
                    </td>
                </tr>
                <tr>
                    <th width="25%">{{ __('messages.employee.fields.employee_id') }}</th>
                    <td>{{ $user->employee_id }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.employee.fields.name') }}</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.employee.fields.position') }}</th>
                    <td>{{ $user->position ? $user->position->name : '' }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.employee.fields.department') }}</th>
                    <td>{{ $user->department ? $user->department->name : '' }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.employee.fields.email') }}</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.employee.fields.phone') }}</th>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.employee.fields.nrc') }}</th>
                    <td>{{ $user->nrc }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.employee.fields.address') }}</th>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.employee.fields.birthday') }}</th>
                    <td>{{ $user->birthday ? date('d-F-Y', strtotime($user->birthday)) : '' }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.employee.fields.gender') }}</th>
                    <td>{{ $user->gender ? ucfirst($user->gender) : '' }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.employee.fields.join_date') }}</th>
                    <td>{{ $user->join_date ? date('d-F-Y', strtotime($user->join_date)) : '' }}</td>
                    {{-- <td>{{ gettype($user->join_date) }}</td> --}}
                </tr>
                <tr>
                    <th>{{ __('messages.employee.fields.is_present') }}</th>
                    <td>{!! $user->is_present
                        ? "<span class='badge bg-primary rounded-pill me-1 mb-1'>Present</span>"
                        : "<span class='badge bg-danger rounded-pill me-1 mb-1'>Leave</span>" !!}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('messages.employee.fields.role') }}</th>
                    <td>
                        @foreach ($user->roles as $role)
                            <span class="badge rounded-pill bg-info">{{ $role->name ?? '' }}</span>
                        @endforeach
                    </td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
