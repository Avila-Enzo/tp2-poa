<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Loader;

class UsersController extends Controller {

  /**
  * Affiche la liste des productions.
  */
  public function index() {

    Loader::loadDatas();

    // Afficher la vue
    $this->display(
        'user/list.html.twig',
        [
            'users' => $_SESSION['users'],
        ]
    );
  }


  /**
   * Effacer une production.
   * @param  integer $id identifiant de la production à effacer.
   */
  public function delete($id) {
    // il faut récupérer les information sur la production
    User::getInstance()->delete($id);
    redirect('/users');
  }

  /**
   * Afficher le formulaire d'ajout d'une production.
   */
  public function add() {
    $this->display('user/add.html.twig');
  }

  /**
   * Enregistrer une nouvelle production.
   */
  public function save() {
    User::getInstance()->add( $_POST );

    redirect('/users');
  }

  /**
   * Afficher le formulaire d'édition d'une production.
   * @param  integer $id identifiant de la production à éditer.
   */
  public function edit($id) {
    $this->display('user/edit.html.twig', [
      'user' => User::getInstance()->get($id)
    ]);
  }

  /**
   * Mettre à jour une production.
   */
  public function update($id) {
    User::getInstance()->update($id, $_POST);
    redirect('/users');
  }
}