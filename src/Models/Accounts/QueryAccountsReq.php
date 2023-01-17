<?php
/**
 *
 * User: yu
 * Date: 2023/1/11
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Accounts;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryAccountsReq extends BaseRequest
{
    /**
     * @var string 游标，默认为 0
     */
    public $offset = "0";

    /**
     * @var string 每页记录数，默认为 10，上限为 50
     */
    public $limit = "10";

    /**
     * @var string 链账户地址
     */
    public $account = "";

    /**
     * @var string 链账户名称，支持模糊查询
     */
    public $name = "";

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
     * QueryAccountsReq constructor.
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
    public function toString() :string
    {
        return http_build_query(array_filter((array)$this), '', '&');
    }

    /**
     * @return array 转数组
     */
    public function toArray() :array
    {
        return array_filter((array)$this);
    }
}