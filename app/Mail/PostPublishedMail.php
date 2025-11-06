<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostPublishedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Post $post;
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Post Published Mail',
        );
    }
    public function content(): Content
    {
        return new Content(
            view: 'auth.status-updated-email',
            with: ['post' => $this->post]
        );
    }
    public function attachments(): array
    {
        return [];
    }
}
