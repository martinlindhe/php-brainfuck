<?php

require_once __DIR__ . '/vendor/autoload.php';

use MartinLindhe\Brainfuck\Interpreter;

$i = new Interpreter;

// prints "A"
//$i->exec('++++++ [ > ++++++++++ < - ] > +++++ .');



/*
This program reads a character from the user input and copies the character into
cell #1. Then we start a loop. Move to cell #2, increment the value at cell #2,
move back to cell #1, and decrement the value at cell #1. This continues on
until cell #1 is 0, and cell #2 holds cell #1's old value. Because we're on
cell #1 at the end of the loop, move to cell #2, and then print out the value
in ASCII.
*/
$i->exec(', [ > + < - ] > .');
