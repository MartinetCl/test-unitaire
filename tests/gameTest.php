<?php
// MARTINET Clément

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;
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
        return assertEquals([10, 10], $game->player1->position) && assertEquals([0, 0], $game->player2->position);
    }

    public static function testGridSize()
    {
        return assertEquals([10, 10], Game::GRID);
    }

    public static function testInitPlayerOrientation()
    {
        $game = new Game();
        return assertEquals("2", $game->player1->orientation) && assertEquals("0", $game->player2->orientation);
    }

    public static function testChangeOrientation()
    {
        $game = new Game();
        return assertEquals(3, $game->player1->changeOrientationRight()) && assertEquals(3, $game->player2->changeOrientationLeft());
    }

    public static function testMove()
    {
        $game = new Game();
        return assertEquals([10, 9], $game->player1->Move(1)) && assertEquals([0, 2], $game->player2->move(2));
    }

    public static function testOutOfGrid()
    {
        $game = new Game();
        $game->player1->changeOrientationLeft();
        $game->player1->move(2);
        return assertTrue($game->player1->checkInGrid($game->player1));
    }

    public static function testInGrid()
    {
        $game = new Game();
        $game->player1->move(2);
        return assertTrue($game->player1->checkInGrid($game->player1));
    }

    public static function assertOneTurn()
    {
        $game = new Game();
        return assertNull($game->round([0 => ["action" => "MOVE", "value" => "2"], 1 => ["action" => "MOVE", "value" => 1]]));
    }

    public static function testSee()
    {
        $game = new Game();
        $game->player1->changeOrientationRight();
        $game->player1->move(2);
        $game->player1->move(2);
        $game->player1->move(2);
        $game->player1->move(2);
        $game->player1->move(2);
        $game->player1->changeOrientationLeft();
        return assertTrue($game->checkSee());
    }

    public static function testDistance()
    {
        $game = new Game();
        return assertEquals(14, $game->getDistance());
    }

    public static function testGame()
    {
        $game = new Game();
        $result = $game->launchGame();
        return assertTrue($result === 1 || $result === 2 || $result === 100);
    }
}
