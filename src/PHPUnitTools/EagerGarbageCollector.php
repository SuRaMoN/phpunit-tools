<?php

namespace PHPUnitTools;

use Exception;
use PHPUnit_Framework_AssertionFailedError;
use PHPUnit_Framework_Test;
use PHPUnit_Framework_TestListener;
use PHPUnit_Framework_TestSuite;
use ReflectionClass;
use ReflectionObject;
use ReflectionProperty;


/**
 *  <listeners>
 *      <listener class="PHPUnitTools\EagerGarbageCollector" file="vendor/phpunit-tools/src/PHPUnitTools/EagerGarbageCollector.php" />
 *  </listeners>
 */
class EagerGarbageCollector implements PHPUnit_Framework_TestListener
{
    public function __construct()
    {
    }

    protected function getPHPUnitPropertyNames()
    {
        static $propertyNames = array();
        if(count($propertyNames) != 0) {
            return $propertyNames;
        }
        $phpUnitReflector = new ReflectionClass('PHPUnit_Framework_TestCase');
        foreach($phpUnitReflector->getProperties() as $property) {
            $propertyNames[$property->getName()] = true;
        }
        return $propertyNames;
    }
    
    protected function clearNonPHPUnitProperties($object)
    {
        $phpUnitProperties = $this->getPHPUnitPropertyNames();
        $objectReflector = new ReflectionObject($object);
        foreach($objectReflector->getProperties() as $property) {
            if(! array_key_exists($property->getName(), $phpUnitProperties)) {
                $property->setAccessible(true);
                $property->setValue($object, null);
            }
        }
    }

    public function endTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
        foreach($suite->tests() as $test) {
            $this->clearNonPHPUnitProperties($test);
        }
    }

    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time) { }
    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
    public function endTest(PHPUnit_Framework_Test $test, $time) { }
    public function startTest(PHPUnit_Framework_Test $test) { }
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite) { }
}
