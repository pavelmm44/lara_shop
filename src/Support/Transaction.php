<?php

namespace Support;

use Illuminate\Support\Facades\DB;
use Throwable;

class Transaction
{
    public static function run(
        callable $callback,
        callable $finished = null,
        callable $onError = null,
    )
    {
        try {
            DB::beginTransaction();

            return tap($callback(), function ($result) use ($finished) {

                if (!is_null($finished)) {
                    $finished($result);
                }

                DB::commit();
            });
        } catch (Throwable $e) {
            DB::rollBack();

            $onError($e);
            throw $e;
        }
    }
}
