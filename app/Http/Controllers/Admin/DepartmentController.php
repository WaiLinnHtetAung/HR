<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDepartmentRequest;
use App\Http\Requests\Admin\UpdateDepartmentRequest;
use App\Models\Department;
use DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.departments.index');
    }

    /**
     * get dep infos
     *
     * @return void
     */
    public function dataTable()
    {
        $data = Department::query();

        return Datatables::of($data)
            ->editColumn('plus-icon', function ($each) {
                return null;
            })
            ->addIndexColumn()
            ->addColumn('action', function ($each) {
                $show_icon = '';
                $edit_icon = '';
                $del_icon = '';

                if (auth()->user()->can('department_show')) {
                    $show_icon = '<a href="' . route('admin.departments.show', $each->id) . '" class="text-warning me-3"><i class="bx bxs-show fs-4"></i></a>';
                }

                if (auth()->user()->can('department_edit')) {
                    $edit_icon = '<a href="' . route('admin.departments.edit', $each->id) . '" class="text-info me-3"><i class="bx bx-edit fs-4" ></i></a>';
                }

                if (auth()->user()->can('department_delete')) {
                    $del_icon = '<a href="" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="bx bxs-trash-alt fs-4" ></i></a>';

                }

                return '<div class="action-icon">' . $show_icon . $edit_icon . $del_icon . '</div>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        Department::create($request->all());

        return redirect()->route('admin.departments.index')->with('success', 'Department added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('admin.departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->all());

        return redirect()->route('admin.departments.index')->with('success', 'Updated Department Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return 'success';
    }
}
