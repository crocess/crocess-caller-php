<?php

use Crocess\CrocessCaller\PrintfProcess;

class PrintfProcessTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Test run the printf process.
	 *
	 * @return void
	 */
	public function testRunPrintfProcess()
	{
		$result = new PrintfProcess(['BEGIN>Hello World']);
		
		$this->assertEquals("Hello World", $result->run());
	}
	
	/**
	 * Test run the printf process.
	 *
	 * @return void
	 */
	public function testRunPrintfProcessWithReturnsJson()
	{
		$result = new PrintfProcess(['BEGIN>{ "foo": "bar" }']);
		
		$json = $result->returnsJson()->run();
		
		$this->assertArraySubset(['foo' => 'bar'], $json);
		$this->assertEquals('BEGIN>{ "foo": "bar" }', $json[ '__ORIGINAL_OUTPUT' ]);
	}
}
