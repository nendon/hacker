<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Contributor;
use App\Models\ProjectSection;
use App\Models\Member;
use App\Models\ProjectUser;
use App\Models\Bootcamp;

class UserNotifProject extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Member $member,Bootcamp $bootcamp, ProjectSection $project,  Contributor $contrib)
    {
        $this->member = $member;
        $this->project = $project;
        $this->contrib = $contrib;
        $this->bootcamp = $bootcamp;
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
        $url = url('/bootcamp/course/');
        return (new MailMessage)
                    ->subject(sprintf('Project Anda telah dikirim untuk Bootcamp %s', $this->bootcamp->title))
                    ->greeting(sprintf('Hello %s', $this->member->username))
                    ->line('Harap menunggu dalam 1x24 jam untuk mendapatkan hasilnya dari pemeriksaan Instruktur. Apabila di ACC oleh instruktur, maka Anda bisa melanjutkan pembelajaran ke materi berikutnya. Apabila di tolak, maka Anda bisa kerjakan ulang dan submit ulang sesuai hasil komentar yang diberikan oleh Instruktur.')
                    ->action('lihat Dashboard', $url)
                    ->line('Terima Kasih telah menggunakan aplikasi kami! Anda akan mendapatkan pemberitahuannya melalui email.');
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
