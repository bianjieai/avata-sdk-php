<?php

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class EditMTReq extends BaseRequest
{
    /**
     * 自定义链上元数据
     * @var string
     */
    public string $data;

    /**
     * 交易标签， 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位，自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     * @var array
     */
    public array $tag;

    /**
     * EditMTReq constructor.
     * @param string $data
     * @param array $tag
     * @param string $operation_id
     */
    public function __construct(string $data, string $operation_id, array $tag)
    {
        $this->data = $data;
        $this->tag = $tag;
        $this->operation_id = $operation_id;
    }

}