<?php

namespace App\Controllers;

use App\Models\Author;
use App\Models\Loader;

class AuthorsController extends Controller {

  /**
  * Affiche la liste des productions.
  */
  public function index() {

    Loader::loadDatas();

    // Afficher la vue
    $this->display(
        'author/list.html.twig',
        [
            'authors' => $_SESSION['authors'],
        ]
    );
  }


  /**
   * Effacer une production.
   * @param  integer $id identifiant de la production à effacer.
   */
  public function delete($id) {
    // il faut récupérer les information sur la production
    Author::getInstance()->delete($id);
    redirect('/authors');
  }

  /**
   * Afficher le formulaire d'ajout d'une production.
   */
  public function add() {
    $this->display('author/add.html.twig');
  }

  /**
   * Enregistrer une nouvelle production.
   */
  public function save() {
    Author::getInstance()->add( $_POST );

    redirect('/authors');
  }

  /**
   * Afficher le formulaire d'édition d'une production.
   * @param  integer $id identifiant de la production à éditer.
   */
  public function edit($id) {
    $this->display('author/edit.html.twig', [
      'author' => Author::getInstance()->get($id)
    ]);
  }

  /**
   * Mettre à jour une production.
   */
  public function update($id) {
    Author::getInstance()->update($id, $_POST);
    redirect('/authors');
  }
}