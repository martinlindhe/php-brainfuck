<?php

require_once __DIR__ . '/vendor/autoload.php';

use MartinLindhe\Brainfuck\Interpreter;

$i = new Interpreter;

// prints "A"
$i->exec('++++++ [ > ++++++++++ < - ] > +++++ .');


// reads input, does some stuff and prints it out
//$i->exec(', [ > + < - ] > .');
