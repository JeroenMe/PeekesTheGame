<?php

namespace Classes;

use Classes\Character;

class GameHandler
{
    protected $characters = [];
    protected $characterTurn, $gameTurn;
    protected $char1Name, $char2Name;
    public function __construct(string $char1Name, string $char2Name)
    {
        $this->characters[$char1Name] = new Character($char1Name, $this->spawnRandomWeapon(), $this->spawnRandomArmor());
        $this->characters[$char2Name] = new Character($char2Name, $this->spawnRandomWeapon(), $this->spawnRandomArmor());
        $this->char1Name = $char1Name;
        $this->char2Name = $char2Name;
        $this->characterTurn = $char1Name;
        $this->gameTurn = 0;
    }
    //@todo: create logic for strategies and make characters able to change their strategy every 3 rounds
    protected function spawnRandomWeapon(){
        $rnd = rand(0,2);
        switch ($rnd){
            case 0: return 'bow';
                break;
            case 1: return 'punch';
                break;
            case 2: return 'spear';
                break;
        }
    }

    protected function spawnRandomArmor(){
        $rnd = rand(0,2);
        switch ($rnd){
            case 0: return 'leather';
                break;
            case 1: return 'iron';
                break;
            case 2: return 'platinum';
                break;
        }
    }

    public function startGame(){
        printf("The game has started \n");
        $this->attack($this->char1Name, $this->char2Name);

    }
    public function nextGameTurn()
    {
        $this->gameTurn += 1;
    }

    public function checkIfGameIsWon()
    {
        foreach ($this->characters as $char) {
            if ($char->getIsAlive() === false) {
                return $char->getName() . " is dead!";
            }
        }
    }

    public function attack($attacker, $target){
        if ($this->characterTurn == $this->char1Name){
            $this->nextGameTurn();
            print("\n Round " . $this->gameTurn . "\n -------------------- \n \n");

        }
        $damage = $this->characters[$attacker]->getWeaponDamage();
        $this->characters[$target]->takeDamage($damage);
        print($attacker . ' attacks ' . $target . ' with '. $this->characters[$attacker]->getWeaponName() . ' for ' . $damage . " damage \n");
        $negatedDamage = ($this->characters[$target]->getArmorResistance() * 100) . '%';
        print($target . "'s " . $this->characters[$target]->getArmorName() ." negated " . $negatedDamage . " of the damage \n");
        //sleep(1);
        print( $target . ' now has ' . $this->characters[$target]->getHealth() . " hitpoints \n");
        $this->nextCharacterTurn($target);
        //sleep(1);
        if ($this->checkIfGameIsWon() == false){
            $this->attack($target, $attacker);
        }
        else{
            echo "game won by " . $attacker ."\n";
        }
    }

    public function nextCharacterTurn($characterName){
        $this->characterTurn =$characterName;
    }

    public function getCharacterTurn()
    {
        return $this->characterTurn;
    }

    public function getGameTurn()
    {
        return $this->gameTurn;
    }

    public function getCharacters(){
        return $this->characters;
    }
}
