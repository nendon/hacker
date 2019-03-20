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

class MemulaiCourse extends Notification
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
        $url = url('/bootcamp/'.$this->bootcamp->slug.'/courseSylabus/');

        return (new MailMessage)
                    ->subject(sprintf('Anda telah memulai Course %s %s dalam Bootcamp %s di Cilsy', $this->course->position, $this->course->title, $this->bootcamp->title))
                    ->greeting(sprintf('Good job %s', $this->member->username))
                    ->line(sprintf('Anda telah selangkah lebih dekat dalam perjalanan menyelesaikan Bootcamp <nama %s.', $this->bootcamp->title))
                    ->line(sprintf('Dalam Course %s, Anda akan mempelajari : %s', $this->course->title, $this->course->deskripsi))
                    ->line(sprintf('Dan waktu untuk menyelesaikan Course ini adalah : %s Hari', $this->course->estimasi))
                    ->line(sprintf('Deadline : %s', $this->bootcampMember->target))
                    ->line('Segera pelajari seluruh materi course ini dan kerjakan exercise/project yang diberikan sebelum deadline diatas untuk bisa lanjut ke materi Course berikutnya ya.')
                    ->line('Keep going dan tetap semangat!')
                    ->action('Mulai Belajar', $url);
                    
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
