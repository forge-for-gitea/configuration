<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration;

use ForgeForGitea\Configuration\Reader\Reader;
use ForgeForGitea\Configuration\Schema\Schema;
use Symfony\Component\Config\Definition\Processor;

final class Configuration
{
    private readonly array $parameters;
    private array $validatedParameters;

    public function __construct(private readonly Schema $schema, Reader $reader)
    {
        $this->validatedParameters = [];

        $this->parameters = $reader->read();
    }

    public function getSchema(): Schema
    {
        return $this->schema;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getValidatedParameters(): array
    {
        return $this->validatedParameters;
    }

    public function validate(): array
    {
        $processor = new Processor();
        $this->validatedParameters = $processor->processConfiguration(
            $this->getSchema(),
            [$this->getParameters()],
        );

        return $this->getValidatedParameters();
    }
}
