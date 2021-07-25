<?php

namespace Modio\Test;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Modio\Modbot;

class Test extends TestCase
{
    /**
     * test we can create a mod bot
     */
    public function testCreate() : void
    {
        // test constructor
        $robot = new Modbot([0, 0], Modbot::NORTH);
        $this->assertEquals([0, 0], $robot->position);
        $this->assertEquals(Modbot::NORTH, $robot->direction);
        
        // test allowed negative positions
        $robot = new Modbot([-1, -1], Modbot::SOUTH);
        $this->assertEquals([-1, -1], $robot->position);
        $this->assertEquals(Modbot::SOUTH, $robot->direction);
    }

    /**
     * test a bot can turn right
     */
    public function testTurnRight() : void
    {
        // change bots direction from north to east
        $robot = new Modbot([0, 0], Modbot::NORTH);
        $robot->turnRight();
        $this->assertEquals([0, 0], $robot->position);
        $this->assertEquals(Modbot::EAST, $robot->direction);

        // Change bots direction from east to south
        $robot->turnRight();
        $this->assertEquals([0, 0], $robot->position);
        $this->assertEquals(Modbot::SOUTH, $robot->direction);

        // Change bots direction from south to west
        $robot->turnRight();
        $this->assertEquals([0, 0], $robot->position);
        $this->assertEquals(Modbot::WEST, $robot->direction);

        // Change bots direction from west to north
        $robot->turnRight();
        $this->assertEquals([0, 0], $robot->position);
        $this->assertEquals(Modbot::NORTH, $robot->direction);
    }

    /**
     * test a bot can turn left
     */
    public function testTurnLeft() : void
    {
        $robot = new Modbot([0, 0], Modbot::NORTH);

        // Change bots direction from north to west
        $robot->turnLeft();
        $this->assertEquals([0, 0], $robot->position);
        $this->assertEquals(Modbot::WEST, $robot->direction);

        // Change bots direction from west to south
        $robot->turnLeft();
        $this->assertEquals([0, 0], $robot->position);
        $this->assertEquals(Modbot::SOUTH, $robot->direction);

        // Change bots direction from south to east
        $robot->turnLeft();
        $this->assertEquals([0, 0], $robot->position);
        $this->assertEquals(Modbot::EAST, $robot->direction);

        // Change bots direction from east to north
        $robot->turnLeft();
        $this->assertEquals([0, 0], $robot->position);
        $this->assertEquals(Modbot::NORTH, $robot->direction);
    }

    /**
     * Move the bot forward in the direction its facing
     */
    public function testAdvance() : void
    {
        // Increment y coordinate by one when facing north
        $robot = new Modbot([0, 0], Modbot::NORTH);
        $robot->advance();
        $this->assertEquals([0, 1], $robot->position);
        $this->assertEquals(Modbot::NORTH, $robot->direction);

        // Decrements y coordinate by one when facing south
        $robot = new Modbot([0, 0], Modbot::SOUTH);
        $robot = $robot->advance();
        $this->assertEquals([0, -1], $robot->position);
        $this->assertEquals(Modbot::SOUTH, $robot->direction);

        // Increment x coordinate by one when facing east
        $robot = new Modbot([0, 0], Modbot::EAST);
        $robot = $robot->advance();
        $this->assertEquals([1, 0], $robot->position);
        $this->assertEquals(Modbot::EAST, $robot->direction);

        // Decrements x coordinate by one when facing west
        $robot = new Modbot([0, 0], Modbot::WEST);
        $robot = $robot->advance();
        $this->assertEquals([-1, 0], $robot->position);
        $this->assertEquals(Modbot::WEST, $robot->direction);
    }

    /**
     * test instructions are correctly matched to the appropriate command
     */
    public function testInstructions() : void
    {
        $robot = new Modbot([0, 0], Modbot::NORTH);
        $robot->instructions('ARAAALAL');
        $this->assertEquals([3, 2], $robot->position);
        $this->assertEquals(Modbot::WEST, $robot->direction);

        $robot = new Modbot([0, 0], Modbot::NORTH);
        $robot->instructions('LAAARALA');
        $this->assertEquals([-4, 1], $robot->position);
        $this->assertEquals(Modbot::WEST, $robot->direction);

        $robot = new Modbot([2, -7], Modbot::EAST);
        $robot->instructions('RRAAAAALA');
        $this->assertEquals([-3, -8], $robot->position);
        $this->assertEquals(Modbot::SOUTH, $robot->direction);

        $robot = new Modbot([8, 4], Modbot::SOUTH);
        $robot->instructions('LAAARRRALLLL');
        $this->assertEquals([11, 5], $robot->position);
        $this->assertEquals(Modbot::NORTH, $robot->direction);
    }

    /**
     * Test bad instructions throw an exception
     */
    public function testMalformedInstructions() : void
    {
        $this->expectException(InvalidArgumentException::class);

        $robot = new Modbot([0, 0], Modbot::NORTH);
        $robot->instructions('LARX');
    }

    /**
     * Test instructions are chained
     */
    public function testInstructionsChaining() : void
    {
        $robot = new Modbot([0, 0], Modbot::NORTH);
        $robot->turnLeft()
            ->advance()
            ->advance()
            ->advance()
            ->turnRight()
            ->advance()
            ->turnLeft()
            ->advance();
        $this->assertEquals([-4, 1], $robot->position);
        $this->assertEquals(Modbot::WEST, $robot->direction);
    }
}
