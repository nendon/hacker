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

class MenyelesaikanCourse extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Member $member, Bootcamp $bootcamp, BootcampMember $bootcampMember, Course $course)
    {
        $this->member = $member;
        $this->bootcamp = $bootcamp;
        $this->bootcampMember = $bootcampMember;
        $this->course = $course;
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
            ->subject(sprintf('Selamat! Anda telah menyelesaikan Course Part %s %s dalam Bootcamp %s di Cilsy', $this->course->position, $this->course->title, $this->bootcamp->title))
            ->line(sprintf('Anda melakukannya dengan baik, %s. Semua materi dan tugas/project di Course Part %s %s telah Anda selesaikan.', $this->member->username, $this->course->position, $this->course->title))
            ->line("it's time to take a break and reward yourself.")
            ->line('Jika Anda sudah siap kembali, silahkan lanjut pembelajaran ke Course berikutnya ya.')
            ->action('Lanjutkan Pembelajaran', $url);
                    
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
