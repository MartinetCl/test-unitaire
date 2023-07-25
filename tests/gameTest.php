<?php
// MARTINET Clément

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertTrue;

include_once './models/Game.php';

class gameTest extends TestCase
{

    public static function testGameExist()
    {
        $game = new Game();
        return assertTrue($game instanceof Game);
    }

    public static function testHasTwoPlayer()
    {
        $game = new Game();

        return assertNotNull($game->player1) && assertNotNull($game->player2);
    }

    public static function testInitPlayerPosition()
    {
        $game = new Game();
        return assertEquals([0, 0], $game->player1->position) && assertEquals([10, 10], $game->player2->position);
    }

    public static function testGridSize() {
        return assertEquals([10, 10], Game::GRID);
    }

    public static function testInitPlayerOrientation() {
        $game = new Game();
        return assertEquals("bas", $game->player1->orientation) && assertEquals("haut", $game->player2->orientation);
    }


}
