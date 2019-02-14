<?php

namespace JBJ\Workflow\StateMachine\Tests\Definition;

use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\StateMachine\Definition\MetadataRepository;
use JBJ\Workflow\Tests\Collection\BaseCollectionTraitTest;

class MetadataRepositoryTest extends BaseCollectionTraitTest
{
    protected function getTestClass() : string
    {
        return MetadataRepository::class;
    }

    protected function getRules() : array
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
            public function getCartName()
            {
                return $this->name;
            }
            public function getParentRepository()
            {
                return $this->parent;
            }
            public function setParentRepository($parent)
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

    public function testGetRepositoryName()
    {
        $collection = $this->createCollection('test.repo');
        $this->assertEquals('test.repo', $collection->getRepositoryName());
    }
}
