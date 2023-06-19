<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NotificationRecord;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listNotification()
    {
        $notifications = NotificationRecord::with('employee')
            ->join('users', 'notifications.user_id', '=', 'users.id')
            ->select('notifications.id', 'notifications.*', 'users.username')
            ->get();


        return view('app', compact('notifications'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteNotification($id)
    {
        $notification = NotificationRecord::findOrFail($id);

        if ($notification->noti_type == 1) {
            $redirectRoute = 'ListClaim';
        } else {
            $redirectRoute = 'ListLeave';
        }

        $notification->delete();

        return redirect()->route($redirectRoute)->with('success', 'Notification deleted successfully');
    }

    public function deleteAll(Request $request)
    {
        // Delete all notifications from the database
        NotificationRecord::truncate();

        // Redirect back to the previous page or a desired route
        return redirect()->back()->with('success', 'All notifications have been deleted.');
    }
}
