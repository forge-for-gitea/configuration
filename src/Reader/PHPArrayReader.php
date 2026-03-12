<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration\Reader;

final readonly class PHPArrayReader implements Reader
{
    public function __construct(private readonly array $array) {}

    #[\Override]
    public function read(): array
    {
        return $this->array;
    }
}
