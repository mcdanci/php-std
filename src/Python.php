<?php

/**
 * @copyright since 21:42 17/3/2020
 * @author <mc@dancis.info>
 */

namespace McDanci\std;

class Python
{
    /**
     * @ref https://docs.segmentfault.com/python~3.6/library/functions#input
     * @todo
     */
    function input($prompt = null, $rTrim = true)
    {
        if (is_string($prompt)) {
            echo $prompt;
        }

        if ($input = fgets(STDIN)) {
            return $rTrim ? rtrim($input) : $input;
        } else {
            throw new \RuntimeException('No more data, or error occurred');
        }
    }
}
