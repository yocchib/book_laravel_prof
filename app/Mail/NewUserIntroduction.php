<?php

namespace App\Mail;

use App\Models\User;  // p186 taka

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUserIntroduction extends Mailable implements ShouldQueue  // p202 taka Queueを使って非同期処理とする
{
    use Queueable, SerializesModels;

    public $subject = '新しいユーザーが追加されました！';

    public User $toUser;    // p186 taka
    public User $newUser;   // p186 taka

    // p186 taka  コンストラクタ引数２つ追加
    public function __construct(User $toUser, User $newUser)
    {
        $this->toUser = $toUser;
        $this->newUser = $newUser;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New User Introduction',
        );
    }

    /**
     * Get the message content definition.
     */
    // Laravel において、Mailable を継承するクラスのbuildメソッドがcontent に変わった？
    public function content(): Content
    {
        return new Content(
            // view: 'email.new_user_introduction',   
            markdown : 'email.new_user_introduction', // p189 taka
         
        );
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
