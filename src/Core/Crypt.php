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
    private static function filterSerial($serials) {
        if (count($serials) == 0) {
            return [0, []];
        }
        $serials = array_values($serials);
        if (count($serials) == 1) {
            if ($serials[0] == 8) {
                $serials[] = 1;
            } else {
                $serials[] = 8;
            }
        }
        return [count($serials), $serials];
    }

    private static function convert($value, $serials) {
        $values = str_split($value);
        list($serial_count, $serials) = self::filterSerial($serials);
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
        $list = str_split($content, 8);
        foreach ($list as $item) {
            $values[] = self::convert($item, $serials);
        }
        return base64_encode(implode('', $values));
    }

    public static function decode($content, $serials = []) {
        $content = base64_decode($content);
        if (empty($serials)) {
            return $content;
        }
        $values = [];
        $list = str_split($content, 8);
        foreach ($list as $item) {
            $values[] = self::convert($item, $serials);
        }
        return implode('', $values);
    }
}