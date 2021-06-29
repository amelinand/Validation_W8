<?php

class Archer extends Character
{
    public $pointCritic = false ;
    
    public function __construct($name) {
        parent::__construct($name);
        $this->damage = 20;
        $this->quiver = 10;
    }

        ////// Methode choix de l'attaque /////
    public function turn($target) {
        $rand = rand(1, 10);
        if ($this->quiver == 0) {
            $status = $this->attackDague($target); // Si plus de fleche attaque coup de dague 
        } else if ($rand > 3 ) {
            $status = $this->attack($target); // Attaque fléche  ou fléche sur point critique si visé a été activé
        }else if ($rand <= 3 ) {
            $status = $this->pointCritic(); // Active  visé du point critique 
        }
        return $status;
    }

        ////// Methode Dague //////
    public function attackDague($target) {
        $target->setHealthPoints($this->damage/2);
        $status = "$this->name  Coup de dague sur $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }

        ////// Methode Fléche ou Fléche point Critique/////
    public function attack($target) {
        if ($this->pointCritic == true) { // Si visé du point critique à été activé
            $this->pointCritic = false; // Désactive visé du point critique 
            $rand = rand(15, 30)/10; // Calcule  aléatoirement un chiffre entre 1.5 et 3
            $criticDamage = $this->damage * $rand; // domage multiplier le chiffre aléatoire
            $target->setHealthPoints($criticDamage); // Lance la fléche au point critique
            $this->quiver -= 1; // Enlève une fléche au carquois
            $status = "$this->name Tire une fléche au point critique de $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        } else{
            $target->setHealthPoints($this->damage); // Lance fléche normale
            $this->quiver -= 1; // Enlève une fléche au carquois
            $status = "$this->name Tire une fléche sur $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        }
        return $status;
    }


        ///// Methode Visé du point critique ///////
    public function pointCritic() { 
        $this->pointCritic= true; // Activer visé du point critique
        $status = "$this->name Vise le point faible de son adversaire, joueur adverse joue !";
        return $status;
    }






}

