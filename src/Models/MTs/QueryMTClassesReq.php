<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryMTClassesReq extends BaseRequest
{
    /**
     * @var string MT 类别 ID
     */
    public $id = "";

    /**
     * @var string MT 类别名称，支持模糊查询
     */
    public $name = "";

    /**
     * @var string MT 类别权属者地址
     */
    public $owner = "";

    /**
     * @var string 创建 MT 类别的 Tx Hash
     */
    public $tx_hash = "";

    /**
     * @var string 创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
     */
    public $start_date = "";

    /**
     * @var string 创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
     */
    public $end_date = "";

    /**
     * @var string 排序规则：DATE_ASC / DATE_DESC
     */
    public $sort_by = "";

    /**
     * QueryMTClassesReq constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return string 转字符串
     */
    public function toString(): string
    {
        return http_build_query(array_filter((array)$this), '', '&');
    }

    /**
     * @return array 转数组
     */
    public function toArray(): array
    {
        return array_filter((array)$this);
    }
}