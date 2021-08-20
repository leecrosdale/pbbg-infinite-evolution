<?php

if (function_exists('snake_case_to_words')) {
    return;
}

/**
 * Converts a snake_case string to Capitalized Words.
 *
 * @param string $input
 * @return string
 */
function snake_case_to_words(string $input): string
{
    return ucwords(str_replace('_', ' ', $input));
}
