<?php

namespace App\Models;

use App\Interfaces\Strategy;

class ISBNSearchStrategy implements Strategy {

    public function search(string $title) {
        // /!\ --- Logique pour rechercher un livre grâce à son ISBN --- /!\
    }
}

?>