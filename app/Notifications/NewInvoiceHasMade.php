<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewInvoiceHasMade extends Notification
{
    use Queueable;

    public $invoic;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( \App\Invoice $invoice )
    {
        $this->invoice = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $notifiable->email = 'ahmed@gmail.com';
        // $notifiable->username = 'ahmed@gmail.com';
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->success()
                    ->greeting( 'Hey Mr / Mrs '. $notifiable->username  )
                    ->line('New Invoice Has been Paid With total of ' . $this->invoice->net . '.')
                    ->action('View Invoice', url()->to( '/invoice/' . $this->invoice->id ))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
