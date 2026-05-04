<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration;

final readonly class Configuration
{
    /**
     * @param array<array-key, mixed> $parameters
     */
    public function __construct(
        private array $parameters,
    ) {}

    /**
     * @return array<array-key, mixed>
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}
