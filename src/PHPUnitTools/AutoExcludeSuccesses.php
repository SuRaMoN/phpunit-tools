<?php

namespace PHPUnitTools;

use Exception;
use PHPUnit_Framework_AssertionFailedError;
use PHPUnit_Framework_Test;
use PHPUnit_Framework_TestListener;
use PHPUnit_Framework_TestSuite;
use ReflectionObject;


/**
 *  <listeners>
 *      <listener class="PHPUnitTools\AutoExcludeSuccesses" file="vendor/phpunit-tools/src/PHPUnitTools/AutoExcludeSuccesses.php">
 *          <arguments>
 *              <string>phpunit.xml.dist</string>
 *          </arguments>
 *      </listener>
 *  </listeners>
 */
class AutoExcludeSuccesses implements PHPUnit_Framework_TestListener
{
    protected $phpUnitXmlPath;
    protected $excludesId;

    public function __construct($phpUnitXmlPath, $excludesId = '<!-- excludes -->')
    {
        $this->phpUnitXmlPath = $phpUnitXmlPath;
        $this->excludesId = $excludesId;
    }

    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        $reflector = new ReflectionObject($test);
        $unitXml = file_get_contents($this->phpUnitXmlPath);
        $unitXml = str_replace($this->excludesId, "{$this->excludesId}\n<exclude>" . htmlentities($reflector->getFileName()) . "</exclude>", $unitXml);
        file_put_contents($this->phpUnitXmlPath, $unitXml, LOCK_EX);
    }

    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time) { }
    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite) { }
    public function startTest(PHPUnit_Framework_Test $test) { }
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite) { }
}
