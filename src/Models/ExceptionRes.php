<?php
/**
 *
 * User: yu
 * Date: 2023/1/10
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models;


class ExceptionRes
{
    /**
     * @var string 错误码
     */
    private $code = "";

    /**
     * @var string 命名空间
     */
    private $code_space = "";

    /**
     * @var string 错误描述
     */
    private $message = "";

    /**
     * ExceptionRes constructor.
     * @param array $errors
     */
    public function __construct(array $errors = [])
    {
        foreach($errors as $key => $value){
            $this->{$key} = $value;
        }
    }

    /**
     * @return string 返回Code
     */
    public function getCode() :string
    {
        return $this->code;
    }

    /**
     * @return string 返回CodeSpace
     */
    public function getCodeSpace() :string
    {
        return $this->code_space;
    }

    /**
     * @return string 返回Message
     */
    public function getMessage() :string
    {
        return $this->message;
    }
}