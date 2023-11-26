<?php

namespace App\Mail;

use App\Models\User;   // p213 taka

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyTweetCount extends Mailable implements ShouldQueue  // ShouldQueue 追記(p213 taka)
{
    use Queueable, SerializesModels;

    public User $toUser;  // p213 taka
    public int $count;    // p213 taka

    /**
     * Create a new message instance.
     */
    public function __construct(User $toUser, int $count) // 引数を追記 p213 taka
    {
        $this->toUser = $toUser;
        $this->count = $count;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // subject: 'Daily Tweet Count',
            subject: "昨日は{$this->count}件のつぶやきが追加されました！", // p213 taka
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // view: 'view.name',
            // subject: "昨日は{$this->count}件のつぶやきが追加されました！",
            markdown: 'email.daily_tweet_count',
        );
    }

    public function build()
    {
        return $this->subject("昨日は{$this->count}件のつぶやきが追加されました！")
                 ->markdown('email.daily_tweet_count');
    }
    
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
