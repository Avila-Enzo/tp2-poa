<?php

namespace App\Models;

use App\Interfaces\Command;

class ReturnBookCommand implements Command {
    protected $book;
    protected $borrower;

    public function __construct($book, $borrower) {
        $this->book = $book;
        $this->borrower = $borrower;
    }

    public function execute() {
        // /!\ --- Logique pour retourner le livre --- /!\
    }
}

?>