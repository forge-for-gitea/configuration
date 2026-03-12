<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration\Reader;

final readonly class EnvReader implements Reader
{
    public function __construct() {}

    #[\Override]
    public function read(): array
    {
        return $_ENV;
    }
}
