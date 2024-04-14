<?php

namespace App\Models;

use App\Interfaces\Command;
use App\Models\UserDTO;
use App\Models\BookDTO;

class BorrowBookCommand implements Command {
    protected BookDTO $book;
    protected UserDTO $borrower;
    protected string $dateReturn;

    public function __construct(BookDTO $book, UserDTO $borrower, string $dateReturn) {
        $this->book = $book;
        $this->borrower = $borrower;
        $this->dateReturn = $dateReturn;
    }

    /**
     * Lorsqu'un livre est emprunté
     */
    public function execute() {
        if ($this->book->getIsAvailable()) {
            $this->borrower->addBorrow($this->book->getId(), $this->dateReturn);
            $this->book->setIsAvailable(false);
        }
    }

    public function getBook() {
        return $this->book;
    }
}

?>