<?php

namespace App\Models;

class Book {

    /* Attributs */
    protected string $title;
    protected string $publicationDate;
    protected int $nbPages;
    protected string $description;
    protected string $ISBN;


    /* Constructeur */
    public function __construct(string $title, string $publicationDate, int $nbPages, string $description, string $ISBN) {
        $this->title = $title;
        $this->publicationDate = $publicationDate;
        $this->nbPages = $nbPages;
        $this->description = $description;
        $this->ISBN = $ISBN;
    }


    /* Getters */

    public function getTitle() {
        return $this->title;
    }

    public function getPublicationDate() {
        return $this->publicationDate;
    }

    public function getNbPages() {
        return $this->nbPages;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getISBN() {
        return $this->ISBN;
    }


    /* Setters */

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function setPublicationDate(string $publicationDate) {
        $this->publicationDate = $publicationDate;
    }

    public function setNbPages(int $nbPages) {
        $this->nbPages = $nbPages;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function setISBN(string $ISBN) {
        $this->ISBN = $ISBN;
    }
}

?>