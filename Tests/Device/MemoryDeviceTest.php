<?php

namespace JBJ\Workflow\StateMachine\Tests\Device;

use Symfony\Workflow\WorkflowInterface;
use JBJ\ComposedCollections\Collection\ArrayCollectionInterface;
use JBJ\ComposedCollections\Tests\Collection\BaseCollectionTraitTest;
use JBJ\Workflow\StateMachine\Device\MemoryDevice;

class MemoryDeviceTest extends BaseCollectionTraitTest
{
    protected function getTestClass() : string
    {
        return MemoryDevice::class;
    }

    protected function getRules() : array
    {
        return [];
    }

    protected function createCollection(string $name, array $elements = []) : ArrayCollectionInterface
    {
        $testClass = $this->getTestClass();
        $parentWorkflow = $this->getMockBuilder(WorkflowInterface::class)
            ->disableOriginalConstructor()
            ->getMocK();
        $collection = new $testClass($parentWorkflow, $elements);
        return $collection;
    }
}
