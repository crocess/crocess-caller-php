<?php

namespace Crocess\CrocessCaller;

use Exception;

class ExecutionException extends Exception
{
	/**
	 * The original output.
	 *
	 * @var string
	 */
	protected $original;

	/**
	 * Create a new execution exception.
	 *
	 * @param string    $message
	 * @param string    $original
	 * @param Exception $previous
	 */
	public function __construct($message, $original, Exception $previous = null)
	{
		$this->original = $original;

		parent::__construct($message, 0, $previous);
	}

	/**
	 * Get the original output.
	 *
	 * @return string
	 */
	public function getOriginal()
	{
		return $this->original;
	}
}
