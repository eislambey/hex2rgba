<?php

function hex2rgba(string $hex, float $alpha = 1): string
{
    if (substr($hex, 0, 1) === '#') {
        $hex = ltrim($hex, '#');
    }

    if (strlen($hex) !== 3 && strlen($hex) !== 6) {
        throw new InvalidArgumentException("Invalid hex: {$hex}");
    }
    if($alpha < 0 || $alpha > 1){
        throw new InvalidArgumentException("Alpha must be between 0 and 1");
    }

    if (strlen($hex) === 3) {
        $hex .= $hex;
    }

    [$r, $g, $b] = array_map('hexdec', str_split($hex, 2));

    if ($alpha < 1 && $alpha > 0) {
        $alpha = trim($alpha, '0');
    }
    return "rgba($r, $g, $b, $alpha)";
}
