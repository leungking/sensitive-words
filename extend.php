<?php

use Flarum\Extend;
use Flarum\User\Event\Saving;
use Hooey\SensitiveWords\Listeners\RejectSensitiveUsername;

return [
    (new Extend\Event())
        ->listen(Saving::class, RejectSensitiveUsername::class),
];
