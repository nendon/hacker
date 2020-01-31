<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Contributor;
use App\Models\CommentBootcamp;
use App\Models\Bootcamp;
use App\Models\Member;

class UserCommentBootcamp extends Notification implements ShouldQueue
{
    use Queueable;
    public $member, $comment, $contrib, $lesson;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Member $member, CommentBootcamp $comment, Contributor $contrib, Bootcamp $lesson)
    {
        $this->member = $member;
        $this->comment = $comment;
        $this->contrib = $contrib;
        $this->lesson = $lesson;
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

    public function toDatabase($notifiable)
    {
        return [
            'username' => $this->member->username,
            'title' => $this->lesson->title,
            'comment_id' => $this->comment->id,
        ];
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/contributor/bootcamp/comments/detail/'.$this->comment->id);
        return (new MailMessage)
                    ->subject(sprintf('Pesan baru dari Murid Anda di Bootcamp %s', $this->lesson->title))
                    ->greeting(sprintf('Hello %s', $this->contrib->first_name))
                    ->line(sprintf('Murid Anda yang bernama %s telah mengirimkan pesan baru untuk Bootcamp %s, Harap untuk segera memberikan jawaban maksimal dalam 1x24 jam agar masalah mereka dapat segera teratasi.
                    ', $this->member->username, $this->lesson->title))
                    ->action('Balas Pesan', $url)
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
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'username' => $this->member->username,
                'title' => $this->lesson->title,
                'comment_id' => $this->comment->id,
            ],
        ];

    }
}
