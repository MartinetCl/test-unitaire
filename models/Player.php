<?php
// MARTINET Clément

class Player
{
    public $position = [];
    public $orientation = "";
    const ORIENTATION = [0, 1, 2, 3];
    const ACTION = ["MOVE", "RIGHT", "LEFT"];


    public function __construct(array $position, string $orientation)
    {
        $this->position = $position;
        $this->orientation = $orientation;
    }

    public function changeOrientationRight()
    {
        return ($this->orientation++) <= 3 ? $this->orientation :  $this->orientation = 0;
    }

    public function changeOrientationLeft()
    {
        return ($this->orientation--) >= 0 ? $this->orientation :  $this->orientation = 3;
    }

    public function move(int $nombre)
    {
        if ($nombre == 1 || $nombre == 2) {
            $position = $this->position;
            switch ($this->orientation) {
                case 0:
                    $this->position[1] += $nombre;
                    break;
                case 1:
                    $this->position[0] += $nombre;
                    break;
                case 2:
                    $this->position[1] -= $nombre;
                    break;
                case 3:
                    $this->position[0] -= $nombre;
                    break;
            }
            if (!$this->checkInGrid($this)) {
                $this->position = $position;
            }
        }
        return $this->position;
    }

    public function checkInGrid()
    {
        if ($this->position[0] >= 0 && $this->position[0] <= Game::GRID[0] && $this->position[1] >= 0 && $this->position[1] <= Game::GRID[1]) {
            return true;
        }
        return false;
    }

    public function play($action, $value = null)
    {
        if (in_array($action, self::ACTION)) {
            switch ($action) {
                case "MOVE":
                    $this->move($value);
                    break;
                case "RIGHT":
                    $this->changeOrientationRight();
                    break;
                case "LEFT":
                    $this->changeOrientationLeft();
                    break;
            }
        }
        return $this->position;
    }
}
