<?php

namespace JBJ\Workflow\StateMachine\Tests\Definition;

use JBJ\Workflow\Collection\ArrayCollectionInterface;
use JBJ\Workflow\StateMachine\Definition\MetadataItem;
use JBJ\Workflow\Tests\Collection\BaseCollectionTraitTest;

class MetadataItemTest extends BaseCollectionTraitTest
{
    protected function getTestClass() : string
    {
        return MetadataItem::class;
    }

    protected function getRules() : array
    {
        return [];
    }

    protected function createCollection(string $name, array $elements = []) : ArrayCollectionInterface
    {
        $testClass = $this->getTestClass();
        $collection = new $testClass($name, $elements);
        return $collection;
    }

    public function testGetItemName()
    {
        $collection = $this->createCollection('test.bag');
        $this->assertEquals('test.bag', $collection->getItemName());
    }

    public function testSetParentBag()
    {
        $collection = $this->createCollection('test.item');
        $parent = new class() {
        };
        $collection->setParentBag($parent);
        $this->assertEquals($parent, $collection->getParentBag());
    }
}
