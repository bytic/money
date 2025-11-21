<?php
declare(strict_types=1);

namespace ByTIC\Money\Traits;

trait HasTransformersTrait
{
    public function toCents(): int
    {
        return (int) $this->getAmount();
    }
}
