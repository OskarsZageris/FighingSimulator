<?php

namespace Tournament;

class Highlander extends Action
{
    public function __construct($rank="")
    {
        $this->setRank($rank);
        $this->setDamage(12);
        $this->setHitPoints(150);
        $this->setFullHitpoints(150);
        $this->setWeapon("Great Sword");
    }

}
