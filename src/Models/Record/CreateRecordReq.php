<?php
/**
 *
 * User: yu
 * Date: 2023/1/31
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Record;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class CreateRecordReq extends BaseRequest
{
    /**
     * @var int 存证主体；1:个人；2:企业,
     */
    public $identity_type = 0;

    /**
     * @var string 个人姓名或企业名称
     *
     * 规范如下：
     * 个人姓名：长度限制 1-16 个字符（UTF-8 编码），首字符不能是特殊符号
     * 企业名称：长度限制 1-50 个字符（UTF-8 编码），首字符不能是特殊符号
     *
     * 未传入存证主体字段时，不支持此字段；传入存证主体字段时，此字段必填
     */
    public $identity_name = "";

    /**
     * @var string 个人为身份证号码，企业为统一社会信用代码
     *
     * 未传入存证主体字段时，不支持此字段；传入存证主体字段时，此字段选填
     */
    public $identity_num = "";

    /**
     * @var int 作品类型 required
     * 1: 其它类型；
    2: 文字作品；
    3: 口述作品；
    4: 音乐作品；
    5: 戏剧作品；
    6: 曲艺作品；
    7: 舞蹈作品；
    8: 杂技艺术作品；
    9: 美术作品；
    10: 建筑作品；
    11: 摄影作品；
    12: 视听作品；
    13: 图形作品（工程设计图、产品设计图、地图、示意图等）；
    14: 模型作品；
     */
    public $type = 0;

    /**
     * @var string 作品名称 required
     */
    public $name = "";

    /**
     * @var string 作品描述 required
     */
    public $description = "";

    /**
     * @var string 作品哈希 required
     * 将单个作品源文件使用单向散列函数（如 MD5，SHA 等）进行一次 Hash 计算
     * 将多个作品源文件分别进行一次 Hash 计算，再将得到的 Hash 值进行二次 Hash 计算
     */
    public $hash = "";

    /**
     * @var int 作品哈希类型 1:其它； 2:SHA256；3:MD5；4:SHA256-PFV required
     */
    public $hash_type = 0;

    /**
     * CreateRecordReq constructor.
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