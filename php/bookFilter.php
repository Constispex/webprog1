<?php

class bookFilter
{
    public bool $filterByTitle;
    public bool $filterByAuthor;
    public bool $filterByPublisher;
    public bool $filterByRating;
    public bool $filterBySubareas;

    public function __construct()
    {
    }

    public function filterByTitle($books, $title)
    {
        $filteredBooks = array();
        foreach ($books as $book) {
            if (strstr($book->title, $title)) {
                $filteredBooks[] = $book;
            }
        }
        return $filteredBooks;
    }

    public function filterByAuthor($books, $author)
    {
        $filteredBooks = array();
        foreach ($books as $book) {
            if (strstr($book->author, $author)) {
                $filteredBooks[] = $book;
            }
        }
        return $filteredBooks;
    }

    public function filterByPublisher($books, $publisher)
    {
        $filteredBooks = array();
        foreach ($books as $book) {
            if (strstr($book->publisher, $publisher)) {
                $filteredBooks[] = $book;
            }
        }
        return $filteredBooks;
    }

    public function filterByRating($books, $rating)
    {
        $filteredBooks = array();
        foreach ($books as $book) {
            if (strstr($book->rating, $rating)) {
                $filteredBooks[] = $book;
            }
        }
        return $filteredBooks;
    }

    public function filterBySubareas($books, $subareas)
    {
        $filteredBooks = array();
        foreach ($books as $book) {
            if (strstr($book->subareas, $subareas)) {
                $filteredBooks[] = $book;
            }
        }
        return $filteredBooks;
    }
}