<?php
/**
 *
 * User: yu
 * Date: 2023/1/9
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models;

class BaseResponse
{
    public static $code_success = 0;
    public static $code_error = -1;
    /**
     * @var int http返回的状态码
     */
    private $code;

    /**
     * @var string http异常信息
     */
    private $message;

    /**
     * @var array
     */
    private $data;

    /**
     * @var ExceptionRes 异常信息
     */
    private $error;

    /**
     * @var HttpRes http返回的状态码和信息
     */
    private $http;
    /**
     * BaseResponse constructor.
     * @param int $code
     * @param string $message
     * @param $data
     * @param ExceptionRes $error
     */
    public function __construct(int $code, string $message, $data = [], ExceptionRes $error = null, HttpRes $http = null)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
        $this->error = $error;
        $this->http = $http;
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
     * @return ExceptionRes 获取异常信息
     */
    public function getError() :ExceptionRes
    {
        if (is_null($this->error)) {
            return new ExceptionRes();
        }
        return $this->error;
    }

    /**
     * @return HttpRes 获取 http 信息
     */
    public function getHttp() :HttpRes
    {
        if (is_null($this->http)) {
            return new HttpRes();
        }
        return $this->http;
    }

    /**
     * @param ExceptionRes $exceptionResponse 设置异常信息
     */
    public function setError(ExceptionRes $exceptionResponse)
    {
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

    /**
     * @param HttpRes $http 设置http信息
     */
    public function setHttp(HttpRes $http)
    {
        $this->http = $http;
    }
}
