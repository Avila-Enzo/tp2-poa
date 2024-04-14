<?php

namespace App\Models;

use App\Interfaces\Subject;
use App\Interfaces\Observer;

class UserDTO implements Subject {

    protected $id;
    protected $username;
    protected $observers = [];
    protected $hasLateReturn = false;
    protected $borrows = [];
    protected $nbBorrows = 0;


    public function __construct(int $id, string $username) {
        $this->username = $username;
        $this->id = $id;
    }


    public function attach(Observer $observer) {
        $this->observers[spl_object_hash($observer)] = $observer;
    }

    public function detach(Observer $observer) {
        unset($this->observers[spl_object_hash($observer)]);
    }

    public function notify() {
        foreach ($this->observers as $observer) {
            if ($observer->update($this)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Renvoie la valeur de l'username
     */
    public function getUsername() {
        return $this->username;
    }

    public function getId() {
        return $this->id;
    }

    public function getBorrows() {
        return $this->borrows;
    }

    public function setHasLateReturns(bool $state) {
        $this->hasLateReturn = $state;
    }

    public function getHasLateReturn() {
        return $this->hasLateReturn;
    }

    public function addBorrow(int $idBook, string $dateReturn) {
        $this->borrows[$this->nbBorrows][0] = $idBook;
        $this->borrows[$this->nbBorrows][1] = $dateReturn;
        $this->nbBorrows++;
    }

    public function removeBorrow(int $idBook) {
        for ($i = 0; $i < $this->nbBorrows; $i++) {
            if ($this->borrows[$i][0] == $idBook) {
                unset($this->borrows[$i]);
                $this->borrows = array_values($this->borrows);
                $this->nbBorrows--;
                return true;
            }
        }
    }
}

?>