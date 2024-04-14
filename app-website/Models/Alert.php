<?php

namespace App\Models;

use App\Interfaces\Observer;
use App\Interfaces\Subject;

class Alert implements Observer {

    public function update(Subject $subject) {
        if ($subject instanceof UserDTO) {
            foreach ($subject->getBorrows() as $borrow) {
                if ($this->checkDate($borrow[1])) {
                    $subject->setHasLateReturns(true);
                }
            }
        }
    }

    public function checkDate(string $dateString) {
        $date = new \DateTime($dateString);
        $currentDate = new \DateTime();

        if ($date < $currentDate) {
            return true;
        } else {
            return false;
        }
    }
}

?>