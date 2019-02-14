<?php

namespace JBJ\Workflow\StateMachine\Metadata;

use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\Collection\GraphCollectionTrait;

class MetadataRepository implements ArrayCollectionInterface
{
    use GraphCollectionTrait {
        getName as protected;
    }

    public function __construct(array $carts = [], string $repositoryName = '', PropertyAccessorInterface $propertyAccessor = null)
    {
        $rules = [
            'name' => [
                'cartName',
                'isDisabled' => false,
                'isValid' => true,
            ],
            'parent' => [
                'parentRepository',
                'isDisabled' => false,
                'isValid' => true,
            ],
        ];
        $propertyAccessor = $propertyAccessor ?: $this->createPropertyAccessor();
        $this->initializeTrait($repositoryName, $carts, $rules, $propertyAccessor);
        $this->setPersistPropertyAccessorHere(true);
    }

    public function getRepositoryName()
    {
        return $this->getName();
    }
}
