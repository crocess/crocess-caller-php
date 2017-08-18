# crocess-caller

Simply call external programs and format outputs.

## Installation

    composer require crocess/crocess-caller

## Usage

### Command

We all know that the `printf` command will print what you passing,
so the output should be the `Hello World`:

~~~php
use Crocess\CrocessCaller\Command;

$output = (new Command('printf', ['Hello World']))->run();

// => Hello World
~~~

### Process

Define a `Process` class:

~~~php
class PrintfCommand extends \Crocess\CrocessCaller\Process
{
    protected $command = 'printf';
}
~~~

Run it with the `Hello Printf`:

~~~php
$output = (new PrintfCommand(['Hello Printf']))->run();

// => Hello Printf
~~~

#### Make the Process format JSON outputs:

~~~php
class PrintfCommand extends \Crocess\CrocessCaller\Process
{
    protected $command = 'printf';

    protected $returnsJson = true;
}
~~~

Run the process, and it will return an array:

~~~php
$json = json_encode(['foo' => 'bar']);

$output = (new PrintfCommand([$json]))->run();
 
// => ["foo" => "bar"]
~~~

#### Specify the working directory:

~~~php
class ExampleProcess extends \Crocess\CrocessCaller\Process
{
    protected $workingDirectory = '/home/foo/bar';
}
~~~

### Crocess

[Learn more about Crocess](https://github.com/crocess/crocess)

~~~js
// example.js

var Application = require('crocess').Application;

new Application().boot(function () {
    return 'Hello, ' + this.parameters.name;
});
~~~

~~~php
// caller.php

class Example extends \Crocess\CrocessCaller\Crocess
{
    protected $command = 'node /home/example.js';
}

$result = (new Example(['name' => 'Example']))->run();

// => Hello Example
~~~

> Note: The `Crocess` is the derived class of `Process`.
