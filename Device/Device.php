<?php

namespace JBJ\Workflow\StateMachine\Device;

use Symfony\Workflow\WorkflowInterface;
use JBJ\ComposedCollections\Collection\ArrayCollectionInterface;
use JBJ\ComposedCollections\Collection\CollectionTrait;

abstract class Device implements ArrayCollectionInterface
{
    use CollectionTrait;

    private $workflow;

    public function __construct(WorkflowInterface $workflow, array $elements = [])
    {
        if (!empty($elements)) {
            $this->setChildren($elements);
        }
        $this->workflow = $workflow;
    }

    public function getWorkflow()
    {
        return $this->workflow;
    }
}
