<?php
/**
 *
 * User: yu
 * Date: 2023/1/10
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Accounts;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class BatchCreateAccountsReq extends BaseRequest
{
    /**
     * @var int 批量创建链账户的数量
     */
    public $count;


    /**
     * BatchCreateAccountsReq constructor.
     * @param int $count
     * @param string $operationID
     */
    public function __construct(int $count, string $operationID)
    {
        $this->count = $count;
        $this->operationID = $operationID;
    }

    /**
     * 返回字段的名称
     *
     * @return string
     */
    public function getCountKey(): string
    {
        return "count";
    }
}