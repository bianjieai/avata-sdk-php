<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

class QueryMTClassRes
{
    /**
     * @var string MT 类别 ID
     */
    public $id = "";

    /**
     * @var string MT 类别名称
     */
    public $name = "";

    /**
     * @var int MT 类别包含的 MT 总量(AVATA 平台内)
     */
    public $mt_count = 0;

    /**
     * @var string 自定义链上元数据
     */
    public $data = "";

    /**
     * @var string MT 类别权属者地址
     */
    public $owner = "";

    /**
     * @var string 创建 MT 类别的 Tx Hash
     */
    public $tx_hash = "";

    /**
     * @var string 创建 MT 类别的时间戳（UTC 时间）
     */
    public $timestamp = "";

    /**
     * QueryMTClassRes constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}