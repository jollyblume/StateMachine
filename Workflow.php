<?php

namespace JBJ\Workflow\StateMachine;

use Symfony\Component\Workflow\Definition;
use Symfony\Component\Workflow\WorkflowInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * forked from symfony/workflow
 *
 * need input signals definition
 *
 */
class Workflow implements WorkflowInterface {
    private $dispatcher;
    private $propertyAccessor;

    public function __construct(Definition $definition, EventDispatcherInterface $dispatcher, PropertyAccessorInterface $propertyAccessor = null)
    {
        $this->dispatcher = $dispatcher;
        $propertyAccessor = $propertyAccessor ?: PropertyAccess::createPropertyAccessor();

        //todo build state machine to process a definition into workflow properties.
        // output from state machine should be a valid jhmemory device.
        // expected properties
        //  input signals, initial state/place, states/places, transitions, final
        // states/places, output signals (internal view)
        //
        // input signals (having external input signals indicates wf is a state machine)
        //  - events (bool true=event fired, flip-flops, or counters) dispatched events or real clocks/timers
        //      - clocks/timers are only used internally (usually initiating next state processing)
        //      - events are only provided from the state machine event mediator (listener)
        //  - any output signal (available to workflows)
        //  - flip-flops (toggles)
        //  - mixed values
        //  - ...etc...
        //
        //  Any input signal can be tagged to initiate next state processing.
        //      - handling all input as tagged would be simpler.
        //      - do I need to aggregate multiple tagged inputs into a single input?
        //      - non-tagged input would not be accessed until next state is processed.
        //
        //  State machines mostly operate on binary inputs. For instance, while
        //  processing a string value, the state processes it as a stream of characters.
        //  Of course, a sting could be a complete token and used as a
        //  discrete input.
        //
        //  array inputs? array inputs are useful non-tagged inputs, since they
        //  could be used while executing output combinational logic. How do they
        //  stack in state machines?
        //      - like stings, a state machine is likely to process a single index
        //        at a time.
        //      - like strings, there will need to be some front-end that feeds
        //        these to a state machine.
        //
        // output signals
        //  - any final (accepting) states (final states can be implied). only
        //      one final state can be true
        //  - state machines (for instance) can categorize the general state of
        //      a workflow based on its markings. //todo examine use-cases.
        //      I expect use-cases to use state-machines as a smart data type.
        //  -
    }
}
