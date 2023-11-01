<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAttendanceRequest;
use App\Http\Requests\Admin\UpdateAttendanceRequest;
use App\Models\CheckInCheckout;
use App\Models\CompanySetting;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DataTables;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.attendances.index');
    }

    public function dataTable()
    {
        $data = CheckInCheckout::with('employee');

        return Datatables::of($data)
            ->filterColumn('employee_name', function ($query, $keyword) {
                $query->whereHas('employee', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })
            ->editColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('employee_name', function ($each) {
                return $each->employee ? $each->employee->name : '';
            })
            ->addColumn('action', function ($each) {
                $show_icon = '';
                $edit_icon = '';
                $del_icon = '';

                if (auth()->user()->can('attendance_show')) {
                    $show_icon = '<a href="' . route('admin.attendances.show', $each->id) . '" class="text-warning me-3"><i class="bx bxs-show fs-4"></i></a>';
                }

                if (auth()->user()->can('attendance_edit')) {
                    $edit_icon = '<a href="' . route('admin.attendances.edit', $each->id) . '" class="text-info me-3"><i class="bx bx-edit fs-4" ></i></a>';
                }

                if (auth()->user()->can('attendance_delete')) {
                    $del_icon = '<a href="" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="bx bxs-trash-alt fs-4" ></i></a>';

                }

                return '<div class="action-icon">' . $show_icon . $edit_icon . $del_icon . '</div>';
            })
            ->make(true);
    }

    /**
     * attendance overview page
     */

    public function overview()
    {
        if (!auth()->user()->can('attendance_overview_access')) {
            abort(403);
        }
        $employee = User::pluck('name', 'id');

        return view('admin.attendances.overview', compact('employee'));
    }

    /**
     * attendance overview table for ajax call
     */
    public function overviewTable(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $month_start_date = $year . '-' . $month . '-' . '01';
        $month_end_date = Carbon::parse($month_start_date)->endOfMonth()->format('Y-m-d');

        $employee = User::where('name', 'like', "%$request->employee%")->pluck('name', 'id');
        $periods = new CarbonPeriod($month_start_date, $month_end_date);
        $attendances = CheckInCheckout::whereMonth('date', $month)->whereYear('date', $year)->get();
        $company_setting = CompanySetting::findOrFail(1);

        return view('components.attendance_overview', compact('employee', 'periods', 'attendances', 'company_setting'))->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employee = User::pluck('name', 'id');

        return view('admin.attendances.create', compact('employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {

        if (CheckInCheckout::where('user_id', $request->user_id)->where('date', $request->date)->exists()) {
            return back()->with('fail', 'Already defined')->withInput();
        }

        $attendance = CheckInCheckout::create([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'checkin_time' => $request->date . ' ' . $request->checkin_time,
            'checkout_time' => $request->date . ' ' . $request->checkout_time,
        ]);

        return redirect()->route('admin.attendances.index')->with('success', 'Attendance created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $attendance = CheckInCheckout::with('employee')->findOrFail($id);

        return view('admin.attendances.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = User::pluck('name', 'id');
        $attendance = CheckInCheckout::findOrFail($id);

        return view('admin.attendances.edit', compact('employee', 'attendance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, $id)
    {
        CheckInCheckout::where('id', $id)->update([
            'checkin_time' => $request->date . ' ' . $request->checkin_time,
            'checkout_time' => $request->date . ' ' . $request->checkout_time,
        ]);

        return redirect()->route('admin.attendances.index')->with('success', 'Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CheckInCheckout::findOrFail($id)->delete();

        return 'success';
    }
}
