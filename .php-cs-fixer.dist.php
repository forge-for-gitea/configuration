<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->append([
        __FILE__,
    ]);

$config = (new Config())
    ->setFinder($finder)
    ->setRules([
        '@PER-CS' => true,
    ])
    ->setCacheFile(__DIR__ . '/var/.php-cs-fixer.cache');

return $config;
