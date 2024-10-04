<?php

namespace App\Models;


class PlayerSession
{
    public $sessionId;
    public $name;
    public $image;
    public $score;

    public function __construct($sessionId, $name, $image, $score)
    {
        $this->sessionId = $sessionId;
        $this->name = $name;
        $this->image = $image;
        $this->score = $score;
    }
}
