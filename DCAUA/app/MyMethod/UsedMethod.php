<?php

namespace App\MyMethod;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsedMethod
{
    public static function getNotifications($identy, $or_where)
    {
        $notifications = DB::table('notification')
            ->where($or_where[0], $identy)
            ->orwhere($or_where[0], $or_where[1])
            ->orderBy('created_at', 'desc')
            ->get();
        return $notifications;
    }
    public static function setSentTime($notifications)
    {
        foreach ($notifications as $notification) {
            $pastDate = Carbon::parse($notification->created_at);
            $currentDate = Carbon::parse(date('Y-m-d H:i:s'));
            $diff = $pastDate->diffForHumans($currentDate);
            // $time = preg_replace("/[^0-9]/", '', $diff);
            $notification->sent_time = $diff;
        }
        return $notifications;
    }
    public static function checkNewNotify($notifications, $check_id, $column_name)
    {
        foreach ($notifications as $notification) {
            $check_data = DB::table('notify_view')
                ->where('notify_id', $notification->id)
                ->where($column_name, $check_id)
                ->select('id')
                ->get();
            if (count($check_data) == 0) {
                $notification->new = "new";
            } else {
                $notification->new = "";
            }
        }
        return $notifications;
    }
    public static function viewNotification($notify_id, $district_id, $block_id)
    {
        $check = null;
        $message = null;
        $notification = DB::table('notify_view')
            ->where('notify_id', $notify_id)
            ->select('id')
            ->get();
        if (count($notification) == 0) {
            try {
                // DB::table('notify_view')
                //     ->where('notify_id', $notify_id)
                //     ->insert([
                //         'notify_id' => $notify_id,
                //         'district_code' => $district_id,
                //         'block_code' => $block_id
                //     ]);
                $check = true;
            } catch (Exception $e) {
                $check = false;
                $message = "Error Try Later ";
            }
        }
        return [$check, $message];
    }
    public static function getNotifyId($notify_id)
    {
        $notification = DB::table('notification as notify')
            ->where('notify.id', $notify_id)
            ->orWhere('notify.district_id', 999)
            ->where('notify.district_id', Auth::user()->district)
            ->select(
                'notify.*',
                'block_tab.block_name as block_name'
            )
            ->leftJoin('blocks as block_tab', 'block_tab.block_id', '=', 'notify.block_id')
            ->get();
        return $notification;
    }
}
