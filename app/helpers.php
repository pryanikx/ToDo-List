<?php
function getContrastColor($hex) {
    $hex = ltrim($hex, '#');
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    $luminance = (0.2126 * $r + 0.7152 * $g + 0.0722 * $b) / 255;
    return ($luminance > 0.5) ? '#000000' : '#FFFFFF';
}
