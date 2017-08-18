<?php

use Crocess\CrocessCaller\Command;

class CommandTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Test the shell command string.
	 *
	 * @return void
	 */
	public function testMakeShellCommandString()
	{
		$command = new Command('node');
		
		$this->assertEquals("node", $command->make());
	}
	
	/**
	 * Test make the shell command string with arguments
	 *
	 * @return void
	 */
	public function testShellCommandStringWithArgs()
	{
		$command = new Command('node', ['foo']);
		
		$this->assertEquals("node 'foo'", $command->make());
	}
	
	/**
	 * Test make the shell command string with key-value arguments.
	 *
	 * @return void
	 */
	public function testShellCommandStringWithKeyValueArgs()
	{
		$command = new Command('node', ['foo' => 'bar']);
		
		$this->assertEquals("node '--foo=bar'", $command->make());
	}
	
	/**
	 * Test run the printf command.
	 *
	 * @return void
	 */
	public function testRunPrintfCommand()
	{
		$command = new Command('printf', ['Hello World']);
		
		$this->assertEquals("Hello World", $command->run());
	}
	
	/**
	 * Test run the printf command with newline.
	 *
	 * @return void
	 */
	public function testRunPrintfCommandWithNewline()
	{
		$command = new Command('printf', ["Hello\nWorld"]);
		
		$this->assertEquals("Hello\nWorld", $command->run());
	}
}
