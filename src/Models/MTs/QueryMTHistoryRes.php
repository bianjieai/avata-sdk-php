<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

class QueryMTHistoryRes
{
    /**
     * @var int 游标，默认为 0
     */
    public $offset = 0;

    /**
     * @var int 每页记录数，默认为 10，上限为 50
     */
    public $limit = 10;

    /**
     * @var int 总记录数
     */
    public $total_count = 0;

    /**
     * @var             array 操作记录列表
     * @tx_hash         string 操作 Tx Hash
     * @operation       string 操作类型 Enum: "issue" "mint" "edit" "transfer" "burn"
     * @signer          string Tx 签名者地址
     * @recipient       string MT 接收者地址
     * @signer          string MT 操作数量
     * @timestamp       string MT 操作时间戳（UTC 时间）
     */
    public $operation_records = [];

    /**
     * QueryMTHistoryRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}