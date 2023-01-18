<?php
/**
 *
 * User: yu
 * Date: 2023/1/18
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Classes;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryNFTCLassesReq extends BaseRequest
{
    /**
     * @var string NFT 类别 ID
     */
    public $id = "";

    /**
     * @var string NFT 类别名称，支持模糊查询
     */
    public $name = "";

    /**
     * @var string NFT 类别权属者地址
     */
    public $owner = "";

    /**
     * @var string 创建 NFT 类别的 Tx Hash
     */
    public $tx_hash = "";

    /**
     * @var string NFT 类别创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
     */
    public $start_date = "";

    /**
     * @var string NFT 类别创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
     */
    public $end_date = "";

    /**
     * @var string 排序规则：DATE_ASC / DATE_DESC
     */
    public $sort_by = "";

    /**
     * QueryNFTCLassesReq constructor.
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
    public function toArray() :array
    {
        return array_filter((array)$this);
    }
}