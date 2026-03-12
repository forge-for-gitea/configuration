<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration;

use ForgeForGitea\Configuration\Reader\Reader;
use ForgeForGitea\Configuration\Schema\SchemaWrapper;
use Symfony\Component\Config\Definition\Processor;

final class Configuration
{
    private readonly array $parameters;

    private array $validatedParameters;

    public function __construct(private readonly SchemaWrapper $schema, Reader $reader)
    {
        $this->validatedParameters = [];

        $this->parameters = $reader->read();
    }

    public function getSchemaWrapper(): SchemaWrapper
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

    /**
     * @psalm-api
     */
    public function validate(): array
    {
        $processor = new Processor();
        $this->validatedParameters = $processor->processConfiguration(
            $this->getSchemaWrapper(),
            [$this->getParameters()],
        );

        return $this->getValidatedParameters();
    }
}
