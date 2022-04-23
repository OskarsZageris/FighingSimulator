<?php
namespace Tournament;

class Viking extends Action
{
    public function __construct($rank="")
    {
        $this->setRank($rank);
        $this->setDamage(6);
        $this->setHitPoints(120);
        $this->setFullHitpoints(120);
        $this->setWeapon("Axe");
    }
}