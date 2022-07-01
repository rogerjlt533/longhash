<?php
/**
 * Desc
 * Author: fallen
 * Date: 2022/6/30
 * Time: 10:59
 */

namespace Fallen\Longhash\Core;


class Bite
{

    public static function text2Bin($content)
    {
        $arr = str_split(bin2hex($content), 2);
        foreach ($arr as &$v) {
            $v = sprintf("%08d", base_convert($v, 16, 2));
        }
        return join('', $arr);
    }

    public static function bin2Text($content)
    {
        $arr = str_split($content, 8);
        foreach ($arr as &$v) {
            $length = strlen(base_convert($v, 2, 16));
            if ($length <= 1) {
                $v = pack("H2", "0" . base_convert($v, 2, 16));
            } else {
                $v = pack("H" . strlen(base_convert($v, 2, 16)), base_convert($v, 2, 16));
            }
        }
        return join('', $arr);
    }
}