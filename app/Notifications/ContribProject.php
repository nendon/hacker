<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Contributor;
use App\Models\Bootcamp;
use App\Models\ProjectSection;
use App\Models\Member;

class ContribProject extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Member $member, Bootcamp $bootcamp, ProjectSection $project,  Contributor $contrib)
    {
        $this->member = $member;
        $this->bootcamp = $bootcamp;
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
        $url = url('/bootcamp/'.$this->bootcamp->slug.'/projectSubmit/'.$this->project->section_id);
        $url2 = url('/bootcamp/'.$this->bootcamp->slug.'/courseSylabus');

        return (new MailMessage)
                    ->subject('Project anda sudah di review')
                    ->greeting(sprintf('Hello %s', $this->member->username))
                    ->line('Selamat! Tugas/Project Anda telah di ACC oleh Instruktur. Sekarang Anda bisa melanjutkan pembelajaran ke materi berikutnya.')
                    ->action('Lihat Hasil Review Project', $url)
                    ->action('Akses Materi Berikutnya', $url2)
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
