<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration\Reader;

interface Reader
{
    /**
     * @return mixed[]
     */
    public function read(): array;
}
