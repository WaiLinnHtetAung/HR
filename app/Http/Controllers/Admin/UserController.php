<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('user_access')) {
            abort(403);
        }

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function dataTable()
    {
        $data = User::with('department', 'position', 'roles');

        return Datatables::of($data)
            ->filterColumn('dep_id', function ($query, $keyword) {
                $query->whereHas('department', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })
            ->filterColumn('position_id', function ($query, $keyword) {
                $query->whereHas('position', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })
            ->filterColumn('role', function ($query, $keyword) {
                $query->whereHas('roles', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->editColumn('profile', function ($each) {
                $default_photo = url('logo.png');
                $user_photo = $each->profile_img_path();
                return $each->photo ? "<img src='$user_photo' style='width: 80px; height: 80px; border-radius: 10px;' />" : "<img src='$default_photo' style='width: 130px; height: 100px; object-fit:contain;' />";
            })
            ->editColumn('position_id', function ($each) {
                return $each->position ? $each->position->name : '-';
            })
            ->editColumn('dep_id', function ($each) {
                return $each->department ? $each->department->name : '-';
            })
            ->editColumn('is_present', function ($each) {
                return $each->is_present ? "<span class='badge bg-success rounded-pill me-1 mb-1'>Present</span>" : "<span class='badge bg-danger rounded-pill me-1 mb-1'>Leave</span>";
            })
            ->addColumn('role', function ($each) {
                $roles = $each->roles->pluck('name');
                $output = '';
                foreach ($roles as $name) {
                    $output .= "<span class='badge bg-info rounded-pill me-1 mb-1'>$name</span>";
                }
                return $output;

            })
            ->addColumn('action', function ($each) {
                $show_icon = '';
                $edit_icon = '';
                $del_icon = '';

                if (auth()->user()->can('user_show')) {
                    $show_icon = '<a href="' . route('admin.users.show', $each->id) . '" class="text-warning me-3"><i class="bx bxs-show fs-4"></i></a>';
                }

                if (auth()->user()->can('user_edit')) {
                    $edit_icon = '<a href="' . route('admin.users.edit', $each->id) . '" class="text-info me-3"><i class="bx bx-edit fs-4" ></i></a>';
                }

                if (auth()->user()->can('user_delete')) {
                    $del_icon = '<a href="" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="bx bxs-trash-alt fs-4" ></i></a>';
                }

                return '<div class="action-icon text-nowrap">' . $show_icon . $edit_icon . $del_icon . '</div>';
            })
            ->rawColumns(['profile', 'is_present', 'role', 'action'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        $departments = Department::pluck('name', 'id');
        $positions = Position::pluck('name', 'id');
        return view('admin.users.create', compact('roles', 'departments', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create($request->all());

            $user->syncRoles($request->roles);

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User Created Successfully');
        } catch (\Exception $err) {
            dd($err->getMessage());
            return back()->with('fail', 'Something Wrong')->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = $user->load('roles', 'department', 'position');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        $user = $user->load('roles');
        $departments = Department::pluck('name', 'id');
        $positions = Position::pluck('name', 'id');

        return view('admin.users.edit', compact('roles', 'user', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->update($request->all());

            $user->syncRoles($request->roles);

            DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User Updated Successfully');
        } catch (\Exception $err) {
            dd($err->getMessage());
            return back()->with('fail', 'Something Wrong')->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
