<?php

namespace JBJ\Workflow\StateMachine\Traits;

use Ramsey\Uuid\Uuid;
use JBJ\Workflow\StateMachine\Validator\UuidValidator;

trait CreateIdTrait
{
    protected function createId(string $name = '')
    {
        if (empty($name)) {
            return strval(Uuid::uuid4());
        }
        $validator = new UuidValidator();
        if ($validator->validate($name)) {
            return $name;
        }
        return strval(Uuid::uuid3(Uuid::NAMESPACE_DNS, $name));
    }
}
