<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckInCheckout;
use App\Models\CompanySetting;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DataTables;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    /**
     * datatable for employee
     */

    public function dataTable(Request $request)
    {
        $data = CheckInCheckout::with('employee')->where('user_id', auth()->user()->id);

        if ($request->month) {
            $data = $data->whereMonth('date', $request->month);
        }

        if ($request->year) {
            $data = $data->whereYear('date', $request->year);
        }

        return Datatables::of($data)
            ->editColumn('plus-icon', function ($each) {
                return null;
            })
            ->filterColumn('employee', function ($query, $keyword) {
                $query->whereHas('employee', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })
            ->addColumn('employee', function ($each) {
                return $each->employee ? $each->employee->name : '';
            })

            ->make(true);
    }

    /**
     * employee attendance overview
     */
    public function overviewTable(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $month_start_date = $year . '-' . $month . '-' . '01';
        $month_end_date = Carbon::parse($month_start_date)->endOfMonth()->format('Y-m-d');

        $employee = User::where('id', auth()->user()->id)->pluck('name', 'id');
        $periods = new CarbonPeriod($month_start_date, $month_end_date);
        $attendances = CheckInCheckout::whereMonth('date', $month)->whereYear('date', $year)->get();
        $company_setting = CompanySetting::findOrFail(1);

        return view('components.attendance_overview', compact('employee', 'periods', 'attendances', 'company_setting'))->render();
    }
}
