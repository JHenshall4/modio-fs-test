# Modbot Simulator

Implement a Modbot 

Modios needs a program to verify our Modbots movements and actions.

The bot can do three things.

- turn right
- turn left
- advance

Bots are placed on an infinite grid, facing a particular
direction (north, east, south, or west) at a set of {x,y} coordinates,
e.g., {3,8}, with coordinates increasing to the north and east.

The bot will then receive a number of instructions. At which point the
modio verifies the bot's new position, and the
direction it is point.

For example: 
- The instructions string 'ARAAALAL':
  - Advance once
  - Turn right
  - Advance three times
  - Turn left
  - Advance once
  - Turn left
- Say a bot starts at {0, 0} facing north. Running this set
  of instructions should move it to {3, 2} facing west.


## Running the tests

```vendor/bin/phpunit Test/Test.php```

[PHPUnit]: http://phpunit.de


## Source

Inspired by an interview question at a famous company, modified from another code test.

