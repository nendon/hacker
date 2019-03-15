<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Contributor;
use App\Models\Bootcamp;
use App\Models\Member;

class ContriReplyBootcamp extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Member $member, Bootcamp $lesson, Contributor $contrib)
    {
        $this->member = $member;
        $this->lesson = $lesson;
        $this->contrib = $contrib;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
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
        $url = url('/Bootcamp/'.$this->lesson->slug.'/courseSylabus');
        return (new MailMessage)
                    ->subject('Anda menerima Pesan baru')
                    ->greeting(sprintf('Hello %s', $this->member->username))
                    ->line(sprintf('Pesan anda mendapatkan tanggapan baru. %s Kontributor telah membalas anda pada bootcamp %s,',$this->member->username, $this->lesson->title))
                    ->action('Balas Komentar', $url)
                    ->line('Terima Kasih telah menggunakan aplikasi kami!');
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
