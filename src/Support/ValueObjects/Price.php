<?php

namespace Support\ValueObjects;

use InvalidArgumentException;
use Stringable;
use Support\Traits\Makeable;

class Price implements Stringable
{
    use Makeable;
    private array $currencies = [
        'USD' => '$'
    ];

    public function __construct(
        private readonly int $value,
        private readonly string $currency = 'USD',
        private readonly int $precision = 100,
    )
    {
        if ($value < 0) {
            throw new InvalidArgumentException('Price must be grater than 0');
        }

        if (!isset($this->currencies[$this->currency])) {
            throw new InvalidArgumentException('Currency is not allowed');
        }
    }

    public function raw(): int
    {
        return $this->value;
    }

    public function value(): float|int
    {
        return $this->value / $this->precision;
    }

    public function symbol(): string
    {
        return $this->currencies[$this->currency];
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public function __toString(): string
    {
        return number_format($this->value(), 0, ',', ' ')
            . ' ' . $this->symbol();
    }
}
