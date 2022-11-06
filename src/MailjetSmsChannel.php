<?php

declare(strict_types=1);

namespace YieldStudio\LaravelMailjetNotifier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notification;

final class MailjetSmsChannel
{
    protected MailjetService $mailjetService;

    /**
     * Create a new mail channel instance.
     *
     * @param  MailjetService  $mailjetService
     *
     * @return void
     */
    public function __construct(MailjetService $mailjetService)
    {
        $this->mailjetService = $mailjetService;
    }

    /**
     * @throws MailjetException
     */
    public function send(Model|AnonymousNotifiable $notifiable, Notification $notification): void
    {
        $message = $notification->toMailjetSms($notifiable); // @phpstan-ignore-line

        $this->mailjetService->sendSms($message);
    }
}
