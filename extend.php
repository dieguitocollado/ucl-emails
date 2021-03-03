<?php

/*
 * This file is part of fof/disposable-emails.
 *
 * Copyright (c) 2019 FriendsOfFlarum.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace diegoco\ucl-email;

use Flarum\Extend;
use Flarum\Foundation\ValidationException;
use Flarum\User\Event\Saving;
use Illuminate\Support\Arr;

return [
    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\Event())
        ->listen(Saving::class, function (Saving $event) {
            $email = Arr::get($event->data, 'attributes.email');

            if ($email !== null && !preg_match("/\@ucl\.ac\.uk$/", $email)) {
                throw new ValidationException(["You must use a UCL email address."]);
            }
        }),
];
