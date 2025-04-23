<?php

namespace App\JeffBook;

class Multiplication implements iOperation
{
    public function run($num, $current)
    {
        // Any number times 0 is 0
        if ($current === 0) {
            return $num;
        }
        return $current * $num;
    }
}