<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration\Schema;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class SchemaAdapter implements Schema, ConfigurationInterface
{
    private TreeBuilder $treeBuilder;

    public function __construct()
    {
        $this->treeBuilder = new TreeBuilder('');
    }

    public function getTreeBuilder(): TreeBuilder
    {
        return $this->treeBuilder;
    }

    public function getConfigTreeBuilder(): TreeBuilder
    {
        return $this->getTreeBuilder();
    }
}
