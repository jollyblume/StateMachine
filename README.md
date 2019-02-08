## jollyblume/workflow

branch philosophy: A workflow and a state machine are the same thing, differing only in implementation. symfony/workflow also takes this approach, but I need a different concept of state machine.

components:
Workflow class (implements symfony/workflow::WorkflowInterface)
* There is no StateMachine class. A workflow operates as a workflow or a state machine based on configuration.

Device classes (input and output). The device concept will only be relevant in early development.

State chart class.

Mediator service.
* collection of state machines, dispatcher
* this is not intended to be a registry. it is just glue.
* collection of inputs and outputs. these will be used to virtualize concrete state machines for individual inputs.
* events and inputs are pointed at input devices. the input device for a virtual state machine will restore all state to a state machine before executing next state combinational logic. or any other logic.
* input devices are used by the mediator to interact with a concrete state machine.
* application code uses input devices as it they were the actual state machine.

In this component
* a workflow is the same as symfony/workflow::Workflow.
* a state machine starts the same and can only be in a single state.
* a state machine only performs next state combinational login in response to an input signal.
* a state machine has output. Normally, output is only dependent on state. for a mealy machine, the inputs and the current state define the output.
* state machines will use a state machine to convert configuration into a working state machine. eventually.
* must successfully run symfony/workflow test suites.
* must use symfony/workflow::Definition
* Will use jollyblume/marking-store
* will use jollyblume/composed-collection
* 
