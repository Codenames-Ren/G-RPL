<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

class VerifyEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // Generate signed verification URL
        $verifyUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1(
                    $notifiable->getEmailForVerification()
                ),
            ]
        );

        return (new MailMessage)
            ->subject('Verifikasi Email Akun G-RPL')
            ->greeting('Halo, ' . $notifiable->name . ' 👋')
            ->line('Terima kasih telah mendaftar di sistem G-RPL.')
            ->line('Silakan lakukan verifikasi email untuk mengaktifkan akun Anda dan melanjutkan proses pengajuan RPL.')
            ->action('Verifikasi Email', $verifyUrl)
            ->line('Link verifikasi ini berlaku selama 60 menit.')
            ->line('Apabila Anda tidak merasa melakukan pendaftaran akun, abaikan email ini.')
            ->salutation('Salam, Tim G-RPL');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}