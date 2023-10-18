@extends('layouts.app')
@section('title', 'Create Employee')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-user' style="color: rgb(8, 184, 8);"></i>
        <div>{{ __('messages.employee.title') }} Creation</div>
    </div>
    <div class="card mt-3 p-4">
        <div class="mb-5 d-flex justify-content-between">
            <span>{{ __('messages.employee.title') }} Creation</span>
            <span class="text-warning">Default user password is <span class="text-primary">password</span></span>
        </div>

        <form action="{{ route('admin.users.store') }}" method="post" id="user_create">
            @csrf
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.employee_id') }}</label>
                        <input type="text" name="employee_id" class="form-control" value="{{ old('employee_id') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.email') }}</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.position') }}</label>
                        <select name="position_id" id="" class="form-select">
                            <option value="">Please Select</option>
                            @foreach ($positions as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.department') }}</label>
                        <select name="dep_id" id="" class="form-select">
                            <option value="">Please Select</option>
                            @foreach ($departments as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.phone') }}</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.nrc') }}</label>
                        <input type="text" name="nrc" class="form-control" value="{{ old('nrc') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.birthday') }}</label>
                        <input type="" name="birthday" class="form-control date birthday" autocomplete="off"
                            placeholder="YYYY-MM-DD" value="{{ old('birthday') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.gender') }}</label>
                        <select name="gender" id="" class="form-select">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.join_date') }}</label>
                        <input type="" name="join_date" class="form-control date" autocomplete="off"
                            placeholder="YYYY-MM-DD" value="{{ old('join_date') }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="addresss">{{ __('messages.employee.fields.address') }}</label>
                        <textarea name="address" id="addresss" cols="30" rows="5" class="form-control" placeholder="your address .."
                            autocomplete="off">{{ old('address') }}</textarea>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">{{ __('messages.employee.fields.role') }} <span class="text-muted">(Please
                                Select)</span></label>
                        <div class="mb-2">
                            <span class="text-white p-1 rounded-1 cursor-pointer select-all"
                                style="font-size: 12px; background: rgb(27, 199, 170);">Select
                                All</span>
                            <span class="text-white p-1 rounded-1 cursor-pointer disselect-all"
                                style="font-size: 12px; background: rgb(27, 199, 170);">Disselect
                                All</span>
                        </div>
                        <select name="roles[]" id="roles" class="select2 form-control" multiple="multiple">
                            @foreach ($roles as $id => $role)
                                <option value="{{ $role }}"
                                    {{ in_array($role, old('roles', [])) ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <button class="btn btn-secondary back-btn">Cancel</button>
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreUserRequest', '#user_create') !!}

    <script>
        $(document).ready(function() {
            $(function() {
                let date = $('.date');
                if (date) {
                    date.flatpickr({
                        dateFormat: "Y-m-d",
                    })
                }
            })
        })
    </script>
@endsection
