<?php

namespace JBJ\Workflow\StateMachine\MetadataStore;

use Doctrine\Common\Collections\ArrayCollection;
use JBJ\ComposedCollections\Collection\ArrayCollectionInterface;
use JBJ\ComposedCollections\Collection\CollectionTrait;
use JBJ\Workflow\StateMachine\Traits\CreateIdTrait;

/**
 * todo add/remove/get
 *
 * remove: no changes
 * add: $element must be key/value pairs and possibly a string. string would pull
 *      in defaults for a given collection??.
 */
class MetadataBag implements ArrayCollectionInterface
{
    use CollectionTrait, CreateIdTrait;

    private $name;

    public function __construct(string $name = '', array $elements = [])
    {
        $this->name = $this->createId($name);
        if (!empty($elements)) {
            $this->setChildren($elements);
        }
    }

    public function getName()
    {
        return $this->name;
    }

    protected function setChildren(array $elements)
    {
        $children = new ArrayCollection();
        foreach ($elements as $typeName => $typeElements) {
            //todo if is_string($typeElements), pull a named bag or config??
            //nottodo, above needs to find the correct app layer
            $children[$typeName] = $typeElements;
        }
        $this->children = $children;
    }

    protected function migrateValue($value)
    {
        if (!is_array($value)) {
            return $value;
        }

        $collection = new ArrayCollection($value);
        return $collection;
    }

    public function set($key, $value)
    {
        $value = $this->migrateValue($value);
        $this->getChildren()->set($key, $value);
    }

    public function add($element)
    {
        $element = $this->migrateValue($element);
        return $this->getChildren()->add($element);
    }
}
