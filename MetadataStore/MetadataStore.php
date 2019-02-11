<?php

namespace JBJ\Workflow\StateMachine\MetadataStore;

use Symfony\Component\Workflow\Metadata\MetadataStoreInterface;
use Symfony\Component\Workflow\Metadata\GetMetadataTrait;
use Symfony\Component\Workflow\Transition;

class MetadataStore implements MetadataStoreInterface
{
    use GetMetadataTrait;

    private $bag;

    public function __construct(MetadataBag $bag = null)
    {
        if (null === $bag) {
            $bag = new MetadataBag();
        }
        foreach (['workflow', 'place', 'transition'] as $required) {
            if (!$bag->containsKey($required)) {
                $bag[$required] = [];
            }
        }
        $this->bag = $bag;
    }
    protected function normalizeCollection(string $typeName)
    {
        $bag = $this->bag;
        $collection = $bag[$typeName];
        if ($collection instanceof ArrayCollection) {
            return $collection->toArray();
        }
        if (is_array($typeName)) {
            return $typeName;
        }
        return [$typeName];
    }

    public function getWorkflowMetadata(): array
    {
        $bag = $this->normalizeCollection('workflow');
        return $bag;
    }

    public function getPlaceMetadata(string $place): array
    {
        $bag = $this->normalizeCollection('place');
        return $bag;
    }

    public function getTransitionMetadata(Transition $transition): array
    {
        $typeName = $transition->getName(); //todo are transition names unique?
        $bag = $this->normalizeCollection('transition');
        return $bag;
    }

    public function getMetadata(string $key, $subject = null)
    {}
}
