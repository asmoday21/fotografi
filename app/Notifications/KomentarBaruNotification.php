<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class KomentarBaruNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database']; // pakai database, bisa ditambah mail atau broadcast
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => '💬 Komentar baru oleh ' . $this->comment->user->name,
            'materi_id' => $this->comment->materi_id,
            'comment_id' => $this->comment->id,
            'user_id' => $this->comment->user_id,
        ];
    }
}
