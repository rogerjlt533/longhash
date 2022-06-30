<?php
/**
 * Desc
 * Author: fallen
 * Date: 2022/6/30
 * Time: 10:52
 */
namespace Fallen\Longhash;

use Fallen\Longhash\Core\Bite;
use Fallen\Longhash\Core\Crypt;
use Fallen\Longhash\Core\Salt;

class HashTool
{
    public $salt;

    /**
     * HashTool constructor.
     * @param string $code
     */
    public function __construct($code = '')
    {
        $this->salt = new Salt($code);
    }

    public function encode($content)
    {
        $serials = $this->salt->getSerial();
        return Crypt::encode(Bite::text2Bin($content), $serials);
    }

    public function decode($content)
    {
        $serials = $this->salt->getSerial();
        return Bite::bin2Text(Crypt::decode($content, array_reverse($serials)));
    }
}