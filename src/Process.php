<?php

namespace Crocess\CrocessCaller;

abstract class Process
{
	/**
	 * The command string.
	 *
	 * @var string
	 */
	protected $command;

	/**
	 * The arguments of the command.
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
	 * Indicate the process is returning a json string.
	 *
	 * @var boolean
	 */
	protected $returnsJson = false;

	/**
	 * Indicate the begin identifier.
	 *
	 * @var string
	 */
	protected $beginIdentifier;

	/**
	 * Indicate the variable to store the original output.
	 * The original output will not be added when the variable set to null.
	 *
	 * @var string
	 */
	protected $originalVariable = '__ORIGINAL_OUTPUT';

	/**
	 * Create a new process instance.
	 *
	 * @param array|string $args
	 */
	public function __construct($args = [])
	{
		$this->args = is_string($args) ? [$args] : $args;
	}

	/**
	 * Set the process is returning a json string.
	 *
	 * @return $this
	 */
	public function returnsJson()
	{
		$this->returnsJson = true;

		return $this;
	}

	/**
	 * Run the process and get the result.
	 *
	 * @return array|string
	 * @throws ExecutionException
	 */
	public function run()
	{
		$original = $this->command()->run();
		$result = $original;

		/**
		 * If a begin identifier indicated.
		 */
		if ($this->beginIdentifier) {
			$beginPosition = strpos($result, $this->beginIdentifier);

			if ($beginPosition === false) {
				throw new ExecutionException("Could not found the begin identifier: {$this->beginIdentifier}",
				                             $original);
			}

			$result = substr($result, $beginPosition + strlen($this->beginIdentifier));
		}

		/**
		 * If the process is returns a json.
		 */
		if ($this->returnsJson) {
			$result = json_decode($result, true);

			if (! $result) {
				throw new ExecutionException('Unable to parse the output by json.', $original);
			}

			if ($this->originalVariable) {
				$result[ $this->originalVariable ] = $original;
			}
		}

		return $result;
	}

	/**
	 * Get the command instance.
	 *
	 * @return Command
	 */
	protected function command()
	{
		return new Command($this->command, $this->args, $this->workingDirectory ?: null);
	}
}
