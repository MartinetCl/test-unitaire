<?php
// MARTINET Clément

include 'Player.php';

class Game
{
    public $player1 = null;
    public $player2 = null;
    public $round = [0, 0];
    const GRID = [10, 10];

    public function __construct()
    {
        $this->player1 = new Player([10, 10], "2");
        $this->player2 = new Player([0, 0], "0");
    }

    public function round(array $round)
    {
        $this->round = [0, 0];
        if (!empty($round) && !empty($round[0])) {
            $this->player1->play($round[0]['action'], $round[0]['value'] ?? null);
            $this->round[0] = 1;
        }
        if (self::getDistance() > 0) {
            if (!empty(!empty($round) && !empty($round[1]))) {
                $this->player2->play($round[1]['action'], $round[1]['value'] ?? null);
                $this->round[1] = 1;
            }
            if (self::getDistance() == 0) {
                return 2;
            }
        } else {
            return 1;
        }

        return null;
    }

    public function checkSee()
    {
        $see = 0;
        if ($this->player1->position[0] == $this->player2->position[0]) { // même x
            if ($this->player1->position[1] > $this->player2->position[1]) { //P1 y > P2 y
                if ($this->player1->orientation == 2) { //P1 regarde en bas
                    $see = true;
                }
                if ($this->player2->orientation == 0) { //P2 regarde en haut
                    $see = true;
                }
            } elseif ($this->player1->position[1] < $this->player2->position[1]) { //P2 y > P1 y
                if ($this->player2->orientation == 2) { // P2 regarde en bas
                    $see = true;
                }
                if ($this->player1->orientation == 0) { //P1 regarde en haut
                    $see = true;
                }
            } else {
                $see = true;
            }
        }
        if ($this->player1->position[1] == $this->player2->position[1]) { // même y
            if ($this->player1->position[0] > $this->player2->position[0]) { //P1 x > P2 x
                if ($this->player1->orientation == 1) { //P1 regarde en haut
                    $see = true;
                }
                if ($this->player2->orientation == 3) { //P2 regarde à gauche
                    $see = true;
                }
            } elseif ($this->player1->position[0] < $this->player2->position[0]) { //P2 y > P1 y
                if ($this->player2->orientation == 1) { // P2 regarde à droite
                    $see = true;
                }
                if ($this->player1->orientation == 3) { //P1 regarde à gauche
                    $see = true;
                }
            } else {
                $see = true;
            }
        }
        return $see;
    }

    public function getDistance()
    {
        return (int) abs(sqrt(pow($this->player1->position[0] - $this->player2->position[0], 2) + pow($this->player1->position[1] - $this->player2->position[1], 2)));
    }

    public function generateAction()
    {
        $action = Player::ACTION[rand(0, 2)];
        $value = rand(1, 2);
        return ["action" => $action, "value" => $value];
    }

    public function launchGame()
    {
        $winner = null;
        $turn = 0;
        $distance = [];
        while ($winner == null && $turn < 100) {
            $winner = self::round([0 => self::generateAction(), 1 => self::generateAction()]);
            if (($tmpDist = $this->getDistance()) > 0 && $winner = null) {
                array_push($distance, $tmpDist);
            }
            $turn++;
        }
        return $winner ?? $turn;
    }
}
