<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

class QueryMTRes
{
    /**
     * @var string MT ID
     */
    public $id = "";

    /**
     * @var string MT 类别 ID
     */
    public $class_id = "";

    /**
     * @var string MT 类别名称
     */
    public $class_name = "";

    /**
     * @var string 自定义链上元数据
     */
    public $data = "";

    /**
     * @var int MT 拥有者数量(AVATA 平台内)
     */
    public $owner_count = 0;

    /**
     * @var array 首次发行该 MT 的链账户地址、发行时间、首发数量、首发交易哈希
     */
    public $issue_data = [];

    /**
     * @var int MT 流通总量(全链)
     */
    public $mt_count = 0;

    /**
     * @var int MT 发行次数(AVATA 平台内累计发行次数(包括首次发行和增发))
     */
    public $mint_times = 0;

    /**
     * QueryMTRes constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}