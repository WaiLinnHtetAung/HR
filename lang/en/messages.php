<?php

return [
    'company_setting' => [
        'title' => 'Company Setting',
        'fields' => [
            'name' => 'Company Name',
            'email' => 'Company Email',
            'address' => 'Company Address',
            'phone' => 'Company Phone',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'break_start_time' => 'Start Break Time',
            'break_end_time' => 'End Break Time',
        ],
    ],

    'employee' => [
        'title' => 'Employees',
        'fields' => [
            'name' => 'Name',
            'profile' => 'Profile',
            'email' => 'Email',
            'phone' => 'Phone',
            'employee_id' => 'Employee ID',
            'nrc' => 'NRC Number',
            'address' => 'Address',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
            'department' => 'Department',
            'is_present' => 'Is Present',
            'role' => 'Role',
            'join_date' => 'Join Date',
            'position' => 'Position',
        ],
    ],

    'position' => [
        'title' => 'Positions',
        'fields' => [
            'name' => 'Name',
        ],
    ],

    'department' => [
        'title' => 'Departments',
        'title_singular' => 'Department',
        'fields' => [

        ],
    ],

    'attendance' => [
        'title' => 'Attendance',
        'fields' => [
            'employee' => 'Employee Name',
            'date' => 'Date',
            'checkin_time' => 'Checkin Time',
            'checkout_time' => 'Checkout Time',
            'overview' => 'Attendance Overview',
        ],
    ],

    'attendance_scan' => [
        'title' => 'Attendance Scan',
    ],

];
