<?php
/**
 * Desc
 * Author: fallen
 * Date: 2022/6/30
 * Time: 10:58
 */
namespace Fallen\Longhash\Core;

class Salt
{
    const DEFAULT_CODE = "longhash";

    private $code = '';

    /**
     * Salt constructor.
     * @param string $code
     */
    public function __construct($code = '')
    {
        $this->code = !empty($code) ? trim(str_replace(' ', '', $code)) : self::DEFAULT_CODE;
    }

    private function getSerialNum() {
        $codes = str_split($this->code);
        $num = 0;
        foreach ($codes as $code) {
            $num += ord($code);
        }
        return $num;
    }

    public function getSerial()
    {
        $num = decoct($this->getSerialNum());
        return str_split($num);
    }
}