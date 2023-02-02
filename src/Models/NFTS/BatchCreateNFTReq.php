<?php
/**
 *
 * User: yu
 * Date: 2023/1/19
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\NFTS;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class BatchCreateNFTReq extends BaseRequest
{
    /**
     * @var string NFT 类别 ID required
     */
    public $class_id = "";

    /**
     * @var string NFT 名称 required
     */
    public $name = "";

    /**
     * @var string 链外数据链接
     */
    public $uri = "";

    /**
     * @var string
     */
    public $uri_hash = "";

    /**
     * @var string 自定义链上元数据
     */
    public $data = "";

    /**
     * @var array NFT 接收者地址和发行数量。
     *
     * 以数组的方式进行组合，可以自定义多个组合，可面向多地址批量发行 NFT
     *
     * @amount 发行数量 required
     * @recipient 接收者地址 required
     */
    public $recipients = [];

    /**
     * BatchCreateNFTReq constructor.
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