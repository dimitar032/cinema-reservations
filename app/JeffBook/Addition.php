<?php

namespace App\JeffBook;

class Addition implements iOperation
{
    public function run($num, $current)
    {
        return $current + $num;
    }
}