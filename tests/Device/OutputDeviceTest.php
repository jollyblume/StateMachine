<?php

namespace JBJ\Workflow\StateMachine\Tests\Device;

use JBJ\ComposedCollections\Collection\ArrayCollectionInterface;
use JBJ\ComposedCollections\Tests\Collection\BaseCollectionTraitTest;
use JBJ\Workflow\StateMachine\Device\OutputDevice;

class OutputDeviceTest extends BaseCollectionTraitTest
{
    protected function getTestClass() : string
    {
        return OutputDevice::class;
    }

    protected function getRules() : array
    {
        return [];
    }

    protected function createCollection(string $name, array $elements = []) : ArrayCollectionInterface
    {
        $testClass = $this->getTestClass();
        $collection = new $testClass($elements, $name);
        return $collection;
    }
}
