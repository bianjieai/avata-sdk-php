<?php
/**
 *
 * User: yu
 * Date: 2023/1/17
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Accounts;


class QueryAccountsHistoryRes
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
     * @var             array 操作记录列表
     * @tx_hash         string 操作 Tx Hash
     * @module          string 功能模块 Enum: "nft" "mt"
     * @operation       string 操作类型 Enum: "issue_class" "transfer_class" "mint" "edit" "transfer" "burn" "issue"
     * @signer          string Tx 签名者地址
     * @timestamp       string 操作时间戳（UTC 时间）
     * @gas_fee         string 链上交易消耗的能量值；当前支持查询 2022 年 08 月 18 日 11:00:00(UTC 时间) 底层链升级固定 Gas 之后的数据，其它历史数据已归档，暂不支持查询对应结果
     * @business_fee    int 链上交易消耗的业务费
     * @message         object 对应不同操作类型的消息体,下方的Key只作为展示用, 实际返回中不存在该Key, 只返回对应数据
     * @nft_msg         object 对应不同操作类型的消息体,下方的Key只作为展示用, 实际返回中不存在该Key, 只返回对应数据
     * @mt_msg          object 对应不同操作类型的消息体,下方的Key只作为展示用, 实际返回中不存在该Key, 只返回对应数据
     * @object          类型具体参数详见接口文档
     */
    public $operation_records = [];

    /**
     * QueryAccountsRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach($data as $key => $value){
            $this->{$key} = $value;
        }
    }
}