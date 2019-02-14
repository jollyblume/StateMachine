<?php

namespace JBJ\Workflow\StateMachine\Tests\Definition;

use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\StateMachine\Definition\MetadataBag;
use JBJ\Workflow\Tests\Collection\BaseCollectionTraitTest;

class MetadataBagTest extends BaseCollectionTraitTest
{
    protected function getTestClass() : string
    {
        return MetadataBag::class;
    }

    protected function getRules() : array
    {
        $rules = [
            'name' => [
                'itemName',
                'isDisabled' => false,
                'isValid' => true,
            ],
            'parent' => [
                'parentBag',
                'isDisabled' => false,
                'isValid' => true,
            ],
        ];
        return $rules;
    }

    protected function createCollection(string $name, array $elements = []) : ArrayCollectionInterface
    {
        $propertyAccessor = $this->getPropertyAccessor();
        $testClass = $this->getTestClass();
        $collection = new $testClass($elements, $name, $propertyAccessor);
        return $collection;
    }

    protected function createAcceptableElement(string $key)
    {
        $element = new class($key) {
            private $name;
            private $parent;
            private $otherValue;
            public function __construct(string $name)
            {
                $this->name = $name;
            }
            public function getName()
            {
                return $this->name;
            }
            public function getItemName()
            {
                return $this->name;
            }
            public function getParentBag()
            {
                return $this->parent;
            }
            public function setParentBag($parent)
            {
                $this->parent = $parent;
            }
            public function getOtherValue()
            {
                return $this->otherValue;
            }
            public function setOtherValue($otherValue)
            {
                $this->otherValue = $otherValue;
            }
            public function __toString()
            {
                return $this->getName();
            }
        };
        return $element;
    }
}
