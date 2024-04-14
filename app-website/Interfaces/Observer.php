<?php

namespace App\Interfaces;

use App\Interfaces\Subject;

interface Observer
{
    public function update(Subject $subject);
}

?>