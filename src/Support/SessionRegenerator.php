<?php

namespace Support;

use App\Events\AfterSessionRegenerated;
use Illuminate\Support\Facades\Event;

class SessionRegenerator
{
    public static function run(callable $callback = null): void
    {
        $old = session()->getId();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        if (!is_null($callback)) {
           $callback();
        }

        event(new AfterSessionRegenerated(
            $old,
            session()->getId()
        ));
    }
}
