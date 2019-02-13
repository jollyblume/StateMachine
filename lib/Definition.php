<?php

namespace JBJ\Workflow\StateMachine;

use JBJ\Workflow\Traits\ElementNameTrait;
use JBJ\Workflow\Traits\ElementParentTrait;
use JBJ\Workflow\Collection\GraphCollectionTrait;

class Definition implements DefinitionInterface
{
    use GraphCollectionTrait, ElementNameTrait, ElementParentTrait;

    public function __construct(string $name, array $elements = [], PropertyAccessorInterface $propertyAccessor = null)
    {
        $rules = [
            'name' => [
                'name',
                'isDisabled' => false,
                'isValid' => true,
            ],
            'parent' => [
                'parentDefinition',
                'isDisabled' => false,
                'isValid' => true,
            ],
        ];
        $this->initializeTrait($name, $elements, $rules, $propertyAccessor);
    }
}
