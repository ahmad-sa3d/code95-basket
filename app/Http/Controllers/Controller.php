<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Make Session Notification
    public function makeNotification( $type, $message, $link = null )
    {
    	Session::put( 'notification', compact( 'type', 'message', 'link' ) );
    }

    // Make Session Success Notification
    public function makeSuccessNotification( $message, $link = null )
    {
    	$this->makeNotification( 'success', $message, $link );
    }

    // Make Session Error Notification
    public function makeErrorNotification( $message, $link = null )
    {
    	$this->makeNotification( 'danger', $message, $link );
    }

    // Make Session Error Notification
    public function makeWarningNotification( $message, $link = null )
    {
    	$this->makeNotification( 'warning', $message, $link );
    }
}
