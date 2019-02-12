<?php

namespace JBJ\Workflow\StateMachine;

use Symfony\Component\Workflow\Metadata\MetadataStoreInterface;

interface DefinitionInterface implements MetadataStoreInterface
{
    public function getName();
    public function getParent() : ?DefinitionInterface;
    public function setParent(DefinitionInterface $parent);
}
