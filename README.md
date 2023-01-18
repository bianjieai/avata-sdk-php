# 一、介绍

# 二、例子

## 1. 初始化客户端

```php
# 初始化配置信息
$cfg = [
    "api_key" => "Avata项目API-KEY",
    "api_secret" => "Avata项目API-SECRET",
    "domain" => "请求域名, 不同环境对应不同的域名, 如测试环境: https://stage.apis.avata.bianjie.ai",
    "http_timeout" => <请求Avata接口超时时间, 默认: 10>,
];
$obj = new Client($cfg);
```

## 2. 链账户接口

### 2.1 创建单个链账户

```php
# 初始化客户端后, 进行接口调用

# CreateAccountsReq 创建链账户的请求参数对象
# new CreateAccountsReq(<name>, <operation_id>)
# name: 链账户名称，支持 1-20 位汉字、大小写字母及数字组成的字符串
# operation_id: 操作 ID，保证幂等性，避免重复请求，保证对于同一操作发起的一次请求或者多次请求的结果是一致的；由接入方生成的针对每个 Project ID 唯一的、不超过 64 个大小写字母、数字、-、下划线的字符串组成。此操作 ID 仅限在查询链账户接口中使用，用于查询创建链账户的授权状态。

# $res
# getData: 获取返回值
# getCode: 获取请求Code, 0: 请求正常 -1: 请求异常
# getError: 获取异常信息
# getHttp: 获取http异常信息
$res = $obj->accounts->CreateAccount(new CreateAccountsReq(<name>, <operation_id>));

# CreateAccountsRes 创建链账户成功返回的参数对象
# account: 链账户地址
# name: 链账户名称
# operation_id: 操作 ID。此操作 ID 仅限在查询链账户接口中使用，用于查询创建链账户的授权状态
$account = new CreateAccountsRes($res->getData());
```

### 2.2 批量创建链账户

```php
# BatchCreateAccountsReq 批量创建链账户参数对象
# new BatchCreateAccountsReq(<count>, <operation_id>)
# count: 批量创建链账户的数量, 默认: 1
# operation_id: 操作 ID，保证幂等性，避免重复请求，保证对于同一操作发起的一次请求或者多次请求的结果是一致的；由接入方生成的针对每个 Project ID 唯一的、不超过 64 个大小写字母、数字、-、下划线的字符串组成。此操作 ID 仅限在查询链账户接口中使用，用于查询创建链账户的授权状态。

# $res
# getData: 获取返回值
# getCode: 获取请求Code, 0: 请求正常 -1: 请求异常
# getError: 获取异常信息
# getHttp: 获取http异常信息
$res = $obj->accounts->BatchCreateAccounts(new BatchCreateAccountsReq(<count>, <operation_id>));

# BatchCreateAccountRes 批量创建链账户成功返回的参数对象
# accounts: 链账户地址列表, 数组
# operation_id: 操作 ID。此操作 ID 仅限在查询链账户接口中使用，用于查询创建链账户的授权状态
$accounts = new BatchCreateAccountRes($res->getData());
```

### 2.3 查询链账户

```php
# QueryAccountsReq 查询链账户参数对象, 类型为数组
# offset: 	游标，默认为 0
# limit: 		每页记录数，默认为 10，上限为 50
# account: 	链账户地址
# name: 		链账户名称，支持模糊查询
# operation_id: 操作 ID。此操作 ID 需要填写在请求创建链账户/批量创建链账户接口时，返回的 Operation ID
# start_date: 	创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
# end_date: 		创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
# sort_by:			排序规则：DATE_ASC / DATE_DESC
# 以上参数类型都为String, 如写入其他类型，可能会导致签名参数验证不通过

# $res
# getData: 获取返回值
# getCode: 获取请求Code, 0: 请求正常 -1: 请求异常
# getError: 获取异常信息
# getHttp: 获取http异常信息
$res = $obj->accounts->QueryAccounts(new QueryAccountsReq([
    "offset" =>     "0",
    "limit" =>      "10",
]));

# QueryAccountsRes 查询链账户成功返回的参数对象
# offset:						游标
# limit:						每页记录数
# total_count:			总记录数
# accouts:					链账户列表, 类型为数组
# accounts->account: 链账户地址
# accounts->name: 	 链账户名称
# accounts->gas: 		 文昌链能量值余额
# accounts->biz_fee: 文昌链 DDC 业务费余额，单位：分
# accounts->operation_id: 操作 ID
# accounts->status: 链账户的授权状态，0 未授权；1 已授权。链账户授权成功后，可使用该链账户地址发起上链交易请求；未授权时不影响作为交易的接受者地址进行使用（DDC 业务除外）
$accounts = new QueryAccountsRes($res->getData());
```

