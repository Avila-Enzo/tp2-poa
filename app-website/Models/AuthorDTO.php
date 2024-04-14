<?php

namespace App\Models;

class AuthorDTO {

    protected int $id;
    protected string $name;
    protected string $bio;

    public function __construct(int $id, string $name, string $bio) {
        $this->id = $id;
        $this->name = $name;
        $this->bio = $bio;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getBio() {
        return $this->bio;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function setBio(string $bio) {
        $this->bio = $bio;
    }

}