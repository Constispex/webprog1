<?php

class Book
{
    public string $title;
    public string $author;
    public string $publisher;
    public int $rating;
    public string $subareas;


    public function __construct($title, $author, $publisher, $rating, $subareas)
    {
        $this->title = $title;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->rating = $rating;
        $this->subareas = $subareas;
    }
}
