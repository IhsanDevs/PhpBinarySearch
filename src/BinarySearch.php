<?php
namespace IhsanDevs\PhpBinarySearch;

/**
 * BinarySearch
 *
 * Implements a binary search algorithm for searching in sorted arrays.
 *
 * PHP version 7.2
 *
 * @author     Ihsan Devs <contact@ihsandevs.com>
 * @contact    contact@ihsandevs.com
 * @copyright  2023 Ihsan Devs
 * @license    http://opensource.org/licenses/MIT MIT License
 * @link       https://github.com/IhsanDevs/PhpBinarySearch
 */

/**
 * Summary of BinarySearch
 */
class BinarySearch
{
    /**
     * @var array $data The sorted array of data to be searched.
     */
    public $data = [];

    /**
     * @var mixed $target The target value to be searched in the data.
     */
    public $target = null;

    /**
     * @var mixed $result The value found in the data, or null if not found.
     */
    public $result = null;

    /**
     * @var bool $found Indicates whether the target value has been found.
     */
    public $found = false;

    /**
     * @var int|null $index The index of the target value in the data, or null if not found.
     */
    public $index = null;

    /**
     * @var int $count The number of iterations performed in the binary search.
     */
    public $count = 0;

    /**
     * @var float $time The time taken to perform the search in seconds.
     */
    public $time = 0;

    /**
     * @var int $memory The memory used to perform the search in bytes.
     */
    public $memory = 0;

    /**
     * @var string|null $error The error message, if any.
     */
    public $error = null;

    /**
     * @var array $debug An array containing debug information.
     */
    public $debug = [];

    /**
     * @var array $log An array containing logs of the search process.
     */
    public $log = [];

    /**
     * Summary of search
     * @param callable|null $compareFn A custom comparison function, or null to use the default comparison
     * @return void
     */
    public function search(callable $compareFn = null)
    {
        // start time
        $start_time = microtime(true);

        // start memory
        $start_memory = memory_get_usage();

        // start search
        $this->result = $this->binarySearch($this->data, $this->target, 0, count($this->data) - 1, $compareFn);

        // end time
        $end_time = microtime(true);

        // end memory
        $end_memory = memory_get_usage();

        // set time
        $this->time = $end_time - $start_time;

        // set memory
        $this->memory = $end_memory - $start_memory;
    }

    /**
     * Summary of binarySearch
     * @param mixed $data
     * @param mixed $target
     * @param int $low
     * @param int $high
     * @param callable|null $compareFn A custom comparison function, or null to use the default comparison
     * @return mixed
     */
    private function binarySearch($data, $target, $low, $high, callable $compareFn = null)
    {
        if ($low > $high)
        {
            return null;
        }

        $middle_index = floor(($low + $high) / 2);
        $middle_value = $data[$middle_index];

        $compareResult = $compareFn ? $compareFn($middle_value, $target) : ($middle_value <=> $target);

        if ($compareResult === 0)
        {
            $this->found = true;
            $this->index = $middle_index;
            return $middle_value;
        }

        if ($compareResult > 0)
        {
            return $this->binarySearch($data, $target, $low, $middle_index - 1, $compareFn);
        }

        return $this->binarySearch($data, $target, $middle_index + 1, $high, $compareFn);
    }



    /**
     * Prints the search result and returns the BinarySearch instance for method chaining.
     *
     * @return BinarySearch
     */
    public function printResult()
    {
        // check if found
        if ($this->found)
        {
            // print result
            echo "Target {$this->target} found at index {$this->index} with {$this->count} iteration(s) in {$this->time} second(s) with memory usage {$this->memory} byte(s).";
        }
        else
        {
            // print result
            echo "Target {$this->target} not found with {$this->count} iteration(s) in {$this->time} second(s) with memory usage {$this->memory} byte(s).";
        }

        return $this;
    }

    /**
     * Prints the debug information and returns the BinarySearch instance for method chaining.
     *
     * @return BinarySearch
     */
    public function printDebug()
    {
        // if is executed in CLI, print debug withouth HTML tags
        if (php_sapi_name() === 'cli')
        {
            // print debug
            echo "Debug: ";
            print_r($this->debug);
        }
        else
        {
            // print debug
            echo "<pre>";
            print_r($this->debug);
            echo "</pre>";
        }

        return $this;
    }


    /**
     * Handles exceptions by setting the error message.
     *
     * @param \Exception $exception The exception to be handled.
     * @return null;
     */
    public function printLog()
    {
        // if is executed in CLI, print log withouth HTML tags
        if (php_sapi_name() === 'cli')
        {
            // print log
            echo "Log: ";
            print_r($this->log);
        }
        else
        {
            // print log
            echo "<pre>";
            print_r($this->log);
            echo "</pre>";
        }

        return null;
    }

    /**
     * Handles exceptions by setting the error message.
     *
     * @param \Exception $exception The exception to be handled.
     * @return void
     */
    public function exceptionHandler($exception)
    {
        // set error
        $this->error = $exception->getMessage();
    }

    /**
     * Handles errors by setting the error message.
     *
     * @param int $error_number The error number.
     * @param string $error_message The error message.
     * @param string $error_file The file in which the error occurred.
     * @param int $error_line The line number in the file where the error occurred.
     * @return void
     */
    public function errorHandler($error_number, $error_message, $error_file, $error_line)
    {
        // set error
        $this->error = $error_message;
    }

    /**
     * Handles shutdown errors by setting the error message.
     *
     * @return void
     */
    public function shutdownHandler()
    {
        // get error
        $error = error_get_last();

        // check if error
        if ($error)
        {
            // set error
            $this->error = $error['message'];
        }
    }

    /**
     * Constructs a new BinarySearch instance and sets up error and exception handlers.
     */
    public function __construct()
    {
        // set exception handler
        set_exception_handler([$this, 'exceptionHandler']);

        // set error handler
        set_error_handler([$this, 'errorHandler']);

        // set shutdown handler
        register_shutdown_function([$this, 'shutdownHandler']);
    }

    /**
     * Destroys the BinarySearch instance and prints any error messages.
     */
    public function __destruct()
    {
        // check if error
        if ($this->error)
        {
            // print error
            echo $this->error;
        }
    }
}