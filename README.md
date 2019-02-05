## jollyblume/workflow

This is a skeleton library. The component won't be ready for several minutes.

This README is only to help me focus during development. The information it contains may not be accurate or up to date.

###### initial design notes
In finite automaton theory, a state machine is a type of workflow, where places are the states and transitions are the edges in a state diagram. Further setting them apart, a state machine can only be in a single state at any moment and changes state only in response to inputs. Some state machine configuration may also provide outputs, derived from some combination of current state and inputs.

#### Component goals
* Show a StateMachine as constrained workflow.
* Perform next state logic only in response to input signals.
* Integration with symfony/workflow. In order to facilitate this, symfony/workflow::MetadataStore will need to provide state machine metadata. Currently, modeling this metadata as a configuration key.

    MetadataStoreInterface::getWorkflowMetadata()['fsm'] // for instance

* Support for workflow recursion, composition and state bubbling. This will likely require metadata support. This needs to be moved to jollyblume/workflow, as it is not state machine specific.
* Stateless state machines. Persisted state will be revisited, but persistence of state in a state machine is not part of the reference design patterns.

#### Component notes
* References to $subject in the state machine are an array of input signals.
* saved state must include current input values and will have some complications that will need testing.
  * restoring state can not initiate next state logic.
  * how are application events handled during restoring?
    * can't rethrow missed events. too much wiring and event handling for events that will never matter.
    * what would this infrastructure look like, though?
      * implementation of event signals will need support from a dispatcher that listens to application events and turns the dispatched event into input signals for a state machine. Perhaps a state machines' memory device is used to send signals between the state machine listener and state machines. This would allow state machine
* Input signals basically properties. Signal is used to describe an inputs' effect on next state.

In practice, though, state machines can be paired with a memory device (class). The memory is architecturally related to a state machine. This memory device will be used by as both the state machines' current inputs and state and as the state machine listeners' event integration
* fsm uses memory device to send signals to a state machine, making the listener a mediator).
* state machine uses memory device as internal properties.
* should allow for virtual state machine instances tying differing fsm configuration to influence next state logic, all using a single state machine definition.


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
