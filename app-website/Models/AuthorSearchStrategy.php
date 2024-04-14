<?php

namespace App\Models;

use App\Interfaces\Strategy;

class AuthorSearchStrategy implements Strategy {

    public function search(string $authorName) {
        if (session_status() === PHP_SESSION_NONE || !isset($_SESSION['books']) || !isset($_SESSION['authors']) || !isset($_SESSION['borrows'])) {
            Loader::loadDatas();
        }

        $authors = $_SESSION['authors'];
        $authorOfSearch = NULL;

        foreach ($authors as $author) {
            if ($author instanceof AuthorDTO) {
                if ($author->getName() == $authorName) {
                    $authorOfSearch = $author;
                }
            }


            if ($authorOfSearch != NULL) {
                $booksOfSearch = [];
                $books = $_SESSION['books'];
    
                foreach ($books as $book) {
                    if ($book instanceof BookDTO) {
                        if ($book->getAuthorId() == $authorOfSearch->getId()) {
                            array_push($booksOfSearch, $book);
                        }
                    }
    
                }
            }

            return $booksOfSearch;
        
        }
    }
}

?>