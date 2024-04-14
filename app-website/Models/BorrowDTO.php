<?php

namespace App\Models;

class BorrowDTO {

    protected $id;
    protected int $userId;
    protected int $bookId;
    protected string $dueDate;

    public function __construct(int $id, int $userId, int $bookId, string $dueDate) {
        $this->userId = $userId;
        $this->bookId = $bookId;
        $this->dueDate = $dueDate;
        $this->id = $id;
    }


    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getBookId() {
        return $this->bookId;
    }

    public function getDueDate() {
        return $this->dueDate;
    }

    public function setUserId(int $userId) {
        $this->userId = $userId;
    }

    public function setBookId(int $bookId) {
        $this->bookId = $bookId;
    }

    public function setDueDate(string $dueDate) {
        $this->dueDate = $dueDate;
    }

    public function setId(int $id) {
        $this->id = $id;
    }
}