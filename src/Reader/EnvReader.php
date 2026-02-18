<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration\Reader;

class EnvReader
{
    public function __construct() {}

    /**
     * @return []
     */
    public function read(): array
    {
        return $_ENV;
    }
}
