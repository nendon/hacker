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

class ContribProject extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Member $member, ProjectSection $project,  Contributor $contrib)
    {
        $this->member = $member;
        $this->project = $project;
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
        $url = url('/bootcamp/course/'.$this->project->section_id);
        return (new MailMessage)
                    ->subject('Notification From Cilsy Fiolution')
                    ->greeting(sprintf('Hello %s', $this->member->username))
                    ->line(sprintf('Halo, %s projectmu sudah di review oleh Instruktur %s,',$this->member->username, $this->project->komentar_user))
                    ->action('lihat lengkapnya', $url)
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
