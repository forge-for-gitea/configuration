<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Configuration::class)]
final class ConfigurationTest extends TestCase
{
    public function testGetParametersReturnsPassedArray(): void
    {
        $parameters = ['key' => 'value', 'another' => 42];
        $configuration = new Configuration($parameters);

        self::assertSame($parameters, $configuration->getParameters());
    }
}
