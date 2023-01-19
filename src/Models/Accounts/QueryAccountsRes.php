<?php
/**
 *
 * User: yu
 * Date: 2023/1/11
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Accounts;


class QueryAccountsRes
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
     * @var             array 链账户列表
     * @account         string 链账户地址
     * @name            string 链账户名称
     * @gas             int 文昌链能量值余额
     * @biz_fee         int 文昌链 DDC 业务费余额，单位：分
     * @operation_id    string 操作 ID
     * @status          int 链账户的授权状态，0 未授权；1 已授权。链账户授权成功后，可使用该链账户地址发起上链交易请求；未授权时不影响作为交易的接受者地址进行使用（DDC 业务除外）
     */
    public $accounts = [];

    /**
     * QueryAccountsRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}