<?php

namespace Tournament;

class Swordsman extends Action
{
    public function __construct($rank="")
    {
        $this->setRank($rank);
        $this->setDamage(5);
        $this->setHitPoints(100);
        $this->setFullHitpoints(100);
        $this->setWeapon("Sword");
    }
}
