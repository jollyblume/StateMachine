## jollyblume/workflow

This is a skeleton library. The component won't be ready for several minutes.

###### initial design notes
In finite automaton theory, a state machine is a type of workflow, where places are the states and transitions are the edges. Further setting them apart, a state machine can only be in a single state at any moment, while a workflow can be in multiple places simultaneously.

symfony/workflow seems to be tying state machines to the marking store. I believe this is a broken design.

This component aims to show a StateMachine as type of workflow. The semantics for accessing a marking store will be consistent between both types.

There will need to be support for this architecture in the Registry. A quick peek at symfony/workflow Definition indicates this won't be a problem. I will be ignoring definition and registry requirements during early development.

I will be implementing the symfony/workflow WorkflowInterface on the StateMachine class.

In order to support haley composition, StateMachine definitions and marking stores must support recursive workflows. To facilitate this, the jollyblume/workflow marking store will be used and will likely be hard-wired. I will be loosening this coupling in a later development cycle.

There are additional data required for a state machine that is not required for a workflow. The specific data needed depends on the type of state machine.
* *no outputs type* includes a few sub-types. The only one I am focused on currently is a deterministic finite machine (dfm).
* *has outputs type* include moore and mealey machines. Both types are required for advanced state machine semantics.

All types of state machines require the following definition.
* *inputs* are a list of inputs a state machine can expect.
  * Input signals are responsible for moving a state machine to it's next state. Multiple inputs of different types are acceptable. There are currently two input types planned. I believe these will meets all use-cases, time will tell.
    * *dispatched events* from the environment (for instance, a symfony application) are re-dispatched to state machines interested in the event. This interest is provided by the definition.
    * *clocks* are any input from code, including an actual clock signa, output from a moore or mealy machine, a service that needs to effect state, etc.
  * *final states* are a list of the states that are also *accepted" states. Accepted states often indicate a halted or trapped exceptional state.

In addition to the common definition, moore and mealy machines require a list of outputs.

This is just an overview of my development goals for this component. Currently, everything is written in jello.

Suggestions and comments are always welcome.
