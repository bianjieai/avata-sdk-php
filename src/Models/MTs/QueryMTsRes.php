<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

class QueryMTsRes
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
     * @var             array MT 列表
     * @id              string MT ID
     * @class_id        string MT 类别 ID
     * @class_name      string MT 类别名称
     * @issuer          string 首次发行该 MT 的链账户地址
     * @owner_count     int MT 拥有者数量(AVATA 平台内)
     * @timestamp       string 创建 MT 类别的时间戳（UTC 时间）
     */
    public $mts = [];

    /**
     * QueryMTsRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}