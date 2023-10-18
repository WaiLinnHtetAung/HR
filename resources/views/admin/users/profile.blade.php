@extends('layouts.app')
@section('title', 'Profile')

@section('content')
    <div class="profile">
        <div class="d-flex justify-content-between profile-wraper gap-1">
            <div class="info text-white">
                <h2>{{ $user->name }}</h2>
                <h5>{{ $user->position ? $user->position->name : '' }}</h5>
                <div class="address mt-4">
                    <div><i class='bx bxs-home me-2'></i> {{ $user->address }}</div>
                    <div><i class='bx bxs-trophy me-2'></i>
                        Started &nbsp;{{ $user->join_date ? date('d-F-Y', strtotime($user->join_date)) : '' }}
                    </div>
                </div>
                <div class="role ">
                    <div class="emp_id">Emp_id : &nbsp;{{ $user->employee_id }}</div>
                    @if ($user->roles)
                        @foreach ($user->roles as $role)
                            <div>{{ $role->name }}</div>
                        @endforeach
                    @endif
                </div>
                <div class="info-detail-wraper">
                    {{-- profile image for mobile  --}}
                    <div class="profile-img mb-4 mobile">
                        <div class="img">
                            @if ($user->photo)
                                <img src="{{ asset('storage/profiles/' . $user->photo) }}" alt="">
                            @else
                                <img src="{{ asset('default.jpg') }}" alt="">
                            @endif

                            <div class="camera cursor-pointer" title="change profile">
                                <i class='bx bxs-camera'></i>
                            </div>
                        </div>
                    </div>

                    {{-- basic info  --}}
                    <div class="head d-flex justify-content-between">
                        <div>
                            <i class='bx bx-user-pin' style="color: rgb(14, 143, 2);"></i>
                            Basic Info
                        </div>
                        <div class="cursor-pointer basic-info">
                            <i class='bx bx-edit-alt' style="color: rgb(187, 34, 34);"></i>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-borderless table-responsive">
                        <tr>
                            <th width="40%">Name</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>NRC</th>
                            <td>{{ $user->nrc }}</td>
                        </tr>
                        <tr>
                            <th>Date of Birth</th>
                            <td>{{ $user->birthday ? date('d-m-Y', strtotime($user->birthday)) : '' }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $user->gender ? ucfirst($user->gender) : '' }}</td>
                        </tr>
                    </table>

                    {{-- contact  --}}
                    <div class="head d-flex justify-content-between mt-4">
                        <div>
                            <i class='bx bxs-user-detail' style="color: rgb(198, 8, 223);"></i>
                            Contact
                        </div>
                    </div>
                    <hr>
                    <table class="table table-borderless table-responsive">
                        <tr>
                            <th width="40%">Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $user->phone }}</td>
                        </tr>
                    </table>

                    {{-- department for mobile  --}}
                    <div class="head d-flex justify-content-between mobile">
                        <div>
                            <i class='bx bxs-category-alt' style="color: rgb(212, 78, 0);"></i>
                            Department
                        </div>
                    </div>
                    <hr class="mobile">
                    <table class="table table-borderless table-responsive mobile">
                        <tr>
                            <th width="30%">Position</th>
                            <td>{{ $user->position ? $user->position->name : '' }}</td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>{{ $user->department ? $user->department->name : '' }}</td>
                        </tr>
                    </table>

                    {{-- password for mobile --}}
                    <div class="head d-flex justify-content-between mt-5 mobile">
                        <div>
                            <i class='bx bxs-lock-alt' style="color: rgb(7, 37, 206);"></i>
                            Password
                        </div>
                        <div class="cursor-pointer" data-bs-toggle="modal" href="#mobilePwChangeModal">
                            <i class='bx bx-edit-alt' style="color: rgb(187, 34, 34);"></i>
                        </div>

                        <!--Mobile Modal -->
                        <div class="modal fade" id="mobilePwChangeModal" aria-hidden="true"
                            aria-labelledby="pwChangeModalLabel" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="pwChangeModalLabel">Password Configuration</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Enter your new password</label>
                                            <input type="password" class="form-control" id="new_pw_mobile" autofocus
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary pw-change-btn-mobile">Change</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mobile">
                    <table class="table table-borderless table-responsive mobile">
                        <tr>
                            <td>******</td>
                        </tr>
                        <tr>
                            <td>Last changed {{ $user->password ? date('d-F-Y', strtotime($user->pw_changed_date)) : '' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="profile-img">
                {{-- profile image  --}}
                <div class="img">
                    @if ($user->photo)
                        <img src="{{ asset('storage/profiles/' . $user->photo) }}" alt="">
                    @else
                        <img src="{{ asset('default.jpg') }}" alt="">
                    @endif

                    <div class="camera cursor-pointer" title="change profile">
                        <i class='bx bxs-camera'></i>
                    </div>
                </div>
                <div class="position bg-white">
                    {{-- department --}}
                    <div class="head d-flex justify-content-between">
                        <div>
                            <i class='bx bxs-category-alt' style="color: rgb(212, 78, 0);"></i>
                            Department
                        </div>
                    </div>
                    <hr>
                    <table class="table table-borderless table-responsive">
                        <tr>
                            <th width="30%">Position</th>
                            <td>{{ $user->position ? $user->position->name : '' }}</td>
                        </tr>
                        <tr>
                            <th>Department</th>
                            <td>{{ $user->department ? $user->department->name : '' }}</td>
                        </tr>
                    </table>

                    {{-- password --}}
                    <div class="head d-flex justify-content-between mt-5">
                        <div>
                            <i class='bx bxs-lock-alt' style="color: rgb(7, 37, 206);"></i>
                            Password
                        </div>
                        <div class="cursor-pointer password" data-bs-toggle="modal" href="#pwChangeModal">
                            <i class='bx bx-edit-alt' style="color: rgb(187, 34, 34);"></i>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="pwChangeModal" aria-hidden="true" aria-labelledby="pwChangeModalLabel"
                            tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="pwChangeModalLabel">Password Configuration</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Enter your new password</label>
                                            <input type="password" class="form-control" id="new_pw" autofocus
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary pw-change-btn">Change</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-borderless table-responsive">
                        <tr>
                            <td>******</td>
                        </tr>
                        <tr>
                            <td>Last changed {{ $user->password ? date('d-F-Y', strtotime($user->pw_changed_date)) : '' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            //upload profile image
            $(document).on('click', '.camera', async function() {
                const [fileHandle] = await window.showOpenFilePicker({
                    types: [{
                        description: 'Images',
                        accept: {
                            "image/*": [".png", ".jpeg", ".jpg"],
                        }
                    }],
                    excludeAcceptAllOption: true,
                    multiple: false,
                });

                const file = await fileHandle.getFile();
                if (file.type != 'image/png' && file.type != 'image/jpg' && file.type !=
                    'image/jpeg') {
                    Swal.fire({
                        title: 'Images file type is not correct !',
                        confirmButtonText: 'Ok',
                    })
                } else {
                    const formData = new FormData();
                    formData.append('profile_image', file);

                    $.ajax({
                        url: '/admin/profile/upload',
                        type: 'post',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            Swal.fire({
                                title: 'Successfully Changed',
                                timer: 3000,
                            }).then(() => {
                                location.reload();
                            });

                        },
                        error: function(error) {
                            Swal.fire({
                                title: 'This image can not be uploaded !',
                                confirmButtonText: 'Ok',
                            })
                        }
                    })
                }

            })

            //basic info edition (current no function)
            $(document).on('click', '.basic-info', function() {
                Swal.fire({
                    title: 'You cannot edit basic info currently !',
                    confirmButtonText: 'Ok',
                })
            })

            //password change (desktop)
            $(document).on('click', '.pw-change-btn', function() {
                $new_pw = $('#new_pw').val();

                if ($new_pw.length < 6 && $new_pw.length > 0) {
                    Swal.fire({
                        title: 'Password must be at least 6 characters !',
                        confirmButtonText: 'Ok',
                    })
                } else if ($new_pw == '' || !$new_pw) {
                    Swal.fire({
                        title: 'Please enter new password !',
                        confirmButtonText: 'Ok',
                    })
                } else {
                    $.ajax({
                        url: '/admin/password-change',
                        type: 'post',
                        data: {
                            new_pw: $new_pw
                        },
                        success: function(res) {
                            if (res == 'fail') {
                                Swal.fire({
                                    title: 'Something wrong. Please Try Again !',
                                    confirmButtonText: 'Ok',
                                })
                            } else {
                                $('#new_pw').val('');
                                $('#pwChangeModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated password !',
                                    confirmButtonText: 'Ok',
                                })
                            }
                        }
                    })
                }
            })

            //password change (mobile)
            $(document).on('click', '.pw-change-btn-mobile', function() {
                $new_pw = $('#new_pw_mobile').val();

                if ($new_pw.length < 6 && $new_pw.length > 0) {
                    Swal.fire({
                        title: 'Password must be at least 6 characters !',
                        confirmButtonText: 'Ok',
                    })
                } else if ($new_pw == '' || !$new_pw) {
                    Swal.fire({
                        title: 'Please enter new password !',
                        confirmButtonText: 'Ok',
                    })
                } else {
                    $.ajax({
                        url: '/admin/password-change',
                        type: 'post',
                        data: {
                            new_pw: $new_pw
                        },
                        success: function(res) {
                            if (res == 'fail') {
                                Swal.fire({
                                    title: 'Something wrong. Please Try Again !',
                                    confirmButtonText: 'Ok',
                                })
                            } else {
                                $('#new_pw_mobile').val('');
                                $('#mobilePwChangeModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Updated password !',
                                    confirmButtonText: 'Ok',
                                })
                            }
                        }
                    })
                }
            })
        })
    </script>
@endsection
