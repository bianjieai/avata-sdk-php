<?php

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class BurnMTReq extends BaseRequest
{
    /**
     * 销毁的数量
     * @var int
     */
    public int $amount;

    /**
     * 交易标签， 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位，自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     * @var array
     */
    public array $tag;

    /**
     * BurnMTReq constructor.
     * @param int $amount
     * @param array $tag
     * @param string $operationID
     */
    public function __construct(int $amount, array $tag, string $operationID)
    {
        $this->amount = $amount;
        $this->tag = $tag;
        $this->operation_id = $operationID;
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