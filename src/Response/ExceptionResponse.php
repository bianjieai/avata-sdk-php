<?php
/**
 *
 * User: yu
 * Date: 2023/1/10
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Response;


class ExceptionResponse
{
    /**
     * @var string 错误码
     */
    public $code;

    /**
     * @var string 命名空间
     */
    public $code_space;

    /**
     * @var string 错误描述
     */
    public $message;

    /**
     * ExceptionResponse constructor.
     * @param array $errors
     */
    public function __construct(array $errors = [])
    {
        foreach($errors as $key => $value){
            $this->{$key} = $value;
        }
    }
}