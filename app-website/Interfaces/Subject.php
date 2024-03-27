<?php

namespace App\Interfaces;

use App\Interfaces\Observer;

interface Subject
{
    public function attach(Observer $observer);

    public function detach(Observer $observer);

    public function notify();
}

?>