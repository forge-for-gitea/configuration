<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;

final class Configuration
{
    private readonly array $parameters;

    private readonly ConfigurationInterface $configurationAdapter;

    private array $validatedParameters;

    public function __construct(private readonly ConfigurationInterface $configurationAdapter, private readonly array $parameters)
    {
        $this->validatedParameters = [];
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
