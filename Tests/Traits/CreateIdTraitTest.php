<?php

namespace JBJ\Workflow\StateMachine\Tests\Traits;

use JBJ\Workflow\StateMachine\Traits\CreateIdTrait;
use JBJ\Workflow\StateMachine\Validator\UuidValidator;
use PHPUnit\Framework\TestCase;

class CreateIdTraitTest extends TestCase
{
    public function testIfEmpty()
    {
        $trait = new class()
        {
            use CreateIdTrait {
                CreateId as public;
            }

            public function validate($id)
            {
                $validator = new UuidValidator();
                return $validator->validate($id);
            }
        };

        $this->assertFalse($trait->validate('a.name'));
        $id = $trait->CreateId();
        $this->assertTrue($trait->validate($id));
        $id = $trait->CreateId('a.name');
        $this->assertTrue($trait->validate($id));
        $this->assertEquals($id, $trait->CreateId('a.name'));
        $uuid = 'cd6ccde3-d11d-432b-8ffa-3596f214f7b1';
        $id = $trait->CreateId($uuid);
        $this->assertEquals($uuid, $id);
    }
}
