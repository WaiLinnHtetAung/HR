@extends('layouts.app')
@section('title', 'Create Department')

@section('content')
    <div class="card-head-icon">
        <i class='bx bx-sitemap' style="color: rgb(0, 148, 185);"></i>
        <div>Create {{ __('messages.department.title') }}</div>
    </div>
    <div class="card mt-3 p-4 mt-3">
        <span class="mb-4">{{ __('messages.department.title') }} Creation</span>
        <form action="{{ route('admin.departments.store') }}" method="post" id="department_create">
            @csrf
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                    </div>

                    <div>
                        <button class="btn btn-secondary back-btn">Cancel</button>
                        <button class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreDepartmentRequest', '#department_create') !!}
@endsection
