<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class MintMTReq extends BaseRequest
{
    /**
     * MT 数量，不填写数量时，默认发行数量为 1
     * @var int
     */
    public $amount;

    /**
     * MT 接收者地址，支持任一文昌链合法链账户地址，默认为 MT 类别的权属者地址
     * @var string
     */
    public $recipient;

    /**
     * 交易标签， 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位，自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     * @var array
     */
    public $tag;

    /**
     * MintMTReq constructor.
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
    public function getRecipientKey(): string
    {
        return "recipient";
    }

    /**
     * @return string
     */
    public function getAmountKey(): string
    {
        return "amount";
    }

    /**
     * @return string
     */
    public function getTagKey(): string
    {
        return "tag";
    }

}