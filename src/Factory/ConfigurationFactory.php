<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration\Factory;

use ForgeForGitea\Configuration\Configuration;
use ForgeForGitea\Configuration\Reader\Reader;
use ForgeForGitea\Configuration\Schema\SchemaWrapper;
use Symfony\Component\Config\Definition\Processor;

final readonly class ConfigurationFactory
{
    public function __construct(
        private SchemaWrapper $schema,
        private Reader $reader,
    ) {}

    public function create(): Configuration
    {
        $validatedParameters = (new Processor())->processConfiguration(
            $this->schema,
            [$this->reader->read()],
        );

        return new Configuration($validatedParameters);
    }
}
