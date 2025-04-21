<?php

namespace Domain\Cart\StorageIdentities;

use Domain\Cart\Contracts\CartStorageIdentityContract;

class FakeStorageIdentity implements CartStorageIdentityContract
{
    public function get(): string
    {
        return 'test';
    }
}
