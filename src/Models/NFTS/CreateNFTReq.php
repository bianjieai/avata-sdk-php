<?php
/**
 *
 * User: yu
 * Date: 2023/1/19
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\NFTS;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class CreateNFTReq extends BaseRequest
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
     * @var string 链外数据 Hash
     */
    public $uri_hash = "";

    /**
     * @var string 自定义链上元数据
     */
    public $data = "";

    /**
     * @var string NFT 接收者地址，支持任一文昌链合法链账户地址，默认为 NFT 类别的权属者地址
     *
     * 不填写该参数，默认该NFT接收者为类别的拥有者
     *
     */
    public $recipient = "";

    /**
     * @var array 交易标签
     *
     * 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位
     * 自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     */
    public $tag = [];

    /**
     * CreateNFTReq constructor.
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