<?php

//== Page pour internautes ========================================
$route->addRoute('GET', '/', 'UsersController@index');

//== Gestion des utilisateurs =====================================
$route->addRoute('GET', '/users', 'UsersController@index');
$route->addRoute('GET', '/users/add', 'UsersController@add');
$route->addRoute('POST', '/users/add', 'UsersController@save');
$route->addRoute('GET', '/users/delete/{id:[0-9]+}', 'UsersController@delete');
$route->addRoute('GET', '/users/edit/{id:[0-9]+}', 'UsersController@edit');
$route->addRoute('POST', '/users/edit/{id:[0-9]+}', 'UsersController@update');

//== Gestion des livres =====================================
$route->addRoute('GET', '/books', 'BooksController@index');
$route->addRoute('GET', '/books/delete/{id:[0-9]+}', 'BooksController@delete');
$route->addRoute('GET', '/books/search', 'BooksController@search');
$route->addRoute('GET', '/books/edit/{id:[0-9]+}', 'BooksController@edit');
$route->addRoute('POST', '/books/edit/{id:[0-9]+}', 'BooksController@update');
$route->addRoute('GET', '/books/add', 'BooksController@add');
$route->addRoute('POST', '/books/add', 'BooksController@save');

//== Gestion des auteurs =====================================
$route->addRoute('GET', '/authors', 'AuthorsController@index');
$route->addRoute('GET', '/authors/delete/{id:[0-9]+}', 'AuthorsController@delete');
$route->addRoute('GET', '/authors/edit/{id:[0-9]+}', 'AuthorsController@edit');
$route->addRoute('POST', '/authors/edit/{id:[0-9]+}', 'AuthorsController@update');
$route->addRoute('GET', '/authors/add', 'AuthorsController@add');
$route->addRoute('POST', '/authors/add', 'AuthorsController@save');

//== Gestion des emprunts =====================================
$route->addRoute('GET', '/borrows', 'BorrowsController@index');
$route->addRoute('GET', '/borrows/delete/{id:[0-9]+}', 'BorrowsController@delete');
$route->addRoute('GET', '/borrows/add', 'BorrowsController@add');
$route->addRoute('POST', '/borrows/add', 'BorrowsController@save');