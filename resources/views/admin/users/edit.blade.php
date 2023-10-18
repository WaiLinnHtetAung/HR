@extends('layouts.app')
@section('title', 'Edit Employee')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-user' style="color: rgb(8, 184, 8);"></i>
        <div>{{ __('messages.employee.title') }} Edition</div>
    </div>
    <div class="card mt-3 p-4">
        <span class="mb-4">{{ __('messages.employee.title') }} Edition</span>

        <form action="{{ route('admin.users.update', $user->id) }}" method="post" id="user_edit">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.employee_id') }}</label>
                        <input type="text" name="employee_id" class="form-control"
                            value="{{ old('employee_id', $user->employee_id) }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.email') }}</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.position') }}</label>
                        <select name="position_id" id="" class="form-select">
                            <option value="">Please Select</option>
                            @foreach ($positions as $key => $value)
                                <option value="{{ $key }}" {{ $key == $user->position_id ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.department') }}</label>
                        <select name="dep_id" id="" class="form-select">
                            @foreach ($departments as $key => $value)
                                <option value="{{ $key }}" {{ $user->dep_id == $key ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.phone') }}</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.nrc') }}</label>
                        <input type="text" name="nrc" class="form-control" value="{{ old('nrc', $user->nrc) }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.birthday') }}</label>
                        <input type="" name="birthday" class="form-control date birthday" autocomplete="off"
                            placeholder="YYYY-MM-DD" value="{{ old('birthday', $user->birthday) }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.gender') }}</label>
                        <select name="gender" id="" class="form-select">
                            <option value="male"
                                {{ old('gender') == 'male' || $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female"
                                {{ old('gender') == 'female' || $user->gender == 'female' ? 'selected' : '' }}>Female
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.employee.fields.join_date') }}</label>
                        <input type="" name="join_date" class="form-control date" autocomplete="off"
                            placeholder="YYYY-MM-DD" value="{{ old('join_date', $user->join_date) }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="addresss">{{ __('messages.employee.fields.address') }}</label>
                        <textarea name="address" id="addresss" cols="30" rows="5" class="form-control" placeholder="your address .."
                            autocomplete="off">{{ old('address', $user->address) }}</textarea>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="">Roles <span class="text-muted">(Please Select)</span></label>
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
                                    {{ in_array($role, old('roles', [])) || $user->roles->contains($id) ? 'selected' : '' }}>
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateUserRequest', '#user_edit') !!}
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
