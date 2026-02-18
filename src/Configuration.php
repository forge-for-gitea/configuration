<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration;

use ForgeForGitea\Configuration\Reader\Reader;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;

final class Configuration
{
    private readonly array $parameters;
    private array $validatedParameters;

    public function __construct(private readonly ConfigurationInterface $configurationAdapter, Reader $reader)
    {
        $this->validatedParameters = [];

        $this->parameters = $reader->read();
    }

    public function getConfigurationAdapter(): ConfigurationInterface
    {
        return $this->configurationAdapter;
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
            $this->getConfigurationAdapter(),
            [$this->getParameters()],
        );

        return $this->getValidatedParameters();
    }
}
