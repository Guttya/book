<?php

function fib($n)
{
    $a = 1;
    $b = 1;
    for ($d = 3; $d <= $n; $d++) {
        $c = $a + $b;
        $a = $b;
        $b = $c;
    }

    echo $c;
}
fib(7);


