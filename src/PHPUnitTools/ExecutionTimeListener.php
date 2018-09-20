<?php

namespace PHPUnitTools;

use Exception;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;
use ReflectionObject;

/**
 *  <listeners>
 *      <listener class="PHPUnitTools\ExecutionTimeListener" file="vendor/phpunit-tools/src/PHPUnitTools/ExecutionTimeListener.php">
 *          <arguments>
 *              <string>time.csv</string>
 *          </arguments>
 *      </listener>
 *  </listeners>
 */
class ExecutionTimeListener implements TestListener
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

    public function startTest(Test $test)
    {
        $this->startTime = microtime(true);
    }

    public function endTest(Test $test, $time)
    {
        $elapsedTime = microtime(true) - $this->startTime;
        fputcsv($this->fileHandle, array($test->toString(), $elapsedTime));
    }

    public function addError(Test $test, Exception $e, $time)
    {
    }

    public function addWarning(Test $test, Warning $e, $time)
    {
    }

    public function addFailure(Test $test, AssertionFailedError $e, $time)
    {
    }

    public function addIncompleteTest(Test $test, Exception $e, $time)
    {
    }

    public function addRiskyTest(Test $test, Exception $e, $time)
    {
    }

    public function addSkippedTest(Test $test, Exception $e, $time)
    {
    }

    public function endTestSuite(TestSuite $suite)
    {
    }

    public function startTestSuite(TestSuite $suite)
    {
    }
}
