<?php

namespace PHPUnitTools;

use PHPUnit_Framework_TestListener;
use PHPUnit_Framework_Test;
use PHPUnit_Framework_TestSuite;
use PHPUnit_Framework_AssertionFailedError;
use ReflectionObject;
use Exception;


/**
 *  <listeners>
 *      <listener class="PHPUnitTools\ExecutionTimeListener" file="vendor/phpunit-tools/src/PHPUnitTools/ExecutionTimeListener.php">
 *          <arguments>
 *              <string>time.csv</string>
 *          </arguments>
 *      </listener>
 *  </listeners>
 */
class ExecutionTimeListener implements PHPUnit_Framework_TestListener
{
    protected $startTime;
    protected $fileHandle;

    public function __construct($fileName)
    {
        $this->fileHandle = fopen($fileName, 'w+');
    }

    public function __destruct()
    {
        fclose($this->fileHandle);
    }

    public function startTest(PHPUnit_Framework_Test $test)
    {
        $this->startTime = microtime(true);
    }

    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        $elapsedTime = microtime(true) - $this->startTime;
        fputcsv($this->fileHandle, array($test->toString(), $elapsedTime));
    }

    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time) { }
    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite) { }
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite) { }
} 
