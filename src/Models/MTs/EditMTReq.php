<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class EditMTReq extends BaseRequest
{
    /**
     * 自定义链上元数据
     * @var string
     */
    public $data;

    /**
     * 交易标签， 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位，自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     * @var array
     */
    public $tag;

    /**
     * EditMTReq constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return string
     */
    public function getDataKey(): string
    {
        return "data";
    }

    /**
     * @return string
     */
    public function getTagKey(): string
    {
        return "tag";
    }

}