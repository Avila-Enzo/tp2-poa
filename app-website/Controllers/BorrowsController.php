<?php

namespace App\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\BorrowDTO;
use App\Models\BookDTO;
use App\Models\BorrowBookCommand;
use App\Models\UserDTO;
use App\Models\Loader;
use App\Models\ReturnBookCommand;

class BorrowsController extends Controller {

  /**
  * Affiche la liste des productions.
  */
  public function index() {

    Loader::loadDatas();

    $borrows = [];
    $count = 0;

    foreach ($_SESSION['borrows'] as $borrow) {

      if ($borrow instanceof BorrowDTO) {

        $borrows[$count]['id'] = $borrow->getId();

        $borrows[$count]['date'] = $borrow->getDueDate();

        foreach ($_SESSION['users'] as $user) {
          if ($user instanceof UserDTO) {
            if ($user->getId() == $borrow->getUserId()) {
              $borrows[$count]['user'] = $user->getUsername();
            }
          }
        }

        foreach ($_SESSION['books'] as $book) {
          if ($book instanceof BookDTO) {
            if ($book->getId() == $borrow->getBookId()) {
              $borrows[$count]['book'] = $book->getTitle();
            }
          }
        }

        $count++;
      }
    }

    // Afficher la vue
    $this->display(
        'borrow/list.html.twig',
        [
            'borrows' => $borrows,
        ]
    );
  }


  /**
   * Effacer une production.
   * @param  integer $id identifiant de la production à effacer.
   */
  public function delete($id) {

    Loader::loadDatas();

    $borrowToDelete = NULL;

    foreach($_SESSION['borrows'] as $borrow) {
      if ($borrow instanceof BorrowDTO) {
        if ($borrow->getId() == $id) {
          $borrowToDelete = $borrow;
        }
      }
    }

    $borrowItems = [];

    foreach($_SESSION['users'] as $user) {
      if ($user instanceof UserDTO) {
        if ($user->getId() == $borrowToDelete->getUserId()) {
          $borrowItems['user'] = $user;
        }
      }
    }
    

    foreach($_SESSION['books'] as $book) {
      if ($book instanceof BookDTO) {
        if ($book->getId() == $borrowToDelete->getBookId()) {
          $borrowItems['book'] = $book;
        }
      }
    }

    $command = new ReturnBookCommand($borrowItems['book'], $borrowItems['user']);
    $command->execute();

    Book::getInstance()->update($command->getBook()->getID(), 
    [
      'title' => $command->getBook()->getTitle(),
      'publicationDate' => $command->getBook()->getPublicationDate(),
      'nbPages' => $command->getBook()->getNbPages(),
      'description' => $command->getBook()->getDescription(),
      'ISBN' => $command->getBook()->getISBN(),
      'isAvailable' => $command->getBook()->getIsAvailable(),
      'author_id' => $command->getBook()->getAuthorId(),
    ]);
    
    Borrow::getInstance()->delete($id);
    redirect('/borrows');
  }

  /**
   * Afficher le formulaire d'ajout d'une production.
   */
  public function add() {

    Loader::loadDatas();

    $books = [];

    foreach($_SESSION['books'] as $book) {
      if ($book instanceof BookDTO) {
        if ($book->getIsAvailable() == true) {
          array_push($books, $book);
        }
      }
    }

    $this->display('borrow/add.html.twig',
    [
      'users' => $_SESSION['users'],
      'books' => $books,
    ]
  );
  }

  /**
   * Enregistrer une nouvelle production.
   */
  public function save() {
    Loader::loadDatas();

    $borrowItems = [];

    foreach($_SESSION['users'] as $user) {
      if ($user instanceof UserDTO) {
        if ($user->getId() == $_POST['user_id']) {
          $borrowItems['user'] = $user;
        }
      }
    }
    

    foreach($_SESSION['books'] as $book) {
      if ($book instanceof BookDTO) {
        if ($book->getId() == $_POST['book_id']) {
          $borrowItems['book'] = $book;
        }
      }
    }

    $command = new BorrowBookCommand($borrowItems['book'], $borrowItems['user'], $_POST['due_date']);
    $command->execute();

    Book::getInstance()->update($command->getBook()->getID(), 
    [
      'title' => $command->getBook()->getTitle(),
      'publicationDate' => $command->getBook()->getPublicationDate(),
      'nbPages' => $command->getBook()->getNbPages(),
      'description' => $command->getBook()->getDescription(),
      'ISBN' => $command->getBook()->getISBN(),
      'isAvailable' => $command->getBook()->getIsAvailable(),
      'author_id' => $command->getBook()->getAuthorId(),
    ]);

    Borrow::getInstance()->add( $_POST );

    redirect('/borrows');
  }
}