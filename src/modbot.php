<?php

namespace Modio;

use Modio\Interfaces\ModbotInterface as ModbotInterface;

final class Modbot implements ModbotInterface {
    
    public array $position;
    public string $direction;
    
    const NORTH = "N";
    const SOUTH = "S";
    const EAST = "E";
    const WEST = "W";
    
    private array $compass = ["N", "E", "S", "W"];
    
    public function __construct(array $position = [0, 0], $direction = "N"){
        // Fallback is 0,0 pos and facing north.
        $this->position = $position;
        $this->direction = $direction;
    }

    public function turnRight(): ModbotInterface{
        $key = array_search($this->direction, $this->compass);
        
        if ($key == 3){
            $this->direction = $this->compass[0];
        }else
        {
            $this->direction = $this->compass[$key + 1];
        }

        return $this;
    }
    
    public function turnLeft(): ModbotInterface{
        $key = array_search($this->direction, $this->compass);
        
        if ($key == 0){
            $this->direction = $this->compass[3];
        }else{
            $this->direction = $this->compass[$key - 1];
        }
        
        return $this;    
    }
    
    public function advance(): ModbotInterface{
        if ($this->direction == "N"){
            $this->position[1] = $this->position[1] + 1;
        }
        
        if ($this->direction == "S"){
            $this->position[1] = $this->position[1] -1;
        }
        
        if ($this->direction == "E"){
            $this->position[0] = $this->position[0] + 1;
        }
        
        if ($this->direction == "W"){
            $this->position[0] = $this->position[0] - 1;
        }
        return $this;
    }
    
    public function instructions(string $commands): ModbotInterface{
        if (preg_match('/[^LRA]/', $commands)){
            // Throw an error as there are invalid commands.
            throw new \InvalidArgumentException("Invalid command found.");
        }
        
        // Put instructions into an array to traverse
        $actions = str_split($commands);
        
        foreach($actions as $action){
            if ($action == "L"){
                $this->turnLeft();
            }
            
            if($action == "R"){
                $this->turnRight();
            }
            
            if($action == "A"){
                $this->advance();
            }
        }
        
        return $this;
    }

}
 