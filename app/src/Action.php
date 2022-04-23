<?php

namespace Tournament;


class Action
{
    private string $weapon;
    private int $hitPoints;
    private int $damage;
    private int $fullHitPoints;
    private string $shield="";
    private string $armor="";
    private int $shieldDurability=0;
    private int $attacksBlocked=0;
    private int $attackOnEnemy=0;
    private int $armorPenalty=0;
    private int $armorValue=0;
    private string $rank;
private int $blocksHit=1;

    public function engage($opponent):void
    {
           $turn=0;
        while ($this->hitPoints > 0 && $opponent->hitPoints() > 0) {
//fight until someone dies
            if($turn%2==0){
                $attacker=$this;
                $defender=$opponent;
            }else{
                $attacker=$opponent;
                $defender=$this;
            }
//change attacker
            $attacker->setAttackOnEnemy($attacker->getAttackOnEnemy()+1);
            if($attacker->getWeapon()=="Great Sword"&&$attacker->getAttackOnEnemy()%3==0) {
                //Great Sword skips every 3rd attack;
            }elseif ($defender->getShield() == "buckler" && $attacker->getWeapon() == "Axe") {
                    //checks if weapon breaks shield
                    if ($defender->getAttacksBlocked() % $defender->getBlocksHit() == 0) {
                        $defender->setAttacksBlocked($defender->getAttacksBlocked() + 1);
                        $defender->setShieldDurability($defender->getShieldDurability() - 1);
                        if ($defender->getShieldDurability() <= 0) {
                            //breaks shield
                            $defender->setShield("");
                        }
                    } else {
                        $defender->setAttacksBlocked($defender->getAttacksBlocked() + 1);
                        $attacker->hitOpponent($attacker, $defender);
                    }
                } elseif ($defender->getShield() == "buckler") {
                //blocks every (n)$defender->getBlocksHit() times attack
                    if ($defender->getAttacksBlocked() % $defender->getBlocksHit() == 0) {
                        $defender->setAttacksBlocked($defender->getAttacksBlocked() + 1);
                    } else {
                        $defender->setAttacksBlocked($defender->getAttacksBlocked() + 1);
                        $attacker->hitOpponent($attacker, $defender);
                    }
                } else {
                    //opponent takes damage
                    $attacker->hitOpponent($attacker, $defender);
                }
                $turn++;
            //change to opponent turn
            }

    }

    public function hitOpponent($attacker, $defender):void
    {
        $attackerDamage=$attacker->getDamage();
//get weapon damage

        if($attacker->getRank()=="Vicious"&&$attacker->getAttackOnEnemy()<=2){
            $attackerDamage+=20;
        }
        if($attacker->getRank()=="Veteran"&&$attacker->getFullHitPoints()/100*30>$attacker->hitPoints()){
            $attackerDamage*=2;
        }
        //Rank Bonuses
        $attackerDamage=$attackerDamage-$attacker->getArmorPenalty()-$defender->getArmorValue();
        //subtracting armor penalty and opponent defence



     if ($defender->hitPoints() - $attackerDamage < 0) {
            //if hit points drop below 0, set hit points to 0
            $defender->setHitPoints(0);
        } else {
            $defender->setHitPoints($defender->hitPoints() - $attackerDamage);
        }
    }

    //can add new items here;
    public function equip($item):void
    {
        switch ($item) {
            case "Sword":
                $this->setWeapon("Sword");
                $this->setDamage(5);
                break;
            case "Axe":
                $this->setWeapon("Axe");
                $this->setDamage(6);
                break;
            case "Great Sword":
                $this->setWeapon("Great sword");
                $this->setDamage(12);
                break;
            case "buckler":
                $this->setShield($item);
                $this->setShieldDurability(3);
                $this->setBlocksHit(2);
                break;
            case "armor":
                $this->setArmor($item);
                $this->setArmorPenalty(1);
                $this->setArmorValue(3);
                break;
            default:
                break;
        }

    }


    public function setBlocksHit(int $blocksHit): void
    {
        $this->blocksHit = $blocksHit;
    }

    public function getBlocksHit(): int
    {
        return $this->blocksHit;
    }

    public function getFullHitPoints(): int
    {
        return $this->fullHitPoints;
    }

    public function setFullHitPoints(int $fullHitPoints): void
    {
        $this->fullHitPoints = $fullHitPoints;
    }
    public function getRank(): string
    {
        return $this->rank;
    }

    public function setRank(string $rank): void
    {
        $this->rank = $rank;
    }
    public function hitPoints(): int
    {
        return $this->hitPoints;
    }

    public function getDamage(): int
    {
        return $this->damage;
    }

    public function setDamage(int $damage): void
    {
        $this->damage = $damage;
    }

    public function setHitPoints(int $hitPoints): void
    {
        $this->hitPoints = $hitPoints;
    }
    public function getShield(): mixed
    {
        return $this->shield;
    }

    public function getArmor(): mixed
    {
        return $this->armor;
    }
    public function getWeapon(): string
    {
        return $this->weapon;
    }
    public function setShield(mixed $shield): void
    {
        $this->shield = $shield;
    }

    public function setArmor(string $armor): void
    {
        $this->armor = $armor;
    }


    public function setWeapon(string $weapon): void
    {
        $this->weapon = $weapon;
    }


    public function setShieldDurability(int $shieldDurability): void
    {
        $this->shieldDurability = $shieldDurability;
    }

    public function setAttackOnEnemy(int $attackOnEnemy): void
    {
        $this->attackOnEnemy = $attackOnEnemy;
    }

    public function setAttacksBlocked(int $attacksBlocked): void
    {
        $this->attacksBlocked = $attacksBlocked;
    }

    public function getAttackOnEnemy(): int
    {
        return $this->attackOnEnemy;
    }

    public function getAttacksBlocked(): int
    {
        return $this->attacksBlocked;
    }

    public function getShieldDurability(): int
    {
        return $this->shieldDurability;
    }

    public function getArmorPenalty(): int
    {
        return $this->armorPenalty;
    }

    public function getArmorValue(): int
    {
        return $this->armorValue;
    }

    public function setArmorPenalty(int $armorPenalty): void
    {
        $this->armorPenalty = $armorPenalty;
    }

    public function setArmorValue(int $armorValue): void
    {
        $this->armorValue = $armorValue;
    }
}