### 2.4 查询链账户操作记录

```php
# QueryAccountsHistory 查询链账户操作记录参数对象, 类型为数组
# offset:								游标，默认为 0
# limit: 								每页记录数，默认为 10，上限为 50
# account: 							链账户地址
# module:								功能模块, Enum: "nft" "mt"
# operation:						操作类型，仅 module 不为空时有效，默认为 "all"。
#												module = nft 时，可选：issue_class / transfer_class / mint / edit / transfer / burn
#												module = mt 时，可选：issue_class / transfer_class / issue / mint / edit / transfer /burn
# tx_hash:							Tx Hash
# start_date:						日期范围 - 开始，yyyy-MM-dd（UTC 时间）
# end_date:							日期范围 - 结束，yyyy-MM-dd（UTC 时间）
# sort_by:							排序规则：DATE_ASC / DATE_DESC
# 以上参数类型都为String, 如写入其他类型，可能会导致签名参数验证不通过

# $res
# getData: 获取返回值
# getCode: 获取请求Code, 0: 请求正常 -1: 请求异常
# getError: 获取异常信息
# getHttp: 获取http异常信息
$res = $obj->accounts->QueryAccountsHistory(new QueryAccountsHistoryReq([
    "offset" =>     "0",
    "limit" =>      "10",
]));

# QueryAccountsHistoryRes 查询链账户操作记录成功返回的参数对象
# offset:						游标
# limit:						每页记录数
# total_count:			总记录数
# operation_records:					操作记录列表, 类型为数组
# operation_records->tx_hash: 操作 Tx Hash
# operation_records->module: 	 功能模块, Enum: "nft" "mt"
# operation_records->operation:操作类型, Enum: "issue_class" "transfer_class" "mint" "edit" "transfer" "burn" "issue"
# operation_records->signer: Tx 签名者地址
# operation_records->timestamp: 操作时间戳（UTC 时间）
# operation_records->gas_fee: 链上交易消耗的能量值，当前支持查询 2022 年 08 月 18 日 11:00:00(UTC 时间) 底层链升级固定 Gas 之后的数据，其它历史数据已归档，暂不支持查询对应结果
# operation_records->business_fee: 链上交易消耗的业务费
# operation_records->message: 对应不同操作类型的消息体,下方的Key只作为展示用, 实际返回中不存在该Key, 只返回对应数据
# operation_records->nft_msg: 对应不同操作类型的消息体,下方的Key只作为展示用, 实际返回中不存在该Key, 只返回对应数据
# operation_records->mt_msg: 对应不同操作类型的消息体,下方的Key只作为展示用, 实际返回中不存在该Key, 只返回对应数据
# 以上message, nft_msg, mt_msg具体参数可参考文档
$accountsHistory = new QueryAccountsHistoryRes($res->getData());
```

## 3.NFT 接口

### 3.1 类别接口

#### 3.1.1 创建类别

```php
# CreateNFTClassesReq 创建NFT类别参数对象, 类型为数组
# name:								NFT 类别名称, 必填字段
# class_id:						NFT 类别 ID，仅支持小写字母及数字，以字母开头
# symbol:							标识
# description:				描述
# uri:								链外数据链接
# uri_hash:						链外数据 Hash
# data:								自定义链上元数据
# owner:							NFT 类别权属者地址，拥有在该 NFT 类别中发行 NFT 的权限和转让该 NFT 类别的权限。支持任一 Avata 平台内合法链账户地址, 必填字段
# tag:									交易标签， 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位，自定义 value：长度限制在 64 位字符，支持大小写字母和数字, ["key" => "value"]
# operation_id:				操作ID, 必填字段


# $res
# getData: 获取返回值
# getCode: 获取请求Code, 0: 请求正常 -1: 请求异常
# getError: 获取异常信息
# getHttp: 获取http异常信息
$res = $obj->nft_classes->CreateNFTClasses(new CreateNFTClassesReq([
    "name"  => "PHP-SDK 测试创建类别",
    "owner"     => "类别拥有者链账户地址",
    "operation_id" => "<操作ID>"
]));

# CreateNFTClassesRes 创建NFT类别交易成功返回参数对象
# operation_id: 操作ID
$nftClasses = new CreateNFTClassesRes($res->getData());
```

