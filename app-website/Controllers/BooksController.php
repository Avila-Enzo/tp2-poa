<?php

namespace App\Controllers;

use App\Models\AuthorSearchStrategy;
use App\Models\Book;
use App\Models\ISBNSearchStrategy;
use App\Models\Loader;
use App\Models\TitleSearchStrategy;

class BooksController extends Controller {

  /**
  * Affiche la liste des productions.
  */
  public function index() {

    Loader::loadDatas();

    // Afficher la vue
    $this->display(
        'book/list.html.twig',
        [
            'books' => $_SESSION['books'],
        ]
    );
  }


  /**
   * Effacer une production.
   * @param  integer $id identifiant de la production à effacer.
   */
  public function delete($id) {
    // il faut récupérer les information sur la production
    Book::getInstance()->delete($id);
    redirect('/books');
  }

  /**
   * Afficher le formulaire d'ajout d'une production.
   */
  public function add() {
    Loader::loadDatas();

    $this->display('book/add.html.twig', [
      'authors' => $_SESSION['authors'],
    ]);
  }

  /**
   * Enregistrer une nouvelle production.
   */
  public function save() {
    Book::getInstance()->add( $_POST );

    redirect('/books');
  }

  /**
   * Afficher le formulaire d'édition d'une production.
   * @param  integer $id identifiant de la production à éditer.
   */
  public function edit($id) {
    Loader::loadDatas();
    $this->display('book/edit.html.twig', [
      'book' => Book::getInstance()->get($id),
      'authors' => $_SESSION['authors'],
    ]);
  }

  /**
   * Mettre à jour une production.
   */
  public function update($id) {
    Book::getInstance()->update($id, $_POST);
    redirect('/books');
  }

  public function search() {
    Loader::loadDatas();

    $method = $_GET["method"];
    $term = $_GET["term"];
    $books = [];

    switch ($method) {
      case "title" :
        $strategy = new TitleSearchStrategy();
        $books = $strategy->search($term);
        break;
      
      case "author" : 
        $strategy = new AuthorSearchStrategy();
        $books = $strategy->search($term);
        break;

      case "isbn" : 
        $strategy = new ISBNSearchStrategy();
        $books = $strategy->search($term);
        break;
    }

    // Afficher la vue
    $this->display(
      'book/list.html.twig',
      [
          'books' => $books,
      ]
    );
  }
}