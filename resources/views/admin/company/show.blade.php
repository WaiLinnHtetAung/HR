@extends('layouts.app')
@section('title', 'Company Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-buildings' style="color: rgb(67, 67, 168);"></i>
        <div>{{ __('messages.company_setting.title') }} Detail</div>

    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.company_setting.title') }} Detail</span>

        </div>

        <div class="card-body company">
            <div class="img text-center">
                <img src="{{ asset('images/company.jpg') }}" alt="">
            </div>
            <div class="info mt-5">
                <div class="row">
                    <div class="mb-5 col-12 col-md-5 offset-md-1">
                        <h5 class="fw-bold mb-4">Company Name</h5>
                        <div class="edit d-flex justify-content-between">
                            <input type="text" disabled value="{{ $company_setting->name }}" class="name_input">
                            @can('company_edit')
                                <i class='bx bx-pencil pe-4 cursor-pointer name_edit'></i>
                                <i class='bx bxs-check-circle cursor-pointer pe-4 name_save d-none'></i>
                            @endcan
                        </div>
                        <hr>
                    </div>
                    <div class="mb-5 col-12 col-md-5 offset-md-1">
                        <h5 class="fw-bold mb-4">Company Email</h5>
                        <div class="edit d-flex justify-content-between">
                            <input type="text" disabled value="{{ $company_setting->email }}" class="email_input">
                            @can('company_edit')
                                <i class='bx bx-pencil edit-icon pe-4 cursor-pointer email_edit'></i>
                                <i class='bx bxs-check-circle check-icon cursor-pointer pe-4 d-none email_save'></i>
                            @endcan
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-5 col-12 col-md-5 offset-md-1">
                        <h5 class="fw-bold mb-4">Company phone</h5>
                        <div class="edit d-flex justify-content-between">
                            <input type="text" disabled value="{{ $company_setting->phone }}" class="phone_input">
                            @can('company_edit')
                                <i class='bx bx-pencil edit-icon pe-4 cursor-pointer phone_edit'></i>
                                <i class='bx bxs-check-circle check-icon cursor-pointer pe-4 d-none phone_save'></i>
                            @endcan
                        </div>
                        <hr>
                    </div>
                    <div class="mb-5 col-12 col-md-5 offset-md-1">
                        <h5 class="fw-bold mb-4">Company Address</h5>
                        <div class="edit d-flex justify-content-between">
                            <input type="text" disabled value="{{ $company_setting->address }}" class="address_input">
                            @can('company_edit')
                                <i class='bx bx-pencil edit-icon pe-4 cursor-pointer address_edit'></i>
                                <i class='bx bxs-check-circle check-icon cursor-pointer pe-4 d-none address_save'></i>
                            @endcan
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-5 col-12 col-md-5 offset-md-1">
                        <h5 class="fw-bold mb-4">Company Start Time</h5>
                        <div class="edit d-flex justify-content-between">
                            <input type="text" disabled value="{{ $company_setting->start_time }}"
                                class="start_time_input date">
                            @can('company_edit')
                                <i class='bx bx-pencil edit-icon pe-4 cursor-pointer start_time_edit'></i>
                                <i class='bx bxs-check-circle check-icon cursor-pointer pe-4 d-none start_time_save'></i>
                            @endcan
                        </div>
                        <hr>
                    </div>
                    <div class="mb-5 col-12 col-md-5 offset-md-1">
                        <h5 class="fw-bold mb-4">Company End Time</h5>
                        <div class="edit d-flex justify-content-between">
                            <input type="text" disabled value="{{ $company_setting->end_time }}"
                                class="end_time_input date">
                            @can('company_edit')
                                <i class='bx bx-pencil edit-icon pe-4 cursor-pointer end_time_edit'></i>
                                <i class='bx bxs-check-circle check-icon cursor-pointer pe-4 d-none end_time_save'></i>
                            @endcan
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-5 col-12 col-md-5 offset-md-1">
                        <h5 class="fw-bold mb-4">Company Break Start Time</h5>
                        <div class="edit d-flex justify-content-between">
                            <input type="text" disabled value="{{ $company_setting->break_start_time }}"
                                class="break_start_time_input date">
                            @can('company_edit')
                                <i class='bx bx-pencil edit-icon pe-4 cursor-pointer break_start_time_edit'></i>
                                <i class='bx bxs-check-circle check-icon cursor-pointer pe-4 d-none break_start_time_save'></i>
                            @endcan
                        </div>
                        <hr>
                    </div>
                    <div class="mb-5 col-12 col-md-5 offset-md-1">
                        <h5 class="fw-bold mb-4">Company Break End Time</h5>
                        <div class="edit d-flex justify-content-between">
                            <input type="text" disabled value="{{ $company_setting->break_end_time }}"
                                class="break_end_time_input date">
                            @can('company_edit')
                                <i class='bx bx-pencil edit-icon pe-4 cursor-pointer break_end_time_edit'></i>
                                <i class='bx bxs-check-circle check-icon cursor-pointer pe-4 d-none break_end_time_save'></i>
                            @endcan
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            //name edit
            $(document).on('click', '.name_edit', function() {
                $('.name_input').prop("disabled", false).focus();
                //auto foucs at the end of line
                let input = $('.name_input')[0];
                input.selectionStart = input.selectionEnd = input.value.length;

                $('.name_edit').addClass('d-none');
                $('.name_save').removeClass('d-none');
            })

            //name save
            $(document).on('click', '.name_save', function() {
                $name = $('.name_input').val();

                if (!$name) {
                    Swal.fire({
                        title: 'Please Enter Company Name !',
                        confirmButtonText: 'Ok',
                    })
                } else {
                    $.ajax({
                        url: '/admin/company-name/edit',
                        type: 'post',
                        data: {
                            name: $name
                        },
                        success: function(res) {
                            if (res == 'fail') {
                                Swal.fire({
                                    title: 'Something Wrong !',
                                    confirmButtonText: 'Ok',
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated Company Name !',
                                    confirmButtonText: 'Ok',
                                });

                                $('.name_input').val($name);
                                $('.name_input').prop("disabled", true);
                                $('.name_edit').removeClass('d-none');
                                $('.name_save').addClass('d-none');
                            }
                        }
                    })
                }
            })

            //email edit
            $(document).on('click', '.email_edit', function() {
                $('.email_input').prop("disabled", false).focus();

                //auto foucs at the end of line
                let input = $('.email_input')[0];
                input.selectionStart = input.selectionEnd = input.value.length;

                $('.email_edit').addClass('d-none');
                $('.email_save').removeClass('d-none');
            })

            //email save
            $(document).on('click', '.email_save', function() {
                $name = $('.email_input').val();

                if (!$name) {
                    Swal.fire({
                        title: 'Please Enter Correct Email !',
                        confirmButtonText: 'Ok',
                    })
                } else {
                    $.ajax({
                        url: '/admin/company-email/edit',
                        type: 'post',
                        data: {
                            name: $name
                        },
                        success: function(res) {
                            if (res == 'fail') {
                                Swal.fire({
                                    title: 'Something Wrong !',
                                    confirmButtonText: 'Ok',
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated Company Email !',
                                    confirmButtonText: 'Ok',
                                });

                                $('.email_input').val($name);
                                $('.email_input').prop("disabled", true);
                                $('.email_edit').removeClass('d-none');
                                $('.email_save').addClass('d-none');
                            }
                        }
                    })
                }
            })

            //phone edit
            $(document).on('click', '.phone_edit', function() {
                $('.phone_input').prop("disabled", false).focus();

                //auto foucs at the end of line
                let input = $('.phone_input')[0];
                input.selectionStart = input.selectionEnd = input.value.length;

                $('.phone_edit').addClass('d-none');
                $('.phone_save').removeClass('d-none');
            })

            //phone save
            $(document).on('click', '.phone_save', function() {
                $name = $('.phone_input').val();

                if (!$name) {
                    Swal.fire({
                        title: 'Please Enter Correct Phone !',
                        confirmButtonText: 'Ok',
                    })
                } else {
                    $.ajax({
                        url: '/admin/company-phone/edit',
                        type: 'post',
                        data: {
                            name: $name
                        },
                        success: function(res) {
                            if (res == 'fail') {
                                Swal.fire({
                                    title: 'Something Wrong !',
                                    confirmButtonText: 'Ok',
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated Company Phone !',
                                    confirmButtonText: 'Ok',
                                });

                                $('.phone_input').val($name);
                                $('.phone_input').prop("disabled", true);
                                $('.phone_edit').removeClass('d-none');
                                $('.phone_save').addClass('d-none');
                            }
                        }
                    })
                }
            })

            //address edit
            $(document).on('click', '.address_edit', function() {
                $('.address_input').prop("disabled", false).focus();

                //auto foucs at the end of line
                let input = $('.address_input')[0];
                input.selectionStart = input.selectionEnd = input.value.length;

                $('.address_edit').addClass('d-none');
                $('.address_save').removeClass('d-none');
            })

            //address save
            $(document).on('click', '.address_save', function() {
                $name = $('.address_input').val();

                if (!$name) {
                    Swal.fire({
                        title: 'Please Enter Correct Address !',
                        confirmButtonText: 'Ok',
                    })
                } else {
                    $.ajax({
                        url: '/admin/company-address/edit',
                        type: 'post',
                        data: {
                            name: $name
                        },
                        success: function(res) {
                            if (res == 'fail') {
                                Swal.fire({
                                    title: 'Something Wrong !',
                                    confirmButtonText: 'Ok',
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated Company Address !',
                                    confirmButtonText: 'Ok',
                                });

                                $('.address_input').val($name);
                                $('.address_input').prop("disabled", true);
                                $('.address_edit').removeClass('d-none');
                                $('.address_save').addClass('d-none');
                            }
                        }
                    })
                }
            })

            //start time edit
            $(document).on('click', '.start_time_edit', function() {
                $('.start_time_input').prop("disabled", false).focus();

                $('.start_time_edit').addClass('d-none');
                $('.start_time_save').removeClass('d-none');
            })

            //start time save
            $(document).on('click', '.start_time_save', function() {
                $name = $('.start_time_input').val();

                if (!$name) {
                    Swal.fire({
                        title: 'Please Enter Correct Address !',
                        confirmButtonText: 'Ok',
                    })
                } else {
                    $.ajax({
                        url: '/admin/company-start-time/edit',
                        type: 'post',
                        data: {
                            name: $name
                        },
                        success: function(res) {
                            if (res == 'fail') {
                                Swal.fire({
                                    title: 'Something Wrong !',
                                    confirmButtonText: 'Ok',
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated Company Start Time !',
                                    confirmButtonText: 'Ok',
                                });

                                $('.start_time_input').val($name);
                                $('.start_time_input').prop("disabled", true);
                                $('.start_time_edit').removeClass('d-none');
                                $('.start_time_save').addClass('d-none');
                            }
                        }
                    })
                }
            })

            //end time edit
            $(document).on('click', '.end_time_edit', function() {
                $('.end_time_input').prop("disabled", false).focus();

                $('.end_time_edit').addClass('d-none');
                $('.end_time_save').removeClass('d-none');
            })

            //end time save
            $(document).on('click', '.end_time_save', function() {
                $name = $('.end_time_input').val();

                if (!$name) {
                    Swal.fire({
                        title: 'Please Enter Correct Address !',
                        confirmButtonText: 'Ok',
                    })
                } else {
                    $.ajax({
                        url: '/admin/company-end-time/edit',
                        type: 'post',
                        data: {
                            name: $name
                        },
                        success: function(res) {
                            if (res == 'fail') {
                                Swal.fire({
                                    title: 'Something Wrong !',
                                    confirmButtonText: 'Ok',
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated Company End Time !',
                                    confirmButtonText: 'Ok',
                                });

                                $('.end_time_input').val($name);
                                $('.end_time_input').prop("disabled", true);
                                $('.end_time_edit').removeClass('d-none');
                                $('.end_time_save').addClass('d-none');
                            }
                        }
                    })
                }
            })

            //break start time edit
            $(document).on('click', '.break_start_time_edit', function() {
                $('.break_start_time_input').prop("disabled", false).focus();

                $('.break_start_time_edit').addClass('d-none');
                $('.break_start_time_save').removeClass('d-none');
            })

            //break start time save
            $(document).on('click', '.break_start_time_save', function() {
                $name = $('.break_start_time_input').val();

                if (!$name) {
                    Swal.fire({
                        title: 'Please Enter Correct Address !',
                        confirmButtonText: 'Ok',
                    })
                } else {
                    $.ajax({
                        url: '/admin/company-break-start-time/edit',
                        type: 'post',
                        data: {
                            name: $name
                        },
                        success: function(res) {
                            if (res == 'fail') {
                                Swal.fire({
                                    title: 'Something Wrong !',
                                    confirmButtonText: 'Ok',
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated Company Break Start Time !',
                                    confirmButtonText: 'Ok',
                                });

                                $('.break_start_time_input').val($name);
                                $('.break_start_time_input').prop("disabled", true);
                                $('.break_start_time_edit').removeClass('d-none');
                                $('.break_start_time_save').addClass('d-none');
                            }
                        }
                    })
                }
            })

            //break end time edit
            $(document).on('click', '.break_end_time_edit', function() {
                $('.break_end_time_input').prop("disabled", false).focus();

                $('.break_end_time_edit').addClass('d-none');
                $('.break_end_time_save').removeClass('d-none');
            })

            //break end time save
            $(document).on('click', '.break_end_time_save', function() {
                $name = $('.break_end_time_input').val();

                if (!$name) {
                    Swal.fire({
                        title: 'Please Enter Correct Address !',
                        confirmButtonText: 'Ok',
                    })
                } else {
                    $.ajax({
                        url: '/admin/company-break-end-time/edit',
                        type: 'post',
                        data: {
                            name: $name
                        },
                        success: function(res) {
                            if (res == 'fail') {
                                Swal.fire({
                                    title: 'Something Wrong !',
                                    confirmButtonText: 'Ok',
                                })
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated Company Break End Time !',
                                    confirmButtonText: 'Ok',
                                });

                                $('.break_end_time_input').val($name);
                                $('.break_end_time_input').prop("disabled", true);
                                $('.break_end_time_edit').removeClass('d-none');
                                $('.break_end_time_save').addClass('d-none');
                            }
                        }
                    })
                }
            })





            //date picker
            $(function() {
                let date = $('.date');
                if (date) {
                    date.flatpickr({
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
