<?php

namespace Crocess\CrocessCaller;

class Command
{
	/**
	 * The command string.
	 *
	 * @var string
	 */
	protected $command;

	/**
	 * The arguments array of the command.
	 *
	 * @var array
	 */
	protected $args = [];

	/**
	 * The command's working directory.
	 *
	 * @var string
	 */
	protected $workingDirectory;

	/**
	 * Create a new command instance.
	 *
	 * @param string $command
	 * @param array  $args
	 * @param string $workingDirectory
	 */
	public function __construct($command, array $args = [], $workingDirectory = null)
	{
		$this->command = $command;
		$this->args = $args;
		$this->workingDirectory = $workingDirectory;
	}

	/**
	 * Make the shell command string by the given command and arguments.
	 *
	 * @return string
	 */
	public function make()
	{
		$args = '';

		foreach ($this->args as $key => $value) {
			$args .= ($args ? ' ' : '') . escapeshellarg(is_string($key) ? "--{$key}={$value}" : $value);
		}

		return trim($this->command) . (count($this->args) ? ' ' . $args : '');
	}

	/**
	 * Run the shell command and the outputs.
	 *
	 * @param bool $redirectStderr
	 *
	 * @return string
	 */
	public function run($redirectStderr = true)
	{
		$command = $this->make();

		if ($this->workingDirectory) {
			$command = 'cd ' . escapeshellarg($this->workingDirectory) . ';'. $command;
		}

		if ($redirectStderr) {
			$command .= ' 2>&1';
		}

		$output = [];
		exec($command, $output);

		return implode("\n", $output);
	}
}
