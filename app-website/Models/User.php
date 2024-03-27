<?php

namespace App\Models;

use App\Interfaces\Subject;
use App\Interfaces\Observer;

class User implements Subject {

    protected $lateReturns = 0;
    protected $username;


    public function __constructor(string $username) {
        $this->username = $username;
    }


    public function attach(Observer $observer) {

    }

    public function detach(Observer $observer) {

    }

    public function notify() {

    }

    /**
     * Donne la liste des retards de rendu en cours
     */
    public function getLateReturns() {
        return $this->lateReturns;
    }

    /**
     * Ajoute un retard à l'utilisateur
     */
    public function addLateReturn() {
        $this->lateReturns++;
    }

    /**
     * Supprime un retard dans la liste des retards de rendus en cours en fonction du titre du livre
     */
    public function removeLateReturn(string $bookTitle) {
        $this->lateReturns--;
    }

    /**
     * Renvoie la valeur de l'username
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Modifie la valeur de l'username
     */
    public function setUsername(string $username) {
        $this->username = $username;
    }
}

?>