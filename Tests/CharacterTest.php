<?php


class CharacterTest extends \PHPUnit\Framework\TestCase
{
    protected $char;
    public function setUp()
    {
        $this->char = new Character();
    }

    /**
     * @test
     */
    public function characterCanTakeDamage(){
        $this->char->takeDamage(15);
        $result = $this->char->getHealth();
        $expectedResult = 85;
        $this->assertSame($expectedResult, $result, "the character did not have 85 hp after being hit 15");
    }

    /**
     * @test
     */
    public function characterCanSwitchWeapon(){
        $this->char->switchWeapon('spear');
        $result = $this->char->attack();
        $expectedResult = 20;
        $this->assertSame($expectedResult, $result, "the attack didn't do 20 damage, so he is not wielding a spear");
    }

    /**
     * @test
     */
    public function characterCanSwitchArmor(){
        $this->char->switchArmor('iron');
        $result = $this->char->getArmorResistance();
        $expectedResult = 30;
        $this->assertEquals($expectedResult, $result, "the get armor did not return 30, so he is not wearing iron armor");
    }
}
