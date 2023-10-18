<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePositionRequest;
use App\Http\Requests\Admin\UpdatePositionRequest;
use App\Models\Position;
use DataTables;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.positions.index');
    }

    /**
     * Get position data with datatable
     */
    public function dataTable()
    {
        $data = Position::query();

        return Datatables::of($data)
            ->editColumn('plus-icon', function ($each) {
                return null;
            })
            ->addIndexColumn()
            ->addColumn('action', function ($each) {
                $show_icon = '';
                $edit_icon = '';
                $del_icon = '';

                if (auth()->user()->can('position_show')) {
                    $show_icon = '<a href="' . route('admin.positions.show', $each->id) . '" class="text-warning me-3"><i class="bx bxs-show fs-4"></i></a>';
                }

                if (auth()->user()->can('position_edit')) {
                    $edit_icon = '<a href="' . route('admin.positions.edit', $each->id) . '" class="text-info me-3"><i class="bx bx-edit fs-4" ></i></a>';
                }

                if (auth()->user()->can('position_delete')) {
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
        return view('admin.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePositionRequest $request)
    {
        Position::create($request->all());

        return redirect()->route('admin.positions.index')->with('success', 'Position Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Position $position)
    {
        return view('admin.positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('admin.positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionRequest $request, Position $position)
    {
        $position->update($request->all());

        return redirect()->route('admin.positions.index')->with('success', 'Updated Postion Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return 'success';
    }
}
