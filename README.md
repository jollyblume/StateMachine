## jollyblume/workflow

This is a skeleton library. The component won't be ready for several minutes.

###### initial design notes
In finite automaton theory, a state machine is a type of workflow, where places are the states and transitions are the edges. Further setting them apart, a state machine can only be in a single state at any moment, while a workflow can be in multiple places simultaneously.

This component aims to show a StateMachine as a type of workflow.

In order to support haley composition, StateMachine definitions and implementation details must support recursive workflows. A state machine should not require a marking store. By definition, state machines have no memory and need no store. This should simplify recursion.

In practice, though, state machines are often paired with a memory device (class). The memory is architecturally related to a state machine. This memory device will use the jollyblume/workflow marking store to facilitate persistence.

Most likely, the memory device will need to use a marking store differently than a workflow. Where a workflow stores an array of places for each markingStoreId/subjectId key aggregation, the memory is likely to be storing an array where element[0] is a starting state. State color could be modeled into other array elements. I haven't gotten that far, though. This idea may be completely bogus.

Regardless, memory will not be added until a later development cycle. It's implementation can't impact the state machine's implementation

Currently, the memory device is envisioned as a concrete state machine that takes the either the output's of a moore or mealey machine or perhaps some predetermined signal changes the memory state to 'query-state' and pulls the current state of a machine. The current state of the memory target is persisted and then provided as an output. <- written in jello

Because of recursion, a state machine and a memory could be combined into a single persisted state machine and the memory would largely be an internal implementation detail for a state machine.

There will need to be support for this architecture in the Registry. . I will be minimizing the importance of definition and registry requirements during early development.

There are additional data required for initialization of a state machine that is not required for a workflow. The specific data needed depends on the type of state machine.
* *no outputs type* includes a few sub-types. The only one I will focused on is a deterministic finite machine (dfm).
* *has outputs type* include moore and mealey machines. Both types are required for advanced state machine semantics.

All types of state machines require the following definition.
* *inputs* are a list of inputs a state machine can expect. By supporting input types I expect to be able to create a moore/mealy hybrid state machine.
  * Input signals are responsible for moving a state machine to it's next state. Multiple inputs of different types are acceptable. There are currently two input types planned. I believe these will meets all use-cases, time will tell.
    * *dispatched events* from the environment (for instance, a symfony application) are re-dispatched to state machines interested in the event. This interest is provided by the definition.
    * *clocks* are any input from code, including an actual clock signa, output from a moore or mealy machine, a service that needs to effect state, etc.
  * *final states* are a list of the states that are also *accepted" states. Accepted states often indicate a halted or trapped exceptional state.

In addition to the common definition, moore and mealy machines require a list of outputs.

This is just an overview of my development goals for this component. Currently, everything is written in jello.

Suggestions and comments are always welcome.

Workflow interface design considerations:

* Where does *$subject* have any relevence in a state machine?
  * State reacts to a environment control(s) and provides a single state for that control.
  * Could be just be a general state machine showing a state based on a subjects' marking in a workflow. However, this is just a use-case for compositions of workflows and state machines.
  * Could be used when getting the current state in order to convert between state machine outputs and some components' expectations. For instance, a different set of form elements per state. This also seems like a use-case.
  * Perhaps a state machines' output combinational logic could be related to a *$subject*. This requires moving the output device into a seperate interface, wiring a *$subject* to a state machine, mapping state machine output into the output device, standardizing state machine output?, performing the combinational logic in the output device to provide *$subject* sensitive output. This is a possibility.
  * A *$subject* could just be a list of input signals. This is not a great solution, but one I may employ.
    * For *getMarking($subject)* and *buildTransitionBlockerList($subject, string $transitionName)* in a state machine, no concept of *$subject* exists. Theses methods would need to ignore *$subject*. This is what makes this solution feel broken.
    * *buildTransitionBlockerList($subject, string $transitionName)* does not belong in the interface. A state machine should not include insight to internal combinational logic. Combinational logic comes from a Definition.
    * For *can($subject, $transitionName)*, the semantics where *$subject* is a list of signals works. (ei: is the next state *$transitionName* true with the signals presented in *$subject*). I still don't like the name $subject in a state machine. Also, a state machine should not include insight to internal combinational logic.
    * *getEnabledTransitions($subject)* where *$subject* is a list of input signals.
    * etc.

I think the biggest problem is the symfony/workflow::WorkflowInterface. It includes features for too many different concerns.

It seems my best path is to create an accurate representation of a state machine, then create a symfony/workflow::WorkflowInterface to facilitate component integration.
