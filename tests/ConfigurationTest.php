<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration;

use ForgeForGitea\Configuration\Reader\PHPArrayReader;
use ForgeForGitea\Configuration\Schema\SchemaWrapper;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Configuration::class)]
final class ConfigurationTest extends TestCase
{
    private SchemaWrapper $schema;

    #[\Override]
    protected function setUp(): void
    {
        $this->schema = new SchemaWrapper();
    }

    public function testGetSchemaWrapperReturnsSchemaPassedToConstructor(): void
    {
        $configuration = new Configuration($this->schema, new PHPArrayReader([]));

        self::assertSame($this->schema, $configuration->getSchemaWrapper());
    }

    public function testGetParametersReturnsArrayFromReader(): void
    {
        $parameters = ['key' => 'value', 'another' => 42];
        $configuration = new Configuration($this->schema, new PHPArrayReader($parameters));

        self::assertSame($parameters, $configuration->getParameters());
    }

    public function testGetParametersReturnsEmptyArrayWhenReaderProvidesNone(): void
    {
        $configuration = new Configuration($this->schema, new PHPArrayReader([]));

        self::assertSame([], $configuration->getParameters());
    }

    public function testGetValidatedParametersIsEmptyBeforeValidation(): void
    {
        $configuration = new Configuration($this->schema, new PHPArrayReader(['key' => 'value']));

        self::assertSame([], $configuration->getValidatedParameters());
    }

    public function testValidateReturnsProcessedParameters(): void
    {
        $configuration = new Configuration($this->schema, new PHPArrayReader([]));

        $result = $configuration->validate();

        /**
         * @psalm-suppress RedundantCondition
         * @phpstan-ignore staticMethod.alreadyNarrowedType
         */
        self::assertIsArray($result);
    }

    public function testGetValidatedParametersAfterValidationReturnsProcessedResult(): void
    {
        $configuration = new Configuration($this->schema, new PHPArrayReader([]));
        $validated = $configuration->validate();

        self::assertSame($validated, $configuration->getValidatedParameters());
    }

    public function testValidateReturnsSameReferenceAsGetValidatedParameters(): void
    {
        $configuration = new Configuration($this->schema, new PHPArrayReader([]));
        $result = $configuration->validate();

        self::assertSame($result, $configuration->getValidatedParameters());
    }
}
