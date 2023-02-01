<?php
/**
 *
 * User: yu
 * Date: 2023/1/10
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Exception;

class Exception extends \Exception
{
    const UNKNOWNERROR = "UNKNOWN_ERROR"; // 未知错误
    const BADREQUEST   = "BAD_REQUEST";   // 参数错误
    const CLIENTERROR   = "CLIENT_REQUEST";   // 客户端错误

    /**
     * @var string 命名空间
     */
    protected $code_space = "";

    protected $code = "";

    /**
     * Exception constructor.
     * @param array $errors
     */
    public function __construct(string $message, string $code = self::BADREQUEST, string $code_space = "AVATA-SDK-PHP")
    {
        $this->code = $code;
        $this->code_space = $code_space;
        $this->message = $message;
        parent::__construct($message);
    }

    /**
     * @return string 返回CodeSpace
     */
    public function getCodeSpace(): string
    {
        return $this->code_space;
    }
}