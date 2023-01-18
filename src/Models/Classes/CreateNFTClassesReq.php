<?php
/**
 *
 * User: yu
 * Date: 2023/1/18
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Classes;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class CreateNFTClassesReq extends BaseRequest
{
    /**
     * @var string NFT 类别名称 required
     */
    public $name = "";

    /**
     * @var string NFT 类别 ID，仅支持小写字母及数字，以字母开头
     */
    public $class_id = "";

    /**
     * @var string 标识
     */
    public $symbol = "";

    /**
     * @var string 描述
     */
    public $description = "";

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
     * @var string NFT 类别权属者地址，拥有在该 NFT 类别中发行 NFT 的权限和转让该 NFT 类别的权限。
     * 支持任一 Avata 平台内合法链账户地址
     * required
     */
    public $owner = "";

    /**
     * @var array 交易标签
     * 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位，
     * 自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     */
    public $tag = [];

    /**
     * CreateNFTClassesReq constructor.
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
    public function toArray(): array
    {
        return array_filter((array)$this);
    }
}