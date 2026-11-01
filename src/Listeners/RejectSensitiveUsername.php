<?php

namespace Hooey\SensitiveWords\Listeners;

use Flarum\Foundation\ValidationException;
use Flarum\User\Event\Saving;
use Flarum\User\Guest;
use Hooey\SensitiveWords\SensitiveWords;

/**
 * Backend-enforced sensitive-word filter for self-registration.
 *
 * Mirrors the invite-validation listener pattern: only enforces when a
 * guest creates a new user (admin-created users and OAuth token
 * registrations bypass it). Frontend input cannot bypass this check.
 */
class RejectSensitiveUsername
{
    public function handle(Saving $event): void
    {
        $user = $event->user;

        if ($user->exists) {
            return;
        }

        if (! ($event->actor instanceof Guest)) {
            return;
        }

        $attrs = $event->data['attributes'] ?? [];

        if (! empty($attrs['token'])) {
            return;
        }

        $username = (string) ($attrs['username'] ?? $user->username ?? '');

        if ($username !== '' && SensitiveWords::contains($username)) {
            throw new ValidationException(['username' => '用户名含敏感词，请更换。']);
        }
    }
}
