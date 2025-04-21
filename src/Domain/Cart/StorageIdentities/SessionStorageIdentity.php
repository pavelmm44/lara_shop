<?php

namespace Domain\Cart\StorageIdentities;

use Domain\Cart\Contracts\CartStorageIdentityContract;

class SessionStorageIdentity implements CartStorageIdentityContract
{
    public function get(): string
    {
        return session()->getId();
    }
}
