<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryMTHistoryReq extends BaseRequest
{
    /**
     * @var string Tx 签名者地址
     */
    public $signer = "";

    /**
     * @var string MT 操作 Tx Hash
     */
    public $tx_hash = "";

    /**
     * @var string 操作类型，issue(首发MT) / mint(增发MT) / edit(编辑MT) / transfer(转让MT) / burn(销毁MT)
     */
    public $operation = "";

    /**
     * @var string 日期范围 - 开始，yyyy-MM-dd（UTC 时间）
     */
    public $start_date = "";

    /**
     * @var string 日期范围 - 结束，yyyy-MM-dd（UTC 时间）
     */
    public $end_date = "";

    /**
     * @var string 排序规则：DATE_ASC / DATE_DESC
     */
    public $sort_by = "";

    /**
     * QueryMTHistoryReq constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return array 转数组
     */
    public function toArray(): array
    {
        return array_filter((array)$this);
    }
}