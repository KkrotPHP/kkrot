<?php

namespace Kkrot\Di\Definition\Contract;

interface DefinitionInterface
{
    /**
     * Definitions can be cast to string for debugging information.
     */
    public function __toString(): string;

    /**
     * Returns the name of the entry in the container.
     */
    public function getName(): string;

    /**
     * Set the name of the entry in the container.
     */
    public function setName(string $name);
}