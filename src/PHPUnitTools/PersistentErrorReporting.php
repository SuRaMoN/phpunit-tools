<?php

namespace PHPUnitTools;

use Exception;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;

/**
 *  <listeners>
 *      <listener class="PHPUnitTools\PersistentErrorReporting" file="vendor/phpunit-tools/src/PHPUnitTools/PersistentErrorReporting.php">
 *          <arguments>
 *              <string>E_ALL</string>
 *          </arguments>
 *      </listener>
 *  </listeners>
 */
class PersistentErrorReporting implements \PHPUnit\Framework\TestListener
{
    protected $errorLevel;

    public function __construct($errorLevel)
    {
        $this->errorLevel = eval("return $errorLevel;");
    }

    public function startTest(Test $test)
    {
        error_reporting($this->errorLevel);
    }

    public function addError(Test $test, Exception $e, $time) { }
    public function addFailure(Test $test, AssertionFailedError $e, $time) { }
    public function addIncompleteTest(Test $test, Exception $e, $time) { }
    public function addRiskyTest(Test $test, Exception $e, $time) { }
    public function addSkippedTest(Test $test, Exception $e, $time) { }
    public function endTest(Test $test, $time) { }
    public function endTestSuite(TestSuite $suite) { }
    public function startTestSuite(TestSuite $suite) { }
    public function addWarning(Test $test, Warning $e, $time) { }
}
