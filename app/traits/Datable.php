<?php

namespace App\Traits;

use Carbon\Carbon;

trait Datable
{
    public function dayOfWeeks()
    {
        return ['日', '月', '火', '水', '木', '金', '土'];
    }

    public function createCalendar($yyyymm)
    {
        $date = new Carbon("{$yyyymm}01");
        $addDay = ($date->copy()->endOfMonth()->isSunday()) ? 7 : 0;
        $date->subDay($date->dayOfWeek);

        $count = 31 + $addDay + $date->dayOfWeek;
        $count = ceil($count / 7) * 7;
        $calendar = [];

        for ($i = 0; $i < $count; $i++, $date->addDay()) {
            $calendar[] = $date->copy()->format('Y-m-d');
        }

        return $calendar;
    }

    public function createDateList($yyyymm)
    {
        $date = (new Carbon("{$yyyymm}01"));
        $list = [];
        $end_day = $date->copy()->endOfMonth()->day;
        for ($i = 1; $i <= $end_day; $i++, $date->addDay()) {
            $list[] = $date->copy()->format('Y-m-d');
        }
        return $list;
    }

    public function createMonthsList($yyyymm)
    {
        $list = [];
        $current_date = (new Carbon)->firstOfMonth();
        $date = new Carbon("{$yyyymm}01");

        $list['items'][] = [
            'display' => $current_date->format('Y年n月'),
            'value'   => $current_date->format('Ym'),
        ];

        $list['selected'] = [
            'display' => $date->format('Y年n月'),
            'value'   => $date->format('Ym'),
        ];

        for ($i = 0; $i < 5; $i++, $date->subMonth()) {
            if ($date == $current_date) { $i--; continue; }
            $list['items'][] = [
                'display' => $date->format('Y年n月'),
                'value'   => $date->format('Ym'),
            ];
        }
        return $list;
    }
}
