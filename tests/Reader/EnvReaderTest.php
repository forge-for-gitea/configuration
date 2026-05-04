<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration\Reader;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(EnvReader::class)]
final class EnvReaderTest extends TestCase
{
    private const string TEST_ENV_KEY = 'PHPUNIT_ENV_READER_TEST_KEY';
    private const string TEST_ENV_KEY2 = 'PHPUNIT_ENV_READER_TEST_KEY2';

    #[\Override]
    protected function setUp(): void
    {
        $_ENV[self::TEST_ENV_KEY] = 'test_value';
        $_ENV[self::TEST_ENV_KEY2] = 'test_value2';
    }

    #[\Override]
    protected function tearDown(): void
    {
        unset($_ENV[self::TEST_ENV_KEY], $_ENV[self::TEST_ENV_KEY2]);

    }

    public function testReadIsAnArray(): void
    {
        $reader = new EnvReader();

        /**
         * @psalm-suppress RedundantCondition
         * @phpstan-ignore staticMethod.alreadyNarrowedType
         */
        self::assertIsArray($reader->read());
    }

    public function testReadReturnsCount(): void
    {
        $reader = new EnvReader();

        self::assertCount(\count($_ENV), $reader->read());
    }

    public function testReadReturnsEnvSuperGlobal(): void
    {
        $reader = new EnvReader();
        $result = $reader->read();

        self::assertSame($_ENV, $result);
    }

    public function testReadContainsExpectedEnvKey(): void
    {
        $reader = new EnvReader();
        $result = $reader->read();

        self::assertArrayHasKey(self::TEST_ENV_KEY, $result);

        /** @psalm-suppress PossiblyUndefinedStringArrayOffset */
        self::assertSame('test_value', $result[self::TEST_ENV_KEY]);
    }
}
