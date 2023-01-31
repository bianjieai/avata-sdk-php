<?php
/**
 *
 * User: yu
 * Date: 2023/1/31
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Tx;


class QueryTxQueueRes
{
    /**
     * @var int 当前队列中待处理交易总数
     */
    public $queue_total = 0;

    /**
     * @var string 当前队列即将被处理交易的请求时间（UTC 时间）
     */
    public $queue_request_time = "";

    /**
     * @var int 当前队列中所有交易处理完预估时间（秒）
     */
    public $queue_cost_time = 0;

    /**
     * @var int Operation ID 对应交易所处队列中的位置；若交易存在队列中，0 则表示正在重试
     */
    public $tx_queue_position = 0;

    /**
     * @var string Operation ID 对应交易的请求时间（UTC 时间）
     */
    public $tx_request_time = "";

    /**
     * @var int Operation ID 对应交易预估处理所需时间（秒）
     */
    public $tx_cost_time = 0;

    /**
     * @var string Operation ID 对应交易排队描述信息
     */
    public $tx_message = "";

    /**
     * QueryTxQueueRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach($data as $key => $value){
            $this->{$key} = $value;
        }
    }
}