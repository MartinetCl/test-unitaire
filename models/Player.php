<?php
// MARTINET Clément

class Player {
    public $position = [];
    public $orientation = "";

    public function __construct(array $position, string $orientation) {
        $this->position = $position;
        $this->orientation = $orientation;
    }
}