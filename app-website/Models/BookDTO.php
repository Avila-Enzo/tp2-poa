<?php

namespace App\Models;

class BookDTO {

    /* Attributs */
    protected int $id;
    protected string $title;
    protected string $publicationDate;
    protected int $nbPages;
    protected string $description;
    protected string $ISBN;
    protected int $authorId;
    protected string $authorName;
    protected bool $isAvailable = true;


    /* Constructeur */
    public function __construct(int $id, string $title, string $publicationDate, int $nbPages, string $description, string $ISBN, int $authorId, string $authorName, bool $isAvailable) {
        $this->title = $title;
        $this->publicationDate = $publicationDate;
        $this->nbPages = $nbPages;
        $this->description = $description;
        $this->ISBN = $ISBN;
        $this->authorId = $authorId;
        $this->isAvailable = $isAvailable;
        $this->id = $id;
        $this->authorName = $authorName;
    }


    /* Getters */

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthorId() {
        return $this->authorId;
    }

    public function getAuthorName() {
        return $this->authorName;
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

    public function getIsAvailable() {
        return $this->isAvailable;
    }


    /* Setters */

    public function setTitle(string $title) {
        $this->title = $title;
    }

    public function setAuthorId(int $authorId) {
        $this->authorId = $authorId;
    }

    public function setAuthorName(string $authorName) {
        $this->authorName = $authorName;
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

    public function setIsAvailable(bool $isAvailable) {
        $this->isAvailable = $isAvailable;
    }
}

?>