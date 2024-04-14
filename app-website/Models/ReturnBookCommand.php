<?php

namespace App\Models;

use App\Interfaces\Command;
use App\Models\UserDTO;
use App\Models\BookDTO;

class ReturnBookCommand implements Command {
    protected BookDTO $book;
    protected UserDTO $borrower;

    public function __construct(BookDTO $book, UserDTO $borrower) {
        $this->book = $book;
        $this->borrower = $borrower;
    }

    public function execute() {
        if ($this->borrower->removeBorrow($this->book->getId())) {
            $this->book->setIsAvailable(true);
        }
    }

    public function getBook() {
        return $this->book;
    }
}

?>