#### 3.1.2 查询类别列表

```php
# QueryNFTClasses 查询NFT类别列表参数对象, 类型为数组
# offset:								游标，默认为 0
# limit: 								每页记录数，默认为 10，上限为 50
# id:										NFT 类别 ID
# name:									NFT 类别名称，支持模糊查询
# owner:								NFT 类别权属者地址
# tx_hash:							创建 NFT 类别的 Tx Hash
# start_date:						NFT 类别创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
# end_date:							NFT 类别创建日期范围 - 结束，yyyy-MM-dd（UTC 时间
# sort_by:							排序规则：DATE_ASC / DATE_DESC

# $res
# getData: 获取返回值
# getCode: 获取请求Code, 0: 请求正常 -1: 请求异常
# getError: 获取异常信息
# getHttp: 获取http异常信息
$res = $obj->nft_classes->QueryNFTClasses(new QueryNFTCLassesReq([
    "offset" => "0",
    "limit" => "10",
]));

# QueryNFTCLassesRes 查询NFT类别列表成功参数对象
# offset:						游标
# limit:						每页记录数
# total_count:			总记录数
# classes:					类别列表, 类型为数组
# classes->id:			NFT 类别 ID
# classes->name:		NFT 类别名称
# classes->symbol:	NFT 类别标识
# classes->nft_count: NFT 类别包含的 NFT 总量
# classes->uri:			链外数据链接
# classes->owner:		NFT 类别权属者地址
# classes->tx_hash: 创建 NFT 类别的 Tx Hash
# classes->timestamp: 创建 NFT 类别的时间戳（UTC 时间）
$classes = new QueryNFTCLassesRes($res->getData());
```

#### 3.1.3 查询类别详情

```php
# QueryNFTClass 查询类别详情对象
# id:		NFT 类别 ID 必填

# $res
# getData: 获取返回值
# getCode: 获取请求Code, 0: 请求正常 -1: 请求异常
# getError: 获取异常信息
# getHttp: 获取http异常信息
$res = $obj->nft_classes->QueryNFTClass(new QueryNFTClassReq("<id>"));

# QueryNFTClassRes 查询类别详情返回对象
# id:								NFT 类别 ID
# name:							NFT 类别名称
# symbol:						NFT 类别标识
# description:			NFT 类别描述
# nft_count:				NFT 类别包含的 NFT 总量
# uri:							链外数据链接
# uri_hash:					链外数据 Hash
# data:							自定义链上元数据
# owner:						NFT 类别权属者地址
# tx_hash:					创建 NFT 类别的 Tx Hash
# timestamp:				创建 NFT 类别的时间戳（UTC 时间）
$classes = new QueryNFTClassRes($res->getData());
```

#### 3.1.4 转让类别

```php
# TransferNFTClassReq 转让类别对象, 类型为数组
# class_id:					NFT 类别 ID,需要转让的类别ID, 必填字段
# owner:						NFT 类别权属者地址, 当前类别的权属者, 必填字段
# recipient:				NFT 类别接收者地址，支持任一 Avata 平台内合法链账户地址, 必填字段
# operation_id:			操作 ID, 必填字段
# tag:									交易标签， 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位，自定义 value：长度限制在 64 位字符，支持大小写字母和数字, ["key" => "value"]

# $res
# getData: 获取返回值
# getCode: 获取请求Code, 0: 请求正常 -1: 请求异常
# getError: 获取异常信息
# getHttp: 获取http异常信息
$res = $obj->nft_classes->TransferNFTClass(new TransferNFTClassReq([
    "class_id"  => "<class_id>",
    "owner" => "<owner>",
    "recipient"=>"<recipient>",
    "operation_id"=>"<operation_id>"
]));

# TransferNFTClassRes 转让类别返回的对象
# operation_id:				操作ID
$classes = new TransferNFTClassRes($res->getData());
```