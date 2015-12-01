<?php namespace MartinLindhe\Brainfuck;

class Interpreter
{
    protected $cells;

    protected $pointer = 0;

    public function exec($s)
    {
        $this->reset();
        $pos = 0;
        $instrCount = 0;

        for ($i = 0; $i < strlen($s); $i++) {
            $c = substr($s, $i, 1);
            $pos++;

            switch ($c) {
                case ',':
                    // save user input to current cell
                    $this->cells[$this->pointer] = ord($this->charFromStdin());
                    break;

                case '.':
                    // print ascii of current cell
                    echo chr($this->cells[$this->pointer]);
                    break;

                case '+':
                    // increment current value
                    $this->cells[$this->pointer]++;
                    break;

                case '-':
                    // decrement current value
                    $this->cells[$this->pointer]--;
                    break;

                case '>':
                    // move data pointer to next cell
                    $this->pointer++;
                    break;

                case '<':
                    // move data pointer to previous cell
                    $this->pointer--;
                    if ($this->pointer < 0) {
                        echo "ERROR: pointer is negative at position ".$pos."\n";
                    }
                    break;

                case '[':
                    // if value of current cell is zero,
                    // move forward to the command after matching ]
                    if (!$this->cells[$this->pointer]) {
                        do {
                            $i++;
                        } while (substr($s, $i, 1) != ']');
                    }
                    break;

                case ']':
                    // if value of current cell is not zero,
                    // move backwards to the command after matching [
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

        return stream_get_contents(STDIN, 1);
    }
}
