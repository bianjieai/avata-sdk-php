<?php
/**
 *
 * User: yu
 * Date: 2023/1/9
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Response;

class Response
{
    /**
     * @var int http返回的状态码
     */
    private $code;

    /**
     * @var string http异常信息
     */
    private $message;

    /**
     * @var
     */
    private $data;

    /**
     * @var ExceptionResponse 异常信息
     */
    private $error;

    /**
     * Response constructor.
     * @param int $code
     * @param string $message
     * @param $data
     * @param ExceptionResponse $error
     */
    public function __construct(int $code, string $message, $data, ExceptionResponse $error)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
        $this->error = $error;
    }

    /**
     * @return int 获取状态码
     */
    public function getCode() :int
    {
        return $this->code;
    }

    /**
     * @return string 获取提示信息
     */
    public function getMessage() :string
    {
        return $this->message;
    }

    /**
     * @return array 获取数据
     */
    public function getData()
    {
        if (is_null($this->data)) {
            return [];
        }
        return $this->data;
    }

    /**
     * @return ExceptionResponse 获取异常信息
     */
    public function getError() :ExceptionResponse
    {
        if (is_null($this->error)) {
            return new ExceptionResponse();
        }
        return $this->error;
    }

    /**
     * 设置异常信息
     *
     * @param ExceptionResponse $exceptionResponse
     */
    public function setError(ExceptionResponse $exceptionResponse) {
        $this->error = $exceptionResponse;
    }

    /**
     * 设置返回数据
     *
     * @param $data
     */
    public function setData($data) {
        $this->data = $data;
    }
}
