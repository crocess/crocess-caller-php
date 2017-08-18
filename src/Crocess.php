<?php

namespace Crocess\CrocessCaller;

abstract class Crocess extends Process
{
	/**
	 * Specify the argument that used to passing parameters.
	 *
	 * @var string
	 */
	protected $parametersArgument = 'parameters';

	/**
	 * Indicate the process is returning a json string.
	 *
	 * @var boolean
	 */
	protected $returnsJson = true;

	/**
	 * Indicate the begin identifier.
	 *
	 * @var string
	 */
	protected $beginIdentifier = '>>>>>BEGIN_RESULT>>>>>';

	/**
	 * Create a new crocess process.
	 *
	 * @param array        $parameters
	 * @param array|string $args
	 */
	public function __construct(array $parameters = [], $args = [])
	{
		parent::__construct(array_merge(is_string($args) ? [$args] : $args,
		                                [$this->parametersArgument => json_encode($parameters)]));
	}
}
