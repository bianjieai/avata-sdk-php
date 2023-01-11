<?php
/**
 *
 * User: yu
 * Date: 2023/1/11
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Account;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryAccountReq extends BaseRequest
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
     * QueryAccountReq constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function toString() :string
    {
        
    }
}