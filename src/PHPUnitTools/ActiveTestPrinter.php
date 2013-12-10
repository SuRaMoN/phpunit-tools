<?php

namespace PHPUnitTools;

use PHPUnit_Framework_TestListener;
use PHPUnit_Framework_Test;
use PHPUnit_Framework_TestSuite;
use PHPUnit_Framework_AssertionFailedError;
use ReflectionObject;
use Exception;


/**
 *	<listeners>
 *		<listener class="PHPUnitTools\ActiveTestPrinter" file="vendor/phpunit-tools/src/PHPUnitTools/ActiveTestPrinter.php" />
 *	</listeners>
 */
class ActiveTestPrinter implements PHPUnit_Framework_TestListener
{
	public function __construct()
	{
	}

	public function startTest(PHPUnit_Framework_Test $test)
	{
		echo "\n\n{$test->toString()}\n\n";
	}

	public function addError(PHPUnit_Framework_Test $test, Exception $e, $time) { }
	public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time) { }
	public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
	public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time) { }
	public function startTestSuite(PHPUnit_Framework_TestSuite $suite) { }
	public function endTestSuite(PHPUnit_Framework_TestSuite $suite) { }
	public function endTest(PHPUnit_Framework_Test $test, $time) { }
}

