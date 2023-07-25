<?php
// MARTINET Clément

include 'Player.php';

class Game
{
    public $player1 = null;
    public $player2 = null;

    const GRID = [10, 10];

    public function __construct()
    {
        $this->player1 = new Player([0, 0], "bas");
        $this->player2 = new Player([10, 10], "haut");
    }
}
