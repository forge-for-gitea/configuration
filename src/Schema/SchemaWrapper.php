<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration\Schema;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final readonly class SchemaWrapper implements Schema, ConfigurationInterface
{
    /**
     * @var TreeBuilder<'array'>
     */
    private TreeBuilder $treeBuilder;

    public function __construct()
    {
        $this->treeBuilder = new TreeBuilder('FFG_');
    }

    /**
     * @return TreeBuilder<'array'>
     */
    #[\Override]
    public function getTreeBuilder(): TreeBuilder
    {
        return $this->treeBuilder;
    }

    /**
     * @return TreeBuilder<'array'>
     */
    #[\Override]
    public function getConfigTreeBuilder(): TreeBuilder
    {
        return $this->getTreeBuilder();
    }
}
