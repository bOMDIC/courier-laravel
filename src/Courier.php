<?php

namespace GoMore\LaravelCourier;

use GoMore\LaravelCourier\Models\Email;
use GoMore\LaravelCourier\Services\EmailService;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;

class Courier
{
    public function __construct()
    {

    }

    /**
     * @throws \Exception
     */
    public function notifyWithEmail(array $tos, string $subject, string $content, array $options = []): Response
    {
        $email = new Email([
            'tos' => $tos,
            'subject' => $subject,
            'content' => $content,
            'options' => $options,
        ]);

        $emailService  = new EmailService();

        return $emailService->sendMail($email);
    }

    public function mute(): static
    {
        Config::set('courier.mute', true);

        return $this;
    }
}
