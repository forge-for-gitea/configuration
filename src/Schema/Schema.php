<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration\Schema;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

interface Schema
{
    public function getTreeBuilder(): TreeBuilder;
}
