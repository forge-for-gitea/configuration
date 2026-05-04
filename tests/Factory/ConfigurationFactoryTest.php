<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration\Factory;

use ForgeForGitea\Configuration\Configuration;
use ForgeForGitea\Configuration\Reader\PHPArrayReader;
use ForgeForGitea\Configuration\Schema\SchemaWrapper;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ConfigurationFactory::class)]
final class ConfigurationFactoryTest extends TestCase
{
    private SchemaWrapper $schema;

    #[\Override]
    protected function setUp(): void
    {
        $this->schema = new SchemaWrapper();
    }

    public function testReturnsConfigurationInstanceWithValidatedParameters(): void
    {
        $factory = new ConfigurationFactory($this->schema, new PHPArrayReader([]));
        $configuration = $factory->create();

        self::assertInstanceOf(Configuration::class, $configuration);
    }

    public function testReturnsConfigurationInstanceWithReadingParameters(): void
    {
        $data = ['foo' => 'bar'];

        $schema = clone $this->schema;
        $root = $schema->getTreeBuilder()->getRootNode();
        $root
            ->children()
                ->stringNode('foo')
                    ->cannotBeEmpty()
                    ->isRequired();

        $factory = new ConfigurationFactory($schema, new PHPArrayReader($data));
        $configuration = $factory->create();

        self::assertEquals($data, $configuration->getParameters());
    }
}
