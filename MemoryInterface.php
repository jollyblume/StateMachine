<?php

namespace JBJ\Workflow\StateMachine;

interface MemoryInterface
{
    public function getState();
    public function setState(string $state);
}
