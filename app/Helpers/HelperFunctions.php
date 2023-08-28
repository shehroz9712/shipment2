<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

if (!function_exists('generate_otp')) {
    function generate_otp(Int $length = 6)
    {
        try {
            $new_otp_code = rand(000000, 999999);
            if (strlen($new_otp_code) < $length) {
                return generate_otp();
            }

            return $new_otp_code;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('generate_password')) {
    function generateStrongPassword(Int $length = 10)
    {
        try {
            $password = rand(00000000, 99999999);
            return $password;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('daysInMonth')) {
    function daysInMonth()
    {
        try {
            return Carbon::now()->daysInMonth;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('ToTimeString')) {
    function ToTimeString()
    {
        try {
            return Carbon::now()->ToTimeString();
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('ToDateString')) {
    function ToDateString()
    {
        try {
            return Carbon::now()->ToDateString();
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('getMonths')) {
    function getMonths()
    {
        try {
            $data = array();
            for ($i = 0; $i <= 11; $i++) {
                $month = Carbon::today()->startOfYear()->addMonth($i);
                $year = Carbon::today()->year;
                array_push($data, array(
                    'id' => $month->format('m'),
                    'month' => $month->shortMonthName,
                    'monthName' => $month->monthName,
                    'year' => $year,
                ));
            }
            return $data;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('getNextYears')) {
    function getNextYears()
    {
        try {
            $data = array();
            for ($i = 0; $i <= 4; $i++) {
                $year = Carbon::now()->addYear($i)->format('Y');
                array_push($data, array(
                    'year' => $year,
                ));
            }
            return $data;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('maskEmail')) {
    function mask_email($email, $char_shown_front = 2, $char_shown_back = 3)
    {
        try {
            $mail_parts = explode('@', $email);
            $username = $mail_parts[0];
            $url = $mail_parts[1];
            $len = strlen($username);

            if ($len < $char_shown_front or $len < $char_shown_back) {
                return implode('@', $mail_parts);
            }

            //Logic: show asterisk in middle, but also show the last character before @
            $mail_parts[0] = substr($username, 0, $char_shown_front)
            . str_repeat('*', $len - $char_shown_front - $char_shown_back)
            . substr($username, $len - $char_shown_back, $char_shown_back);

            return implode('@', $mail_parts);
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('maskEmail1')) {
    function mask_email2($email, $show = 3)
    {
        $arr = explode('@', $email);
        return substr($arr[0], 0, $show) . str_repeat('*', strlen($arr[0]) - $show) . $arr[1];
    }
}

if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (strlen($phoneNumber) > 10) {
            $countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);
            $areaCode = substr($phoneNumber, -10, 3);
            $nextThree = substr($phoneNumber, -7, 3);
            $lastFour = substr($phoneNumber, -4, 4);

            $phoneNumber = '+' . $countryCode . ' (' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
        } else if (strlen($phoneNumber) == 10) {
            $areaCode = substr($phoneNumber, 0, 3);
            $nextThree = substr($phoneNumber, 3, 3);
            $lastFour = substr($phoneNumber, 6, 4);

            $phoneNumber = '(' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
        } else if (strlen($phoneNumber) == 7) {
            $nextThree = substr($phoneNumber, 0, 3);
            $lastFour = substr($phoneNumber, 3, 4);

            $phoneNumber = $nextThree . '-' . $lastFour;
        }

        return $phoneNumber;
    }
}

if (!function_exists('pp')) {
    function pp($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        die('call');
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date, $format)
    {
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('slug')) {
    function slug(string $data)
    {
        return Str::slug($data);
    }
}

if (!function_exists('uploadSingleImage')) {
    function uploadSingleImage($file = null, $path = null)
    {
        try {
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $filename);

            return $filename;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('uploadMultipleImages')) {
    function uploadMultipleImages($files = null, $path = null)
    {
        try {
            foreach ($files as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move($path, $filename);
                $images[] = $filename;
            }
            return $images;
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('calculateAge')) {
    function calculateAge($dob)
    {
        try {
            return Carbon::parse($dob)->diff(Carbon::now())->format('%y Years, %m Months and %d Days');
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('strtotimeDate')) {
    function strtotimeDate($data)
    {
        try {
            return strtotime(Carbon::parse($data));
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('strtoupper')) {
    function uppercase($data)
    {
        try {
            return strtoupper($data);
        } catch (Exception $ex) {
            report($ex->getMessage());
        }
    }
}

if (!function_exists('urlQuery')) {
    function urlQuery($to, array $params = [], array $additional = [])
    {
        try {
            return Str::finish(url($to, $additional), '?') . Arr::query($params);
        } catch (Exception $ex) {
            report($ex->getMessage());
        }

    }
}

if (!function_exists('show_route')) {
    function show_route($model, $resource = null)
    {
        $resource = $resource ?? plural_from_model($model);

        return route("{$resource}.show", $model);
    }
}

if (!function_exists('plural_from_model')) {
    function plural_from_model($model)
    {
        $plural = Str::plural(class_basename($model));

        return Str::kebab($plural);
    }
}

if (!function_exists('schedule')) {
    function schedule($opening_time = null, $closing_time = null, $interval = null)
    {
        $opening_time = is_null($opening_time) ? '0:00' : $opening_time;
        $closing_time = is_null($closing_time) ? '23:59' : $closing_time;
        $interval = is_null($interval) ? '60' : $interval;
        $intervals = CarbonInterval::minutes($interval)->toPeriod($opening_time, $closing_time);

        $allTimes = [];
        foreach ($intervals as $date) {
            array_push($allTimes, $date->format('h:i A'));
        }
        return $allTimes;
    }
}

if (!function_exists('getTimeSlot')) {
    function getTimeSlot($interval, $start_time, $end_time)
    {
        $start = new DateTime($start_time);
        $end = new DateTime($end_time);
        $startTime = $start->format('H:i');
        $endTime = $end->format('H:i');
        $i = 0;
        $time = [];
        while (strtotime($startTime) <= strtotime($endTime)) {
            $start = $startTime;
            $end = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($startTime)));
            $startTime = date('H:i', strtotime('+' . $interval . ' minutes', strtotime($startTime)));
            $i++;
            if (strtotime($startTime) <= strtotime($endTime)) {
                $time[$i]['slot_start_time'] = $start;
                $time[$i]['slot_end_time'] = $end;
            }
        }
        return $time;
    }
}
