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

class MembeliBootcamp extends Notification
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
        // $url = url('/bootcamp/'.$this->bootcamp->slug.'/courseSylabus');

        return (new MailMessage)
            ->subject(sprintf('Selamat bergabung dalam Bootcamp %s di Cilsy!', $this->bootcamp->title))
            ->greeting(sprintf('Halo %s', $this->member->username))
            ->line(sprintf('Anda telah membeli Bootcamp : %s', $this->bootcamp->title))
            ->line('Bootcamp di Cilsy di desain untuk bisa menciptakan talenta-talenta teknologi baru yang berkualitas.')
            ->line('Talenta yang siap berkarir di industri, bisa membuka jasa freelance sendiri, bahkan membangun Startup Digital sendiri.')
            ->line('Tips untuk dapat menjalani Bootcamp ini dengan baik hanya 2 : Prioritaskan bootcamp ini di jadwal Anda dan have fun dalam menjalaninya.')
            ->line('Selamat Belajar dan tetap semangat!');
            // ->action('Mulai Belajar', $url);
                    
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
