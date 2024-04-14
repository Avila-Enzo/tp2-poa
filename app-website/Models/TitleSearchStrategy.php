<?php

namespace App\Models;

use App\Interfaces\Strategy;

class TitleSearchStrategy implements Strategy {

    public function search(string $title) {
        if (session_status() === PHP_SESSION_NONE || !isset($_SESSION['books'])) {
            Loader::loadDatas();
        }

        $booksOfSearch = [];
        $books = $_SESSION['books'];

        foreach ($books as $book) {
            if ($book instanceof BookDTO) {
                if (str_contains($book->getTitle(), $title)) {
                    array_push($booksOfSearch, $book);
                }
            }

        }

        return $booksOfSearch;
    }
}

?>