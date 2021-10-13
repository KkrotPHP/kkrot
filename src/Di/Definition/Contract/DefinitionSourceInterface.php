<?php

namespace Kkrot\Di\Definition\Contract;

use InvalidArgumentException;

interface DefinitionSourceInterface
{
    /**
     * Returns the DI definition for the entry name.
     *
     * @param string $name
     * @return null|DefinitionInterface
     * @throws InvalidArgumentException an invalid definition was found
     */
    public function getDefinition(string $name): ?DefinitionInterface;

    /**
     * @return array definitions indexed by their name
     */
    public function getDefinitions(): array;

    /**
     * @param mixed $definition
     * @return $this
     */
    public function addDefinition(string $name, $definition);

    public function clearDefinitions(): void;
}
