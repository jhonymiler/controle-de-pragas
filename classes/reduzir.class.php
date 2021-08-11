<?php

define("STR_REDUCE_LEFT", 1);
define("STR_REDUCE_RIGHT", 2);
define("STR_REDUCE_CENTER", 4);

/**
 *  @autor: Carlos Reche
 *  @data:  Jan 21, 2005
 */
function str_reduce($str, $max_length, $append = NULL, $position = STR_REDUCE_RIGHT, $remove_extra_spaces = true)
{
    if (!is_string($str))
    {
        echo "<br /><strong>Warning</strong>: " . __FUNCTION__ . "() expects parameter 1 to be string.";
        return false;
    }
    else if (!is_int($max_length))
    {
        echo "<br /><strong>Warning</strong>: " . __FUNCTION__ . "() expects parameter 2 to be integer.";
        return false;
    }
    else if (!is_string($append)  &&  $append !== NULL)
    {
        echo "<br /><strong>Warning</strong>: " . __FUNCTION__ . "() expects optional parameter 3 to be string.";
        return false;
    }
    else if (!is_int($position))
    {
        echo "<br /><strong>Warning</strong>: " . __FUNCTION__ . "() expects optional parameter 4 to be integer.";
        return false;
    }
    else if (($position != STR_REDUCE_LEFT)  &&  ($position != STR_REDUCE_RIGHT)  &&
             ($position != STR_REDUCE_CENTER)  &&  ($position != (STR_REDUCE_LEFT | STR_REDUCE_RIGHT)))
    {
        echo "<br /><strong>Warning</strong>: " . __FUNCTION__ . "(): The specified parameter '" . $position . "' is invalid.";
        return false;
    }


    if ($append === NULL)
    {
        $append = "...";
    }


    $str = html_entity_decode($str);


    if ((bool)$remove_extra_spaces)
    {
        $str = preg_replace("/\s+/s", " ", trim($str));
    }


    if (strlen($str) <= $max_length)
    {
        return htmlentities($str);
    }


    if ($position == STR_REDUCE_LEFT)
    {
        $str_reduced = preg_replace("/^.*?(\s.{0," . $max_length . "})$/s", "\\1", $str);

        while ((strlen($str_reduced) + strlen($append)) > $max_length)
        {
            $str_reduced = preg_replace("/^\s?[^\s]+(\s.*)$/s", "\\1", $str_reduced);
        }

        $str_reduced = $append . $str_reduced;
    }


    else if ($position == STR_REDUCE_RIGHT)
    {
        $str_reduced = preg_replace("/^(.{0," . $max_length . "}\s).*?$/s", "\\1", $str);

        while ((strlen($str_reduced) + strlen($append)) > $max_length)
        {
            $str_reduced = preg_replace("/^(.*?\s)[^\s]+\s?$/s", "\\1", $str_reduced);
        }

        $str_reduced .= $append;
    }


    else if ($position == (STR_REDUCE_LEFT | STR_REDUCE_RIGHT))
    {
        $offset = ceil((strlen($str) - $max_length) / 2);

        $str_reduced = preg_replace("/^.{0," . $offset . "}|.{0," . $offset . "}$/s", "", $str);
        $str_reduced = preg_replace("/^[^\s]+|[^\s]+$/s", "", $str_reduced);

        while ((strlen($str_reduced) + (2 * strlen($append))) > $max_length)
        {
            $str_reduced = preg_replace("/^(.*?\s)[^\s]+\s?$/s", "\\1", $str_reduced);

            if ((strlen($str_reduced) + (2 * strlen($append))) > $max_length)
            {
                $str_reduced = preg_replace("/^\s?[^\s]+(\s.*)$/s", "\\1", $str_reduced);
            }
        }

        $str_reduced = $append . $str_reduced . $append;
    }


    else if ($position == STR_REDUCE_CENTER)
    {
        $pattern = "/^(.{0," . floor($max_length / 2) . "}\s)|(\s.{0," . floor($max_length / 2) . "})$/s";

        preg_match_all($pattern, $str, $matches);

        $begin_chunk = $matches[0][0];
        $end_chunk   = $matches[0][1];

        while ((strlen($begin_chunk) + strlen($append) + strlen($end_chunk)) > $max_length)
        {
            $end_chunk = preg_replace("/^\s?[^\s]+(\s.*)$/s", "\\1", $end_chunk);

            if ((strlen($begin_chunk) + strlen($append) + strlen($end_chunk)) > $max_length)
            {
                $begin_chunk = preg_replace("/^(.*?\s)[^\s]+\s?$/s", "\\1", $begin_chunk);
            }
        }

        $str_reduced = $begin_chunk . $append . $end_chunk;
    }

    return htmlentities($str_reduced);
}

$str = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

echo str_reduce($str, 100);
/* Retornará:

"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut ..."
*/

echo str_reduce($str, 100, "(...)", STR_REDUCE_LEFT);
/* Retornará:

"(...) cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
*/