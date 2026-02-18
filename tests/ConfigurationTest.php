<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration;

use ForgeForGitea\Configuration\Reader\PHPArrayReader;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

#[CoversClass(Configuration::class)]
final class ConfigurationTest
{
    public function testCreateConfiguration(): void
    {
        $configuration = null;

        try {

            $configurationAdapter = new class implements ConfigurationInterface {
                public function getConfigTreeBuilder(): TreeBuilder
                {
                    return new TreeBuilder('parameters');
                }
            };

            $configuration = new Configuration($configurationAdapter, new PHPArrayReader([]));

        } catch (\Exception) {}

        self::assertNotNull($configuration);
    }
}
