<?php

namespace PHPUnitTools;

use PHPUnit_Framework_TestListener;
use PHPUnit_Framework_Test;
use PHPUnit_Framework_TestSuite;
use PHPUnit_Framework_AssertionFailedError;
use Exception;


/**
 *  <listeners>
 *      <listener class="PHPUnitTools\PersistentErrorReporting" file="vendor/phpunit-tools/src/PHPUnitTools/PersistentErrorReporting.php">
 *          <arguments>
 *              <string>E_ALL</string>
 *          </arguments>
 *      </listener>
 *  </listeners>
 */
class PersistentErrorReporting implements PHPUnit_Framework_TestListener
{
    protected $errorLevel;

    public function __construct($errorLevel)
    {
        $this->errorLevel = eval("return $errorLevel;");
    }

    public function startTest(PHPUnit_Framework_Test $test)
    {
        error_reporting($this->errorLevel);
    }

    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time) { }
    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function endTest(PHPUnit_Framework_Test $test, $time) { }
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite) { }
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite) { }
}
