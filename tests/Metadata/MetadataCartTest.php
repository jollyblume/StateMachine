<?php

namespace JBJ\Workflow\Tests\Collection;

use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\StateMachine\Metadata\MetadataCart;
use JBJ\Workflow\Tests\Collection\BaseCollectionTraitTest;

class MetadataCartTest extends BaseCollectionTraitTest
{
    protected function getTestClass() : string
    {
        return MetadataCart::class;
    }

    protected function getRules() : array
    {
        $rules = [
            'name' => [
                'bagName',
                'isDisabled' => false,
                'isValid' => true,
            ],
            'parent' => [
                'parentCart',
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
        $collection = new $testClass($propertyAccessor, $elements, $name);
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
            public function getBagName()
            {
                return $this->name;
            }
            public function getParentCart()
            {
                return $this->parent;
            }
            public function setParentCart($parent)
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
        };
        return $element;
    }
}
