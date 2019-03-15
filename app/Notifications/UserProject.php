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
class UserProject extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Member $member, ProjectSection $project,  Bootcamp $bootcamp,  Contributor $contrib)
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
        $url = url('/contributor/project/submit/'.$this->project->section_id.'/detail/'.$this->project->id);
        return (new MailMessage)
                    ->subject(sprintf('Murid Anda mengirimkan Project Baru di Bootcamp %s', $bootcamp->title ))
                    ->greeting(sprintf('Hello %s', $this->contrib->username))
                    ->line(sprintf('Murid Anda yang bernama %s telah mengirimkan tugas/project baru untuk Bootcamp %s, mengerjakan projek %s . Harap untuk segera memeriksa dan memberikan hasilnya maksimal dalam 1x24 jam agar mereka dapat melanjutkan kembali pembelajaran.',$this->member->username,  $this->$bootcamp->title, $this->project->title))
                    ->action('Periksa Project', $url)
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
