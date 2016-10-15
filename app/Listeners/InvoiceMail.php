<?php

namespace App\Listeners;

use App\Events\NewInvoiceHasMade;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceHasMade;

class InvoiceMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewInvoiceHasMade  $event
     * @return void
     */
    public function handle(NewInvoiceHasMade $event)
    {
        //
        // Mail::to( 'user@test.com' )->queue( new InvoiceHasMade( $event->invoice ) );
    }
}
