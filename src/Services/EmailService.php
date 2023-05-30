<?php

namespace GoMore\LaravelCourier\Services;

use GoMore\LaravelCourier\Exceptions\HostInvalidException;
use GoMore\LaravelCourier\Models\Email;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EmailService
{
    protected string $host;
    protected bool $mute;

    /**
     * @throws HostInvalidException
     */
    public function __construct()
    {
        $this->host = Config::get('courier.host', '');
        $this->mute = Config::get('courier.mute', false);

        if (empty($this->host)) {
            throw new HostInvalidException('env `host` was not found');
        }
    }

    public function sendMail(Email $email): Response
    {
        $tag = 'GoMore\LaravelCourier\Services\EmailService@sendMail';

        $endpoint = $this->host . '/api/mails';

        $payload = $email->getPayload();

        $logStack = ['tag' => $tag, 'payload' => $payload];

        try {
            $response = Http::post($endpoint, $payload);

            if (!$this->mute) {
                Log::info($response, $logStack);
            }

            return $response;
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $logStack);

            throw $e;
        }
    }
}
