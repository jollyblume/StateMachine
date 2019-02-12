<?php

namespace JBJ\Workflow\StateMachine\Tests;

use JBJ\ComposedCollections\Collection\ArrayCollectionInterface;
use JBJ\ComposedCollections\Tests\Collection\BaseCollectionTraitTest as BaseTestCase;
use JBJ\Workflow\StateMachine\WorkflowCollection;

class WorkflowCollectionTest extends BaseTestCase
{
    protected function getTestClass() : string
    {
        return WorkflowCollection::class;
    }

    protected function getRules() : array
    {
        $rules = [
            'name' => [
                'name',
                'isDisabled' => false,
                'isValid' => true,
            ],
            'parent' => [
                'parent',
                'isDisabled' => false,
                'isValid' => true,
            ],
        ];
        return $rules;
    }

    protected function createCollection(string $name, array $elements = []) : ArrayCollectionInterface
    {
        $rules = $this->getRules();
        $propertyAccessor = $this->getPropertyAccessor();
        $testClass = $this->getTestClass();
        $collection = new $testClass($elements, $propertyAccessor, $name);
        return $collection;
    }
}
