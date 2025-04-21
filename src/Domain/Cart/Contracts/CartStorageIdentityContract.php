<?php

namespace Domain\Cart\Contracts;

interface CartStorageIdentityContract
{
    public function get(): string;
}
