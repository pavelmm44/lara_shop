<?php

namespace Domain\Order\DTOs;

use Illuminate\Http\Request;
use Support\Traits\Makeable;

class OrderCustomerDTO
{
    use Makeable;

    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $phone,
        public string $city,
        public string $address
    ){

    }

    public function fullName(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public static function fromArray(array $customer): self
    {
        return self::make(
            $customer['first_name'] ?? '',
            $customer['last_name'] ?? '',
            $customer['email'] ?? '',
            $customer['phone'] ?? '',
            $customer['city'] ?? '',
            $customer['address'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'address' => $this->address
        ];
    }
}
