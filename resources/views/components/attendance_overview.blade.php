<table class="table table-bordered table-striped w-100 " id="DataTable">
    <thead>
        <th style="vertical-align: middle;">Employee</th>
        @foreach ($periods as $period)
            <th
                class="text-nowrap text-center {{ $period->format('D') == 'Sat' || $period->format('D') == 'Sun' ? 'bg-danger text-white' : '' }}">
                <div style="font-size: 12px;">{{ $period->format('M') }}</div>
                <div style="font-size: 12px;">{{ $period->format('d') }}</div>
                <div style="font-size: 12px;">{{ $period->format('D') }}</div>
            </th>
        @endforeach
    </thead>
    <tbody>
        @foreach ($employee as $key => $value)
            <tr>
                <td>{{ $value }}</td>

                @foreach ($periods as $period)
                    @php
                        $checkin_icon = '';
                        $checkout_icon = '';

                        $office_start_time = $period->format('Y-m-d') . ' ' . $company_setting->start_time;
                        $office_end_time = $period->format('Y-m-d') . ' ' . $company_setting->end_time;
                        $break_start_time = $period->format('Y-m-d') . ' ' . $company_setting->break_start_time;
                        $break_end_time = $period->format('Y-m-d') . ' ' . $company_setting->break_end_time;

                        $attendance = collect($attendances)
                            ->where('date', $period->format('Y-m-d'))
                            ->where('user_id', $key)
                            ->first();
                        if ($attendance) {
                            if ($attendance->checkin_time < $office_start_time) {
                                $checkin_icon = "<i class='bx bxs-check-circle' style='color: #17b611;'></i>";
                            } elseif ($attendance->checkin_time > $office_start_time && $attendance->checkin_time < $break_start_time) {
                                $checkin_icon = "<i class='bx bxs-check-circle' style='color: #CECE3D;' title='Late Checkin'></i>";
                            } elseif ($attendance->checkin_time >= $break_start_time) {
                                $checkin_icon = "<i class='bx bxs-x-circle text-danger' title=''></i>";
                            }

                            if ($attendance->checkout_time < $break_end_time) {
                                $checkout_icon = "<i class='bx bxs-x-circle text-danger'></i>";
                            } elseif ($attendance->checkout_time > $break_end_time && $attendance->checkout_time < $office_end_time) {
                                $checkout_icon = "<i class='bx bxs-check-circle' style='color: #CECE3D;' title='Elarly Checkout'></i>";
                            } elseif ($attendance->checkout_time > $office_end_time) {
                                $checkout_icon = "<i class='bx bxs-check-circle' style='color: #17b611;'></i>";
                            }
                        }

                    @endphp
                    <td>
                        <div class="cursor-pointer">{!! $checkin_icon !!}</div>
                        <div class="cursor-pointer">{!! $checkout_icon !!}</div>
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
