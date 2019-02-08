<?php

namespace JBJ\Workflow\StateMachine\Device;

use JBJ\ComposedCollections\Collection\ComposedCollectionTrait;

abstract class Device
{
    use ComposedCollectionTrait;

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
