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
        $arr = preg_split('/(?<!^)(?!$)/u', $content);
        foreach ($arr as &$v) {
            $temp = unpack('H*', $v);
            $v = base_convert($temp[1], 16, 2);
            unset($temp);
        }
        return join(' ', $arr);
    }

    public static function bin2Text($content)
    {
        $arr = explode(' ', $content);
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