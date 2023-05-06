<?php

class Result
{
    public $isError = false;
    public $errorText = "";
    public $ergebnis;

    public function __construct($ergebnis)
    {
        $this->ergebnis = $ergebnis;
    }

}