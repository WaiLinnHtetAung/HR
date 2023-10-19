<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(CompanySetting $companySetting)
    {
        $company_setting = $companySetting;
        return view('admin.company.show', compact('company_setting'));
    }

    public function nameSave(Request $request)
    {
        $name = $request->name;

        if (!$name) {
            return 'fail';
        } else {
            CompanySetting::findOrFail(1)->update([
                'name' => $name,
            ]);

            return 'success';
        }
    }

    public function emailSave(Request $request)
    {
        try {
            $validation = $request->validate([
                'name' => 'required|email',
            ]);

            $name = $request->name;

            if (!$name) {
                return 'fail';
            } else {
                CompanySetting::findOrFail(1)->update([
                    'email' => $name,
                ]);

                return 'success';
            }

        } catch (\Exception $err) {
            return 'fail';
        }
    }

    public function phoneSave(Request $request)
    {
        $name = $request->name;

        if (!$name || strlen($name) < 6 || strlen($name) > 13) {
            return 'fail';
        } else {
            CompanySetting::findOrFail(1)->update([
                'phone' => $name,
            ]);

            return 'success';
        }
    }

    public function addressSave(Request $request)
    {
        $name = $request->name;

        if (!$name || strlen($name) < 6) {
            return 'fail';
        } else {
            CompanySetting::findOrFail(1)->update([
                'address' => $name,
            ]);

            return 'success';
        }
    }

    public function startTimeSave(Request $request)
    {
        $name = $request->name;

        if (!$name) {
            return 'fail';
        } else {
            CompanySetting::findOrFail(1)->update([
                'start_time' => $name,
            ]);

            return 'success';
        }

    }

    public function endTimeSave(Request $request)
    {
        $name = $request->name;

        if (!$name) {
            return 'fail';
        } else {
            CompanySetting::findOrFail(1)->update([
                'end_time' => $name,
            ]);

            return 'success';
        }

    }

    public function breakStartTimeSave(Request $request)
    {
        $name = $request->name;

        if (!$name) {
            return 'fail';
        } else {
            CompanySetting::findOrFail(1)->update([
                'break_start_time' => $name,
            ]);

            return 'success';
        }

    }

    public function breakEndTimeSave(Request $request)
    {
        $name = $request->name;

        if (!$name) {
            return 'fail';
        } else {
            CompanySetting::findOrFail(1)->update([
                'break_end_time' => $name,
            ]);

            return 'success';
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CompanySetting $companySetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CompanySetting $companySetting)
    {
        //
    }
}
