<?php
/**
 *
 * User: yu
 * Date: 2023/1/11
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models;


class HttpRes
{
    /**
     * @var int http status code
     */
    private $code;

    /**
     * @var string http message
     */
    private $message;

    /**
     * HttpRes constructor.
     * @param int $code
     * @param string $message
     */
    public function __construct(int $code, string $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * @return int 获取Code
     */
    public function getCode() :int
    {
        return $this->code;
    }

    /**
     * @return string 获取Message
     */
    public function getMessage() :string
    {
        return $this->message;
    }
}