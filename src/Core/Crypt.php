<?php
/**
 *
 * Author: fallen
 * Date: 2022/6/30
 * Time: 12:54
 */

namespace Fallen\Longhash\Core;


class Crypt
{
    private static function filterSerial($serials, $length) {
        $serials = array_filter($serials, function ($serial) use ($length) {
            return $serial >= $length ? false : true;
        });
        if (count($serials) == 0) {
            return [0, []];
        }
        $serials = array_values($serials);
        if (count($serials) == 1) {
            if ($serials[0] == $length) {
                $serials[] = 1;
            } else {
                $serials[] = $length;
            }
        }
        return [count($serials), $serials];
    }

    private static function convert($value, $serials) {
        $values = str_split($value);
        $str_len = strlen($value);
        $serials = array_filter($serials, function ($serial) use ($str_len) {
            return $serial >= $str_len ? false : true;
        });
        list($serial_count, $serials) = self::filterSerial($serials, $str_len);
        if ($serial_count == 0) {
            return $value;
        }
        for ($index = 0; $index < count($serials) - 1; $index ++) {
            $from = $serials[$index] - 1;
            $dest = $serials[$index + 1] - 1;
            $temp = $values[$from];
            $values[$from] = $values[$dest];
            $values[$dest] = $temp;
            unset($temp);
        }
        return implode('', $values);
    }

    public static function encode($content, $serials = []) {
        if (empty($serials)) {
            return base64_encode($content);
        }
        $values = [];
        $list = explode(' ', $content);
        foreach ($list as $unit) {
            $items = [];
            $children = str_split($unit, 8);
            foreach ($children as $child) {
                $items[] = self::convert($child, $serials);
            }
            $values[] = implode('', $items);
            unset($items);
        }
        return base64_encode(implode(' ', $values));
    }

    public static function decode($content, $serials = []) {
        $content = base64_decode($content);
        if (empty($serials)) {
            return $content;
        }
        $values = [];
        $list = explode(' ', $content);
        foreach ($list as $unit) {
            $items = [];
            $children = str_split($unit, 8);
            foreach ($children as $child) {
                $items[] = self::convert($child, $serials);
            }
            $values[] = implode('', $items);
            unset($items);
        }
        return implode(' ', $values);
    }
}