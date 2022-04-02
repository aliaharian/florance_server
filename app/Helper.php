<?php

function findObjectByPos($array, $pos, $type = 'key')
{
    foreach ($array as $element) {
        if ($pos == $element->$type) {
            return $element;
        }
    }
    return false;
}

function enToFa($string)
{
    return strtr($string, array('0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹'));
}

function getMaterialTypes()
{
    $types = array();
    $type = new \stdClass();
    $type->name = 'cabin';
    $type->label = 'کابین';
    array_push($types, $type);
    $type = new \stdClass();
    $type->name = 'surface';
    $type->label = 'صفحه';
    array_push($types, $type);
    $type = new \stdClass();
    $type->name = 'bowl';
    $type->label = 'کاسه';
    array_push($types, $type);
    $type = new \stdClass();
    $type->name = 'mirror';
    $type->label = 'آینه';
    array_push($types, $type);
    $type = new \stdClass();
    $type->name = 'drawer';
    $type->label = 'کشو';
    array_push($types, $type);
    return $types;
}

function state_color($state)
{
    $state_color = 'info';
    switch ($state) {

        case 'canceled':
        case 'failed':
            $state_color = 'danger';
            break;

        case 'done':
            $state_color = 'success';
            break;

        case 'waitForPay2':
        case 'waitForPay1':
            $state_color = 'warning';
            break;
        default:
            $state_color = 'info';
            break;
    }
    return $state_color;
}

function state_p($state)
{
    $state_p = '';
    switch ($state) {
        case 'ordered':
            $state_p = 'ثبت سفارش';
            break;
        case 'pricing':
            $state_p = 'در انتظار قیمت گذاری';
            break;
        case 'pay1':
            $state_p = 'انجام پرداخت اول';
            break;
        case 'building':
            $state_p = 'در حال ساخت';
            break;
        case 'shipping':
            $state_p = 'در حال ارسال';
            break;
        case 'failed':
            $state_p = 'نا موفق';
            break;
        case 'pending':
            $state_p = 'در انتظار تایید';
            break;
        case 'done':
            $state_p = 'پایان یافته';
            break;
        case 'pay2':
            $state_p = 'انجام پرداخت دوم';
            break;
        case 'canceled':
            $state_p = 'کنسل شده';
            break;
        case 'waitForPay1':
            $state_p = 'در انتظار پرداخت اول';
            break;
        case 'waitForPay2':
            $state_p = 'در انتظار پرداخت دوم';
            break;
        default:
            $state_p = 'نامشخص';
            break;
    }
    return $state_p;
}

function states()
{
    $states = [
        'ordered',
        'pricing',
        'pay1',
        'building',
        'shipping',
        'failed',
        'pending',
        'done',
        'pay2',
        'canceled',
        'waitForPay1',
        'waitForPay2'
    ];
    return $states;
}

function states1()
{
    $states = [
        'pay1',
        'building',
        'shipping',
        'failed',
        'done',
        'pay2',
        'canceled',
        'waitForPay2'
    ];
    return $states;
}

function states2()
{
    $states = [
        'building',
        'shipping',
        'failed',
        'done',
        'pay2',
        'canceled',
    ];
    return $states;
}

function ticketStatus()
{
    $states = [
        'opened',
        'user_message',
        'admin_message',
        'pending',
        'closed'
    ];
    return $states;
}

function ticketStatusP($state)
{
    $state_p = '';
    switch ($state) {
        case 'opened':
            $state_p = 'باز شده';
            break;
        case 'user_message':
            $state_p = 'پاسخ کاربر';
            break;
        case 'admin_message':
            $state_p = 'پاسخ ادمین';
            break;
        case 'pending':
            $state_p = 'در حال بررسی';
            break;
        case 'closed':
            $state_p = 'بسته شده';
            break;
        default:
            $state_p = 'نامشخص';
            break;
    }
    return $state_p;
}

function ticket_state_color($state)
{
    $state_color = 'info';
    switch ($state) {
        case 'closed':
            $state_color = 'danger';
            break;

        case 'opened':
            $state_color = 'success';
            break;

        case 'admin_message':
        case 'pending':
            $state_color = 'warning';
            break;
        default:
            $state_color = 'info';
            break;
    }
    return $state_color;
}
