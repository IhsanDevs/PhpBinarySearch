# Binary Search

## About

Binary Search is a search algorithm that finds the position of a target value within a sorted array. Binary search compares the target value to the middle element of the array. If they are not equal, the half in which the target cannot lie is eliminated and the search continues on the remaining half, again taking the middle element to compare to the target value, and repeating this until the target value is found. If the search ends with the remaining half being empty, the target is not in the array.

## Installation

```bash
composer require IhsanDevs\PhpBinarySearch
```

## Usage

1. Search with default comparison function

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use IhsanDevs\PhpBinarySearch\BinarySearch;

// Create an instance of BinarySearch
$binarySearch = new BinarySearch();

// Set the data and target
$binarySearch->data = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
$binarySearch->target = 60;

// Perform the search with the default comparison function
$binarySearch->search();

// Print the result
$binarySearch->printResult(); // Output: Target 60 found at index 5 with 0 iteration(s) in 0 second(s) with memory usage 0 byte(s).
```

2. Search with custom comparison function

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use IhsanDevs\PhpBinarySearch\BinarySearch;

$binarySearch = new BinarySearch();

// Create an instance of BinarySearch
$binarySearch = new BinarySearch();

// Set the data and target
$binarySearch->data = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
$binarySearch->target = 60;

// Define a custom comparison function
$customCompareFn = function ($data, $target) {
    if ($data == $target) {
        return 0;
    }
    return ($data > $target) ? 1 : -1;
};

// Perform the search with the custom comparison function
$binarySearch->search($customCompareFn);

// Print the result
$binarySearch->printResult(); // Output: Target 60 found at index 5 with 0 iteration(s) in 0 second(s) with memory usage 0 byte(s).
```

if you want see the result with log you can use `printLog()` method.

```php
<?php

...

// Print the result with log
$binarySearch->printResult()->printLog();
```

Also you can use `printDebug()` method to print the result with debug.

```php
<?php

...

// Print the result with debug
$binarySearch->printResult()->printDebug();
```

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
