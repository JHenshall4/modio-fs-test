<?php

declare(strict_types=1);

namespace Modio\Interfaces;

interface ModbotInterface {

    /**
     * turn the bot 90 deg to the right
     *
     * @return ModbotInterface
     */
    public function turnRight(): ModbotInterface;

    /**
     * turn the bot 90 deg to the left
     *
     * @return ModbotInterface
     */
    public function turnLeft(): ModbotInterface;

    /**
     * advance the bot forward in the direction its facing
     *
     * @return ModbotInterface
     */
    public function advance(): ModbotInterface;

    /**
     * take the instructions and execute them
     *
     * @param string $commands
     * @return ModbotInterface
     */
    public function instructions(string $commands): ModbotInterface;
}