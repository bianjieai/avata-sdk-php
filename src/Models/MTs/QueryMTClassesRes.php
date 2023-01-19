<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

class QueryMTClassesRes
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
     * @var             array 类别列表
     * @id              string MT 类别 ID
     * @name            string MT 类别名称
     * @mt_count        int MT 类别包含的 MT 总量(AVATA 平台内)
     * @owner           string MT 类别权属者地址
     * @tx_hash         string 创建 MT 类别的 Tx Hash
     * @timestamp       string 创建 MT 类别的时间戳（UTC 时间）
     */
    public $classes = [];

    /**
     * QueryMTClassesRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}