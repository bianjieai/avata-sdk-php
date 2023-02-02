<?php
/**
 *
 * User: yu
 * Date: 2023/1/31
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Tx;


class QueryTxRes
{
    /**
     * @var string 用户操作类型
     * "issue_class"
     * "transfer_class"
     * "mint_nft"
     * "edit_nft"
     * "burn_nft"
     * "transfer_nft"
     * "issue_class_mt"
     * "transfer_class_mt"
     * "issue_mt"
     * "mint_mt"
     * "edit_mt"
     * "burn_mt"
     * "transfer_mt"
     * "mint_nft_batch"
     * "edit_nft_batch"
     * "burn_nft_batch"
     * "transfer_nft_batch"
     * "create_record"
     */
    public $type = "";

    /**
     * @var string 交易模块
     * "nft"
     * "mt"
     * "record"
     */
    public $module = "";

    /**
     * @var string 交易哈希
     */
    public $tx_hash = "";

    /**
     * @var int 交易状态， 0 处理中； 1 成功； 2 失败； 3 未处理
     * 交易状态说明：
        status 为 3（未处理），上链请求还在等待处理，请稍等；
        status 为 0（处理中），上链请求正在处理，请等待处理完成；
        status 为 1（成功），交易已上链并执行成功；
        status 为 2（失败），说明该交易执行失败。请在业务侧做容错处理。
        可以参考接口返回的 message（交易失败的错误描述信息） 对 NFT / MT / 业务接口的请求参数做适当调整后，使用「新的 Operation ID 」重新发起 NFT / MT / 业务接口请求。
     */
    public $status = 0;

    /**
     * @var string 交易失败的错误描述信息
     */
    public $message = "";

    /**
     * @var int 交易上链的区块高度
     */
    public $block_height = 0;

    /**
     * @var string 交易上链时间（UTC 时间）
     */
    public $timestamp = "";
    /**
     * @var array 对应不同操作类型的消息体, 参考接口文档
     */
    public $nft = [];

    /**
     * @var array 对应不同操作类型的消息体, 参考接口文档
     */
    public $mt = [];

    /**
     * @var array 对应不同操作类型的消息体, 参考接口文档
     */
    public $record = [];

    /**
     * QueryTxRes constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach($data as $key => $value){
            $this->{$key} = $value;
        }
    }
}