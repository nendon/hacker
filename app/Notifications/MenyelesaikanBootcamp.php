<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\BootcampMember;
use App\Models\Bootcamp;
use App\Models\Section;
use App\Models\Member;
use App\Models\Course;

class MenyelesaikanBootcamp extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Member $member, Bootcamp $bootcamp)
    {
        $this->member = $member;
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
        $url = url('/bootcamp/'.$this->bootcamp->slug.'/courseSylabus');

        return (new MailMessage)
            ->subject(sprintf("You're a Rockstar! Anda telah lulus dari program Bootcamp %s di Cilsy", $this->bootcamp->title))
            ->greeting(sprintf('Halo %s', $this->member->username))
            ->line(sprintf('Selamat atas kelulusan Anda dalam Bootcamp %s di Cilsy! Perjalanan ini tidaklah mudah, dan Anda telah berhasil melaluinya', $this->bootcamp->title))
            ->line('Anda berhak untuk mendapatkan reward berupa sertifikat kelulusan serta akses untuk kami bantu salurkan magang dan kerja.')
            ->line('Untuk download sertifikat dapat Anda klik dari tombol berikut, sedangkan terkait bantuan penyaluran magang dan kerja akan kami berikan info berikutnya.')
            ->action('Download Sertifikat Kelulusan', $url);
                    
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
