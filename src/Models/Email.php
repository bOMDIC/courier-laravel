<?php

namespace GoMore\LaravelCourier\Models;

use Illuminate\Support\Facades\Date;

class Email
{
    protected array $tos = [];

    protected string $subject = '';

    protected string $content = '';

    protected array $options = [];

    protected bool $isHTML = true;

    protected string $sendAt = '';

    public function __construct(array $params = null)
    {
        $this->setTos($params['tos'] ?? []);
        $this->setSubject($params['subject'] ?? '');
        $this->setContent($params['content'] ?? '');
        $this->setOptions($params['options'] ?? []);
    }

    /**
     * @param array|string $tos
     */
    public function setTos(array|string $tos): void
    {
        if (is_string($tos)) {
            $tos = [$tos];
        }

        $this->tos = $tos;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject = ''): void
    {
        $this->subject = $subject;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content = ''): void
    {
        $this->content = $content;
    }

    /**
     * @param array|null $options
     */
    public function setOptions(array $options = null): void
    {
        $this->isHTML = $options['isHTML'] ?? true;
        $this->sendAt = $options['sendAt'] ?? Date::now()->toIso8601ZuluString();
    }

    public function getPayload(): array
    {
        return [
            'from' => 'GoMore',
            'tos' => $this->tos,
            'subject' => $this->subject,
            'content' => $this->content,
            'isHTML' => $this->isHTML,
            'sendAt' => $this->sendAt,
        ];
    }
}
