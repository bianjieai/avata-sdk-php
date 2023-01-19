<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

class QueryMTBalanceRes
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
     * @var             array
     * @id              string MT ID
     * @amount          int MT 数量
     */
    public $mts = [];

    /**
     * QueryMTBalanceRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}