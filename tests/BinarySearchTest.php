<?php

// Anda mungkin perlu mengganti ini untuk mencocokkan struktur direktori dan namespace Anda
use IhsanDevs\PhpBinarySearch\BinarySearch;
use PHPUnit\Framework\TestCase;

class BinarySearchTest extends TestCase
{
    public function testBinarySearch()
    {
        $binarySearch = new BinarySearch();
        $binarySearch->data = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
        $binarySearch->target = 50;
        $binarySearch->search();
        $this->assertTrue($binarySearch->found);
        $this->assertEquals(4, $binarySearch->index);
    }
}