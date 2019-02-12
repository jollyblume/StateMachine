<?php

namespace JBJ\Workflow\StateMachine\MetadataStore;

use JBJ\ComposedCollections\Collection\ArrayCollectionInterface;
use JBJ\ComposedCollections\Collection\GraphCollectionTrait;
use Symfony\Component\Workflow\Metadata\MetadataStoreInterface;
use Symfony\Component\Workflow\Metadata\GetMetadataTrait;
use Symfony\Component\Workflow\Transition;

class MetadataStore implements MetadataStoreInterface, ArrayCollectionInterface
{
    use GetMetadataTrait, GraphCollectionTrait;

    public function __construct(string $name, array $elements = [], PropertyAccessorInterface $propertyAccessor = null)
    {
        $rules = [
            'name' = [
                'name',
                'isDisabled' => false,
                'isValid' => true,
            ],
            'parent' = [
                'parent',
                'isDisabled' => false,
                'isValid' => true,
            ],
        ];
        $this->initializeTrait($name, $elements, $rules, $propertyAccessor);
    }

    public function getWorkflowMetadata(): array
    {
        $children = $this->getChildren();
        $metadata = $children['workflow'];
        return $metadata ? $metadata->toArray() : [];
    }

    public function getPlaceMetadata(string $place): array
    {
        $children = $this->getChildren();
        $metadata = $children['place'];
        return $metadata ? $metadata->toArray() : [];
    }


    public function getTransitionMetadata(Transition $transition): array
    {
        $children = $this->getChildren();
        $metadata = $children['transition'];
        return $metadata ? $metadata->toArray() : [];
    }
}
