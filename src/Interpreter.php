<?php namespace MartinLindhe\Brainfuck;

use SplFixedArray;

class Interpreter
{
    protected $cells;

    protected $pointer = 0;

    public function exec($s)
    {
        $this->reset();
        $pos = 0;

        for ($i = 0; $i < strlen($s); $i++) {
            $c = substr($s, $i, 1);
            if (in_array($c, ['.', ',', '<', '>', '+', '-', '[', ']'])) {
                //echo "executing ".$c."\n";
            }
            $pos++;

            switch ($c) {
                case ',': // input
                    $this->cells[$this->pointer] = $this->charFromStdin();
                    break;
                case '.': // print ascii of current pos
                    echo chr($this->cells[$this->pointer]);
                    break;
                case '+': // increment current value
                    $this->cells[$this->pointer]++;
                    break;
                case '-': // decrement current value
                    $this->cells[$this->pointer]--;
                    break;
                case '>': // move data pointer to next cell
                    $this->pointer++;
                    break;
                case '<': // mve data pointer to previous cell
                    $this->pointer--;
                    if ($this->pointer < 0) {
                        echo "ERROR: pointer is negative at position ".$pos."\n";
                    }
                    break;

                case '[': // if value of current cell is zero, move forward to corrsponding ]
                    if (!$this->cells[$this->pointer]) {
                        do {
                            $i++;
                        } while (substr($s, $i, 1) != ']');
                        $i--;
                    }
                    break;

                case ']': // if value of current cell is not zero, move backwards to the corresponding [
                    if ($this->cells[$this->pointer]) {
                        do {
                            $i--;
                        } while (substr($s, $i, 1) != '[');
                        $i++;
                    }
                    break;
            }
        }
    }

    private function reset()
    {
        $this->cells = array_fill(0, 30000, 0);
        $this->pointer = 0;
    }

    private function charFromStdin()
    {
        readline_callback_handler_install('', function() { });

        $x = stream_get_contents(STDIN, 1);
        echo "got ".$x;
        return $x;
    }
}
