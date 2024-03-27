<?php

namespace App\Models;

use App\Interfaces\Strategy;

class AuthorSearchStrategy implements Strategy {

    public function search(string $author) {
        // /!\ --- Logique pour rechercher un livre grâce au nom de son auteur --- /!\
    }
}

?>