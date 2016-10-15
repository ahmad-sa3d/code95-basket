<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProductCriticalLimit extends Notification
{
    use Queueable;

    protected $product;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $product )
    {
        $this->product = $product;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // return [
        //     'id' => $this->product->id;
        //     'instock_quantity' => $this->product->instock_quantity;
        // ];
        return $this->product->toArray( [ 'id', 'instock_quantity', 'name' ] );
    }
}
