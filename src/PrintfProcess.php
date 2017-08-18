<?php

namespace Crocess\CrocessCaller;

class PrintfProcess extends Process
{
	/**
	 * The command string.
	 *
	 * @var string
	 */
	protected $command = 'printf';

	/**
	 * Indicate the begin identifier.
	 *
	 * @var string
	 */
	protected $beginIdentifier = 'BEGIN>';
}
