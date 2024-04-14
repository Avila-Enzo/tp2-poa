<?php

namespace App\Models;

use App\Models\Base;
use App\Models\User;
use App\Models\UserDTO;
use App\Models\Alert;
use App\Models\Book;
use App\Models\BookDTO;
use App\Models\Author;
use App\Models\AuthorDTO;
use App\Models\Borrow;
use App\Models\BorrowDTO;

class Loader extends Base {

    public static function loadAllUsers() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $usersDTO = [];
        $users = User::getInstance()->getAll();
        $count = 0;

        foreach ($users as $user) {
            $userDTO = new UserDTO(intval($user['id']), $user['username']);

            if (isset($_SESSION['borrows'])) {
                foreach ($_SESSION['borrows'] as $borrow) {
                    if ($borrow instanceof BorrowDTO) {
                        if ($borrow->getUserId() == $userDTO->getId()) {
                            $userDTO->addBorrow($borrow->getBookId(), $borrow->getDueDate());
                        }
                    }
                }
            }
            $alert = new Alert();
            $userDTO->attach($alert);
            $userDTO->notify();

            $usersDTO[$count] = $userDTO;
            $count++;
        }

        $_SESSION['users'] = $usersDTO;
    }

    public static function loadAllBooks() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['authors'])) {
            $authors = $_SESSION['authors'];
        }

        $booksDTO = [];
        $books = Book::getInstance()->getAll();
        $count = 0;

        foreach ($books as $book) {
            $bookDTO = new BookDTO(intval($book['id']), $book['title'], $book['publicationDate'], $book['nbPages'], $book['description'], $book['ISBN'], $book['author_id'], 'Inconnu', $book['isAvailable']);
            foreach ($authors as $author) {
                if ($author instanceof AuthorDTO) {
                    if ($author->getId() == $bookDTO->getAuthorId()) {
                        $bookDTO->setAuthorName($author->getName());
                    }
                }
            }
            $booksDTO[$count] = $bookDTO;
            $count++;
        }

        $_SESSION['books'] = $booksDTO;
    }

    public static function loadAllAuthors() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $authorsDTO = [];
        $authors = Author::getInstance()->getAll();
        $count = 0;

        foreach ($authors as $author) {
            $authorDTO = new AuthorDTO(intval($author['id']), $author['name'], $author['bio']);
            $authorsDTO[$count] = $authorDTO;
            $count++;
        }

        $_SESSION['authors'] = $authorsDTO;
    }

    public static function loadAllBorrows() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $borrowsDTO = [];
        $borrows = Borrow::getInstance()->getAll();

        $count = 0;

        
        foreach ($borrows as $borrow) {
            $borrowDTO = new BorrowDTO(intval($borrow['id']), intval($borrow['user_id']), intval($borrow['book_id']), $borrow['due_date']);
            $borrowsDTO[$count] = $borrowDTO;
            $count++;
        }
        

        $_SESSION['borrows'] = $borrowsDTO;
    }

    public static function loadDatas() {
        Loader::loadAllBorrows();
        Loader::loadAllAuthors();
        Loader::loadAllBooks();
        Loader::loadAllUsers();
    }

}