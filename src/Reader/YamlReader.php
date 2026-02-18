<?php

declare(strict_types=1);

namespace ForgeForGitea\Configuration\Reader;

use ForgeForGitea\Configuration\Exception\Reader\FileNotFoundException;
use ForgeForGitea\Configuration\Exception\Reader\FilePermissionDeniedException;
use Symfony\Component\Yaml\Yaml;

final readonly class YamlReader implements Reader
{
    private \SplFileInfo $file;

    /**
     * @throws FileNotFoundException
     * @throws FilePermissionDeniedException
     */
    public function __construct(\SplFileInfo $file)
    {
        if (!$file->isFile()) {
            throw new FileNotFoundException(
                \sprintf('File "%s" not found.', $file->getPathname()),
            );
        }

        if (!$file->isReadable()) {
            throw new FilePermissionDeniedException(
                \sprintf('File "%s" is not readable.', $file->getPathname()),
            );
        }

        $this->file = $file;
    }

    /**
     * @return mixed[]
     */
    #[\Override]
    public function read(): array
    {
        return (array) Yaml::parseFile($this->file->getRealPath());
    }
}
