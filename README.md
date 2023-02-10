# 一、介绍

**边界智能旗下为对接Avata服务提供的PHP版本的SDK**

```php
# 引用
composer require bianjieai/avata-sdk-php 
```

```php
# 异常处理
use \Bianjieai\AvataSdkPhp\Exception\Exception;

try {
  ......
} catch (Exception $exception) {
  # 获取Code
  $exception->getCode();
  # 获取CodeSpace
  $exception->getCodeSpace();
  # 获取异常信息
  $exception->getMessage();
  # 异常处理业务流程
  ......
}
```



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
# Exception SDK下定义的异常
try {
    $obj = new Client($cfg);
} catch (Exception $exception) {
    // TODO Exception information processing
}
```

## 2. 链账户接口

### 2.1 创建单个链账户

```php
# CreateAccountsReq 创建链账户的请求参数对象
# new CreateAccountsReq(<name>, <operation_id>)
# name: 链账户名称，支持 1-20 位汉字、大小写字母及数字组成的字符串
# operation_id: 操作 ID，保证幂等性，避免重复请求，保证对于同一操作发起的一次请求或者多次请求的结果是一致的；由接入方生成的针对每个 Project ID 唯一的、不超过 64 个大小写字母、数字、-、下划线的字符串组成。此操作 ID 仅限在查询链账户接口中使用，用于查询创建链账户的授权状态。

try {
    $account = $obj->accounts->CreateAccount(new CreateAccountsReq(<name>, <operation_id>));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# CreateAccountsRes 创建链账户成功返回的参数对象
# account: 链账户地址
# name: 链账户名称
# operation_id: 操作 ID。此操作 ID 仅限在查询链账户接口中使用，用于查询创建链账户的授权状态
$account 是CreateAccountsRes对象
```

### 2.2 批量创建链账户

```php
# BatchCreateAccountsReq 批量创建链账户参数对象
# new BatchCreateAccountsReq(<count>, <operation_id>)
# count: 批量创建链账户的数量, 默认: 1
# operation_id: 操作 ID，保证幂等性，避免重复请求，保证对于同一操作发起的一次请求或者多次请求的结果是一致的；由接入方生成的针对每个 Project ID 唯一的、不超过 64 个大小写字母、数字、-、下划线的字符串组成。此操作 ID 仅限在查询链账户接口中使用，用于查询创建链账户的授权状态。

try {
    $accounts = $obj->accounts->BatchCreateAccounts(new BatchCreateAccountsReq(<count>, <operation_id>));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# BatchCreateAccountsRes 批量创建链账户成功返回的参数对象
# accounts: 链账户地址列表, 数组
# operation_id: 操作 ID。此操作 ID 仅限在查询链账户接口中使用，用于查询创建链账户的授权状态
$accounts 是BatchCreateAccountsRes对象
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


try {
    $accounts = $obj->accounts->QueryAccounts(new QueryAccountsReq([
        "offset" =>     "0",
        "limit" =>      "10",
			]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

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
$accounts 是QueryAccountsRes对象
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

try {
    $accountsHistory = $obj->accounts->QueryAccountsHistory(new QueryAccountsHistoryReq([
            "offset" =>     "0",
            "limit" =>      "10",
			]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

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
# operation_records->nft_msg: 对应不同操作类型的消息体,下方的Key只作为展示用, 实际返回中不存在该Key, 只返回对应数据
# operation_records->mt_msg: 对应不同操作类型的消息体,下方的Key只作为展示用, 实际返回中不存在该Key, 只返回对应数据
# 以上nft_msg, mt_msg具体参数可参考文档
$accountsHistory 是QueryAccountsHistoryRes对象
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
# operation_id:				操作ID, 必填字段


try {
  $nftClasses = $obj->nft_classes->CreateNFTClasses(new CreateNFTClassesReq([
      "name"  => "PHP-SDK 测试创建类别",
      "owner"     => "类别拥有者链账户地址",
      "operation_id" => "<操作ID>"
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# CreateNFTClassesRes 创建NFT类别交易成功返回参数对象
# operation_id: 操作ID
$nftClasses 是CreateNFTClassesRes对象
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

try {
  $classes = $obj->nft_classes->QueryNFTClasses(new QueryNFTCLassesReq([
      "offset" => "0",
      "limit" => "10",
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
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
$classes 是QueryNFTCLassesRes对象
```

#### 3.1.3 查询类别详情

```php
# QueryNFTClass 查询类别详情对象
# id:		NFT 类别 ID 必填

try {
	$class = $obj->nft_classes->QueryNFTClass(new QueryNFTClassReq("<id>"));
} catch (Exception $exception) {
    // TODO Exception information processing
}
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
$class 是QueryNFTClassRes对象
```

#### 3.1.4 转让类别

```php
# TransferNFTClassReq 转让类别对象, 类型为数组
# class_id:					NFT 类别 ID,需要转让的类别ID, 必填字段
# owner:						NFT 类别权属者地址, 当前类别的权属者, 必填字段
# recipient:				NFT 类别接收者地址，支持任一 Avata 平台内合法链账户地址, 必填字段
# operation_id:			操作 ID, 必填字段

try {
  $classes = $obj->nft_classes->TransferNFTClass(new TransferNFTClassReq([
      "class_id"  => "<class_id>",
      "owner" => "<owner>",
      "recipient"=>"<recipient>",
      "operation_id"=>"<operation_id>"
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# TransferNFTClassRes 转让类别返回的对象
# operation_id:				操作ID
$classes 是TransferNFTClassRes对象
```

### 3.2 NFT 接口

#### 3.2.1 发行NFT

```php
# CreateNFTReq 发行NFT对象参数, 类型为数组
# class_id:								NFT类别ID, 必填参数
# name:										NFT 名称, 必填参数
# uri:										链外数据链接
# uri_hash:								链外数据 Hash
# data:										自定义链上元数据
# recipient:							NFT 接收者地址，支持任一文昌链合法链账户地址，默认为 NFT 类别的权属者地址，不填写该参数，默认该NFT接收者为类别的拥有者
# operation_id:						操作ID, 必填参数

try {
  $nft = $obj->nfts->CreateNFT(new CreateNFTReq([
      "class_id"  => "<类别ID>",
      "name"  => "<NFT 名称>",
      "operation_id" => "<操作ID>",
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# CreateNFTRes 发行NFT成功返回对象
# operation_id:				操作ID
$nft 是CreateNFTRes对象
```

#### 3.2.2 转让NFT

```php
# TransferNFTReq 转让NFT对象参数, 类型为数组
# class_id:								NFT 类别 ID, 必填参数
# owner:									NFT 持有者地址, 必填参数
# nft_id:									NFT ID, 必填参数
# recipient:							NFT 接收者地址, 必填参数
# operation_id:						操作 ID, 必填参数

try {
	$nft = $obj->nfts->TransferNFT(new TransferNFTReq([]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# TransferNFTRes	转让NFT成功返回对象
# operation_id:				操作ID
$nft 是TransferNFTRes对象
```

#### 3.2.3 编辑NFT

```php
# EditNFTReq 编辑NFT对象参数, 类型为数组
# class_id:								NFT 类别 ID, 必填参数
# owner:									NFT 持有者地址, 必填参数
# nft_id:									NFT ID, 必填参数
# name:										NFT 名称, 必填参数
# uri:										链外数据链接
# data:										自定义链上元数据
# operation_id:						操作 ID, 必填参数

try {
	$nft = $obj->nfts->EditNFT(new EditNFTReq([]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# EditNFTRes	编辑NFT成功返回对象
# operation_id:				操作ID
$nft 是EditNFTRes对象
```

#### 3.2.4 销毁NFT

```php
# DeleteNFTReq 销毁NFT对象参数, 类型为数组
# class_id:								NFT 类别 ID, 必填参数
# owner:									NFT 持有者地址, 必填参数
# nft_id:									NFT ID, 必填参数
# operation_id:						操作 ID, 必填参数

try {
	$nft = $obj->nfts->DeleteNFT(new DeleteNFTReq([]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# DeleteNFTRes	销毁NFT成功返回对象
# operation_id:				操作ID
$nft 是DeleteNFTRes对象
```

#### 3.2.5 批量发行NFT

```php
# BatchCreateNFTReq 批量发行NFT对象参数, 类型为数组
# class_id:								NFT 类别 ID, 必填参数
# name:										NFT 名称, 必填参数
# operation_id:						操作 ID, 必填参数
# recipients:							NFT 接收者地址和发行数量。以数组的方式进行组合，可以自定义多个组合，可面向多地址批量发行 NFT, 数组, [["amount" => <发行数量>, "recipient" => "<接收者地址>"]], 具体可参考接口文档 必填参数
# uri:										链外数据链接
# uri_hash:								链外数据 Hash
# data:										自定义链上元数据

try {
	$nfts = $obj->nfts->BatchCreateNFT(new BatchCreateNFTReq([]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# BatchCreateNFTRes 批量发行NFT成功返回对象
# operation_id:				操作ID
$nfts 是BatchCreateNFTRes对象
```

#### 3.2.6 批量转让NFT

```php
# BatchTransferNFT 批量转让NFT对象参数, 类型为数组
# owner:						NFT 持有者地址, 必填参数
# data:							转让的NFT和接收者, 数组, 必填参数
# operation_id:						操作 ID, 必填参数

try {
  $nfts = $obj->nfts->BatchTransferNFT(new BatchTransferNFTReq([
      "owner"  => "<NFT 持有者地址>",
      "operation_id" => "<操作 ID>",
      "data" => [
          [
              [
                  "nfts" => [
                      "class_id" => "<class_id 类别ID>",
                      "nft_id" => "<转让的NFT-ID>"
                  ],
                  "recipient" => "<接收者地址>"
              ]
          ]
      ]
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# BatchTransferNFTRes 批量转让NFT成功返回对象
# operation_id:				操作ID
$nfts 是BatchTransferNFTRes对象
```

#### 3.2.7 批量编辑NFT

```php
# BatchEditNFTReq 批量编辑NFT对象参数, 类型为数组
# owner:						NFT 持有者地址, 必填参数
# nfts:							编辑的NFT信息, 数组, 必填参数
# nfts->class_id:		NFT 类别 ID, 字符串, 必填参数
# nfts->nft_id:			NFT ID, 字符串, 必填参数
# nfts->name:				NFT 名称,字符串, 必填参数
# nfts->uri:				链外数据链接, 字符串
# nfts->data:				自定义链上元数据, 字符串
# operation_id:						操作 ID, 必填参数

try {
  $nfts = $obj->nfts->BatchEditNFT(new BatchEditNFTReq([
      "owner"  => "<NFT 持有者地址>",
      "operation_id" => "<操作 ID>",
      "nts" => [
          [
              "class_id": "<NFT 类别 ID, 字符串, 必填参数>",
              "nft_id": "<NFT ID, 字符串, 必填参数>",
              "name": "<NFT 名称,字符串, 必填参数>",
              "uri": "<链外数据链接, 字符串>",
              "data": "<自定义链上元数据, 字符串>"
          ]
      ]
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# BatchEditNFTRes 批量编辑NFT成功返回对象
# operation_id:				操作ID
$nfts 是BatchEditNFTRes对象
```

#### 3.2.7 批量销毁NFT

```php
# BatchDeleteNFTReq 批量销毁NFT对象参数, 类型为数组
# owner:						NFT 持有者地址, 必填参数
# nfts:							编辑的NFT信息, 数组, 必填参数
# nfts->class_id:		NFT 类别 ID, 字符串, 必填参数
# nfts->nft_id:			NFT ID, 字符串, 必填参数
# operation_id:						操作 ID, 必填参数

try {
  $nfts = $obj->nfts->BatchDeleteNFT(new BatchDeleteNFTReq([
      "owner"  => "<NFT 持有者地址>",
      "operation_id" => "<操作 ID>",
      "nts" => [
          [
              "class_id": "<NFT 类别 ID, 字符串, 必填参数>",
              "nft_id": "<NFT ID, 字符串, 必填参数>",
          ]
      ]
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# BatchDeleteNFTRes 批量销毁NFT成功返回对象
# operation_id:				操作ID
$nfts 是BatchDeleteNFTRes对象
```

#### 3.2.8 NFT列表

```php
# QueryNFTSReq 查询NFT列表参数对象, 类型为数组
# offset:								游标，默认为 0
# limit: 								每页记录数，默认为 10，上限为 50
# id:										NFT 类别 ID
# name:									NFT 名称，支持模糊查询
# class_id:							NFT 类别 ID
# owner:								NFT 权属者地址
# tx_hash:							创建 NFT 的 Tx Hash
# status:								NFT 状态：active / burned，默认为 active
# start_date:						NFT 类别创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
# end_date:							NFT 类别创建日期范围 - 结束，yyyy-MM-dd（UTC 时间
# sort_by:							排序规则：DATE_ASC / DATE_DESC

try {
  $nfts = $obj->nfts->QueryNFTS(new QueryNFTSReq([
      "offset" => "0",
      "limit" => "10",
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# QueryNFTSRes 			查询NFT列表成功参数对象
# offset:						游标
# limit:						每页记录数
# total_count:			总记录数
# nfts:							NFT列表, 类型为数组
# nfts->id:					NFT  ID
# nfts->name:				NFT 名称
# nfts->class_id:			NFT 类别ID
# nfts->class_name:			NFT 类别名称
# nfts->class_symbol:			NFT 类别标识
# nfts->uri: 			链外数据链接
# nfts->owner:		NFT 权属者地址
# nfts->status:		FT 状态：active / burned
# nfts->tx_hash: 创建 NFT 类别的 Tx Hash
# nfts->timestamp: 创建 NFT 类别的时间戳（UTC 时间）
$nfts 是QueryNFTSRes对象
```

#### 3.2.9 查询NFT详情

```php
# QueryNFTReq 					查询NFT详情参数对象
# class_id:							类别ID
# nft_id:								NFT ID

try {
	$nft = $obj->nfts->QueryNFT(new QueryNFTReq("<class_id>", "<nft_id>"));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# QueryNFTRes 	查询NFT详情成功参数对象
# id:					NFT  ID
# name:				NFT 名称
# class_id:			NFT 类别ID
# class_name:			NFT 类别名称
# class_symbol:			NFT 类别标识
# uri: 			链外数据链接
# uri_hash: 			链外数据 Hash
# data:			自定义链上元数据
# owner:		NFT 权属者地址
# status:		FT 状态：active / burned
# tx_hash: 创建 NFT 类别的 Tx Hash
# timestamp: 创建 NFT 类别的时间戳（UTC 时间）
$nft 是QueryNFTRes对象
```

#### 3.2.10 查询NFT操作记录

```php
# QueryNFTHistoryReq  	查询NFT操作记录参数对象
# class_id:							NFT 类别 ID
# nft_id:								NFT ID
# offset:								游标，默认为 0
# limit: 								每页记录数，默认为 10，上限为 50
# signer:								Tx 签名者地址
# tx_hash:							NFT 操作 Tx Hash
# operation:						操作类型：mint / edit / transfer / burn
# start_date:						NFT 操作日期范围 - 开始，yyyy-MM-dd（UTC 时间）
# end_date:							NFT 操作日期范围 - 结束，yyyy-MM-dd（UTC 时间）
# sort_by:							排序规则：DATE_ASC / DATE_DESC

try{
  $NFTHistorys = $obj->nfts->QueryNFTHistory(new QueryNFTHistoryReq([
      "class_id"	=> "<NFT 类别 ID>",
      "nft_id"		=> "<NFT ID>",
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# QueryNFTHistoryRes 查询NFT操作记录返回对象
# offset:						游标
# limit:						每页记录数
# total_count:			总记录数
# operation_records:							NFT操作记录列表, 类型为数组
# operation_records->tx_hash:			NFT 操作的 Tx Hash
# operation_records->operation:		NFT 操作类型 Enum: "mint" "edit" "transfer" "burn"
# operation_records->signer:			Tx 签名者地址
# operation_records->recipient:		NFT 接收者地址
# operation_records->timestamp:		NFT 操作时间戳（UTC 时间）
$NFTHistorys 是QueryNFTHistoryRes对象
```

## 4.MT 接口

### 4.1 类别接口

#### 4.1.1 创建 MT 类别

```php
# CreateMTClassReq 创建 MT 类别参数对象,类型为数组
# name:								MT 类别名称, 必填字段
# owner:							MT 类别权属者地址，支持任一 Avata 平台内合法链账户地址, 必填字段
# data:								自定义链上元数据
# operation_id:				        操作ID, 必填字段

try{
  $class = $obj->mts->CreateMTClass(new CreateMTClassReq([
    "name" => "<MT 类别名称>",
    "owner" => "<MT 类别权属者地址>",
    "operation_id" => "<操作 ID>"
    ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# CreateMTClassRes 创建MT类别交易成功返回参数对象
# operation_id: 操作ID
$class 是CreateMTClassRes对象
```

#### 4.1.2 查询类别列表

```php
# QueryMTClasses 查询 MT 类别列表参数对象, 类型为数组
# offset:								游标，默认为 0
# limit: 								每页记录数，默认为 10，上限为 50
# id:									MT 类别 ID
# name:									MT 类别名称，支持模糊查询
# owner:								MT 类别权属者地址
# tx_hash:							创建 MT 类别的 Tx Hash
# start_date:						MT 类别创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
# end_date:							MT 类别创建日期范围 - 结束，yyyy-MM-dd（UTC 时间
# sort_by:							排序规则：DATE_ASC / DATE_DESC

try{
  $classes = $obj->mts->QueryMTClasses(new QueryMTClassesReq([
      "offset" => "0",
      "limit" => "10",
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# QueryMTClassesRes 查询NFT类别列表成功参数对象
# offset:						游标
# limit:						每页记录数
# total_count:			总记录数
# classes:					类别列表, 类型为数组
# classes->id:			MT 类别 ID
# classes->name:		MT 类别名称
# classes->mt_count: 	MT 类别包含的 MT 总量(AVATA 平台内)
# classes->owner:		MT 类别权属者地址
# classes->tx_hash: 	创建 MT 类别的 Tx Hash
# classes->timestamp: 	创建 MT 类别的时间戳（UTC 时间）
$classes 是QueryMTClassesRes对象
```

#### 4.1.3 查询类别详情

```php
# QueryMTClass 查询类别详情对象
# id:		MT 类别 ID 必填

try{
	$classes = $obj->mts->QueryMTClass(new QueryMTClassReq("<id>"));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# QueryMTClassRes 查询类别详情返回对象
# id:								MT 类别 ID
# name:							MT 类别名称
# mt_count:				MT 类别包含的 NFT 总量
# data:							自定义链上元数据
# owner:						MT 类别权属者地址
# tx_hash:					创建 MT 类别的 Tx Hash
# timestamp:				创建 MT 类别的时间戳（UTC 时间）
$classes 是QueryMTClassRes对象
```

#### 4.1.4 转让类别

```php
# TransferMTClassReq 转让类别对象, 类型为数组
# class_id:					MT 类别 ID,需要转让的类别ID, 必填字段
# owner:					MT 类别权属者地址, 当前类别的权属者, 必填字段

# recipient:				MT 类别接收者地址，支持任一 Avata 平台内合法链账户地址, 必填字段
# operation_id:				操作 ID, 必填字段

try{
  $class = $obj->mts->TransferMTClass( "<class_id>","<owner>",new TransferMTClassReq([
      "recipient"=>"<recipient>",
      "operation_id"=>"<operation_id>"
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# TransferMTClassRes 转让类别返回的对象
# operation_id:				操作ID
$class 是TransferMTClassRes对象
```

### 4.2 MT 接口

#### 4.2.1 发行MT

```php
# IssueMTReq 发行 MT 对象参数, 类型为数组
# data:									自定义链上元数据
# amount:								MT 数量，不填写数量时，默认发行数量为 1
# recipient:							NFT 接收者地址，支持任一文昌链合法链账户地址，默认为 NFT 类别的权属者地址，不填写该参数，默认该NFT接收者为类别的拥有者
# operation_id:						操作ID, 必填参数

try{
  $mt = $obj->mts->IssueMT(new IssueMTReq([
      "operation_id" => "<操作ID>",
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# IssueMTRes 发行MT成功返回对象
# operation_id:				操作ID
$mt 是IssueMTRes对象
```

#### 4.2.2 增发MT

```php
# MintMTReq 增发 MT 对象参数, 类型为数组
# class_id:								MT 类别 ID, 必填参数
# mt_id:								MT ID, 必填参数

# amount:								MT 名称, 必填参数
# recipient:							MT 接收者地址
# operation_id:							操作ID, 必填参数

try{
  $mt = $obj->mts->MintMT("<MT 类别 ID>","<MT ID>",new MintMTReq([
      "operation_id" => "<操作 ID>",
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# MintMTRes 增发 MT 成功返回对象
# operation_id:				操作ID
$mt 是MintMTRes对象
```

#### 4.2.3 转让MT

```php
# TransferMTReq 转让 MT 对象参数, 类型为数组
# class_id:								MT 类别 ID, 必填参数
# owner:								MT 持有者地址, 必填参数
# mt_id:								MT ID, 必填参数

# amount:								转移的数量（默认为 1 ）
# recipient:							接收者地址, 必填参数
# operation_id:							操作 ID, 必填参数

try{
  $mt = $obj->mts->TransferMT("<MT 类别 ID>","<MT 持有者地址>","<MT ID>",new TransferMTReq([
      "operation_id" => "<操作 ID>",
      "recipient" => "<MT 接收者地址>",
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# TransferMTRes	转让 MT 成功返回对象
# operation_id:				操作ID
$mt 是TransferMTRes对象
```

#### 4.2.4 编辑MT

```php
# EditMTReq 编辑 MT 对象参数, 类型为数组
# class_id:									MT 类别 ID, 必填参数
# owner:									MT 类别权属者地址, 必填参数
# mt_id:									MT ID, 必填参数
# data:										自定义链上元数据,必填参数
# operation_id:								操作 ID, 必填参数

try{
  $mt = $obj->mts->EditNFT("<MT 类别 ID>","<MT 类别权属者地址>","<MT ID>", new EditNFTReq([
      "operation_id" => "<操作 ID>",
      "data" => "<自定义链上元数据>",
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# EditMTRes	编辑NFT成功返回对象
# operation_id:				操作ID
$mt 是EditMTRes对象
```

#### 4.2.5 销毁MT

```php
# BurnMTReq 销毁 MT 对象参数, 类型为数组
# class_id:									MT 类别 ID, 必填参数
# owner:									MT 持有者地址, 必填参数
# mt_id:									MT ID, 必填参数
# amount:								 	销毁的数量
# operation_id:								操作 ID, 必填参数

try{
  $mt = $obj->mts->BurnNFT("<MT 类别 ID>","<MT 持有者地址>","<MT ID>", new BurnMTReq([
      "operation_id" => "<操作 ID>",
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# BurnMTRes	销毁 MT 成功返回对象
# operation_id:				操作ID
$mt 是BurnMTRes对象
```

#### 4.2.6 查询MT列表

```php
# QueryMTsReq 查询 MT 列表参数对象, 类型为数组
# offset:								游标，默认为 0
# limit: 								每页记录数，默认为 10，上限为 50
# id:									MT ID
# name:									MT 名称，支持模糊查询
# class_id:								MT 类别 ID
# owner:								MT 发行者地址
# tx_hash:							    创建 MT 的 Tx Hash
# start_date:							MT 类别创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
# end_date:								MT 类别创建日期范围 - 结束，yyyy-MM-dd（UTC 时间
# sort_by:								排序规则：DATE_ASC / DATE_DESC

try{
  $mts = $obj->mts->QueryMTs(new QueryMTsReq([
      "offset" => "0",
      "limit" => "10",
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# QueryMTsRes 			查询 MT 列表成功参数对象
# offset:						游标
# limit:						每页记录数
# total_count:					总记录数
# mts:							MT 列表, 类型为数组
# mts->id:					MT  ID
# mts->class_id:			MT 类别ID
# mts->class_name:			MT 类别名称
# mts->issuer:				首次发行该 MT 的链账户地址
# mts->owner_count:			MT 拥有者数量(AVATA 平台内)
# mts->timestamp: 			MT 首次发行时间戳（UTC 时间）
$mts 是QueryMTsRes对象
```

#### 4.2.7 查询MT详情

```php
# QueryMTReq 					查询 MT 详情参数对象
# class_id:									MT 类别 ID, 必填参数
# mt_id:									MT ID, 必填参数

try{
	$mt = $obj->mts->QueryMT(new QueryMTReq("<class_id>", "<mt_id>"));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# QueryMTRes 	查询 MT 详情成功参数对象
# id:					MT  ID
# class_id:				MT 类别ID
# class_name:			MT 类别名称
# data:					自定义链上元数据
# owner_count:		    MT 拥有者数量(AVATA 平台内)
# issue_data:			首次发行该 MT 的链账户地址、发行时间、首发数量、首发交易哈希
# mt_count: 			MT 流通总量(全链)
# timestamp: 			MT 发行次数(AVATA 平台内累计发行次数(包括首次发行和增发))
$mt 是QueryMTRes对象
```

#### 4.2.8 查询MT操作记录

```php
# QueryMTHistoryReq  	查询 MT 操作记录参数对象
# class_id:							MT 类别 ID
# mt_id:							MT ID

# offset:							游标，默认为 0
# limit: 							每页记录数，默认为 10，上限为 50
# signer:							Tx 签名者地址
# tx_hash:							MT 操作 Tx Hash
# operation:						操作类型： issue(首发MT) / mint(增发MT) / edit(编辑MT) / transfer(转让MT) / burn(销毁MT)
# start_date:						MT 操作日期范围 - 开始，yyyy-MM-dd（UTC 时间）
# end_date:							MT 操作日期范围 - 结束，yyyy-MM-dd（UTC 时间）
# sort_by:							排序规则：DATE_ASC / DATE_DESC

try{
	$MTHistorys = $obj->mts->QueryMTHistory("<MT 类别 ID>","<MT ID>",new QueryMTHistoryReq([]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# QueryMTHistoryRes 查询 MT 操作记录返回对象
# offset:						游标
# limit:						每页记录数
# total_count:					总记录数
# operation_records:			MT 操作记录列表, 类型为数组
# operation_records->tx_hash:			MT 操作的 Tx Hash
# operation_records->operation:			MT 操作类型 Enum: "issue" "mint" "edit" "transfer" "burn"
# operation_records->signer:			Tx 签名者地址
# operation_records->recipient:			MT 接收者地址
# operation_records->amount:			MT 操作数量
# operation_records->timestamp:			MT 操作时间戳（UTC 时间）
$MTHistorys 是QueryMTHistoryRes对象
```

#### 4.2.9 查询MT余额

```php
# QueryMTBalanceReq  	查询 MT 余额参数对象
# class_id:							MT 类别 ID
# account:							链账户地址
# offset:								游标，默认为 0
# limit: 								每页记录数，默认为 10，上限为 50
# id:							 		MT ID

try{
	$mtBalance = $obj->mts->QueryMTBalance("<MT 类别 ID>","<链账户地址>",new QueryMTBalanceReq([]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# QueryMTBalanceRes 查询 MT 余额返回对象
# offset:						游标
# limit:						每页记录数
# total_count:					总记录数
# mts:						
# mts->tx_hash:			MT ID
# mts->operation:		MT 数量
$mtBalance 是QueryMTBalanceRes对象
```

## 5.充值接口

### 5.1 购买能量值/业务费

```php
# CreateOrdersReq					购买能量值和业务费参数对象
# account:									链账户地址, 必填参数
# amount:									购买金额 ，只能购买整数元金额；单位：分, 必填参数
# order_type:							充值类型：gas：能量值；business：业务费, 必填参数
# order_id:								自定义订单流水号，必需且仅包含数字、下划线及英文字母大/小写

try{
  $order = $obj->orders->CreateOrder(new CreateOrdersReq([
      "account"	=> "<链账户地址>",
      "amount"	=> "<购买金额>",
      "order_type"				=> "<充值类型>",
      "order_id"	=> "<自定义订单流水号>"
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# CreateOrdersRes 					购买能量值和业务费返回对象
# order_id:									交易流水号（用户发起交易时传入的交易流水号)
$order 是CreateOrdersRes对象
```

### 5.2 查询能量值/业务费购买结果列表

```php
# QueryOrdersReq  			查询能量值/业务费列表参数对象
# offset:								游标，默认为 0
# limit: 								每页记录数，默认为 10，上限为 50
# status:								订单状态：success 充值成功 / failed 充值失败 / pending 正在充值
# start_date:						充值订单创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
# end_date:							充值订单创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
# sort_by:							排序规则：DATE_ASC / DATE_DESC, 默认为 DATE_DESC

try{
	$orders = $obj->orders->QueryOrders(new QueryOrdersReq([]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# QueryOrdersRes 		查询能量值/业务费列表返回对象
# offset:						游标
# limit:						每页记录数
# total_count:			总记录数
# order_infos:			查询能量值/业务费记录列表, 类型为数组
# order_infos->order_id:		订单流水号
# order_infos->status:			订单状态，success 充值成功 / failed 充值失败 / pending 正在充值
# order_infos->message:			提示信息
# order_infos->account:			链账户地址, 调用「批量购买能量值」接口不展示此字段
# order_infos->amount:			充值金额，为整数元金额；单位：分, 调用「批量购买能量值」接口不展示此字段
# order_infos->number:			充值的数量，充值 gas 该值单位为 ugas，充值业务费单位为分, 调用「批量购买能量值」接口不展示此字段
# order_infos->create_time:		创建时间（UTC 时间）
# order_infos->update_time:		最后操作时间（UTC 时间）
# order_infos->order_type:		订单类型，gas / business
$orders 是QueryOrdersRes对象
```

### 5.3 查询能量值/业务费购买结果

```php
# QueryOrderReq  				查询能量值/业务费参数对象
# order_id:							需要查询的订单流水号	

try{
	$order = $obj->orders->QueryOrder(new QueryOrderReq("<需要查询的订单流水号>"));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# QueryOrderRes 		查询能量值/业务费返回对象
# order_id:			订单流水号
# status:				订单状态，success 充值成功 / failed 充值失败 / pending 正在充值
# message:			提示信息
# account:			链账户地址, 调用「批量购买能量值」接口不展示此字段
# amount:				充值金额，为整数元金额；单位：分, 调用「批量购买能量值」接口不展示此字段
# number:				充值的数量，充值 gas 该值单位为 ugas，充值业务费单位为分, 调用「批量购买能量值」接口不展示此字段
# create_time:	创建时间（UTC 时间）
# update_time:	最后操作时间（UTC 时间）
# order_type:		订单类型，gas / business
$order 是QueryOrderRes对象
```

### 5.4 批量购买能量值

```php
# BatchCreateOrderReq					批量购买能量值参数对象
# list:												充值信息,二维数组, 必填参数
# order_id:										自定义订单流水号，必需且仅包含数字、下划线及英文字母大/小写, 必填参数

try{
  $order = $obj->orders->BatchCreateOrder(new BatchCreateOrderReq([
      "list"      => [
          [
              "account"   =>  "<链账户地址>",
              "amount"    =>  <购买金额 ，只能购买整数元金额；单位：分>,
          ],
      ],
      "order_id"  => "<自定义订单流水号，必需且仅包含数字、下划线及英文字母大/小写>",
  ]));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# BatchCreateOrderRes					批量购买能量值返回对象
# order_id:										交易流水号（用户发起交易时传入的交易流水号)
$order 是BatchCreateOrderRes对象
```

## 6.链上存证服务

### 6.1 数字作品存证接口

```php
# CreateRecordReq								数字作品存证参数对象
# identity_type:								存证主体；1:个人；2:企业
# identity_name:								个人姓名或企业名称，规范如下：
#																个人姓名：长度限制 1-16 个字符（UTF-8 编码），首字符不能是特殊符号；
# 															企业名称：长度限制 1-50 个字符（UTF-8 编码），首字符不能是特殊符号；
# 															未传入存证主体字段时，不支持此字段；传入存证主体字段时，此字段必填
# identity_num:									个人为身份证号码，企业为统一社会信用代码,未传入存证主体字段时，不支持此字段；传入存证主体字段时，此字段选填
# type:													作品类型, 参数值具体见SDK注释或接口文档字段定义,必填字段
# name:													作品名称, 必填字段
# description:									作品描述, 必填字段
# hash:													作品哈希；将单个作品源文件使用单向散列函数（如 MD5，SHA 等）进行一次 Hash 计算；将多个作品源文件分别进行一次 Hash 计算，再将得到的 Hash 值进行二次 Hash 计算, 必填字段
#	hash_type:										作品哈希类型 1:其它； 2:SHA256；3:MD5；4:SHA256-PFV, 必填字段
# operation_id:									操作 ID，保证幂等性，避免重复请求，保证对于同一操作发起的一次请求或者多次请求的结果是一致的；由接入方生成的、针对每个 Project ID 唯一的、不超过 64 个大小写字母、数字、-、下划线的字符串, 必填字段

try{
	$record = $obj->records->CreateRecord(new CreateRecordReq([]));
} catch (Exception $exception) {
    // TODO Exception information processing
}
# CreateRecordRes							数字作品存在返回对象
# operation_id:								操作ID
$record 是CreateRecordRes对象
```

## 7.交易结果查询接口

### 7.1 上链交易结果查询

```php
# QueryTxReq					上链交易结果查询对象
# operation_id:				操作 ID, 创建交易时使用的操作id, 用于查询交易状态, 必填参数

try{
	$tx = $obj->txs->QueryTx(new QueryTxReq("<operation_id>"));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# QueryTxRes							上链交易结果查询返回对象
# type:										用户操作类型, 参数值请查询接口文档或SDK注释
# module:									交易模块, nft,mt,record
# tx_hash:								交易哈希
# status:									交易状态， 0 处理中； 1 成功； 2 失败； 3 未处理；
#													交易状态说明：
#													status 为 3（未处理），上链请求还在等待处理，请稍等；
#													status 为 0（处理中），上链请求正在处理，请等待处理完成；
#													status 为 1（成功），交易已上链并执行成功；
#													status 为 2（失败），说明该交易执行失败。请在业务侧做容错处理。可以参考接口返回的 message（交易失败#													的错误描述信息） 对 NFT / MT / 业务接口的请求参数做适当调整后，使用「新的 Operation ID 」重新发起 NFT / MT / 业务接口请求
# message:								交易失败的错误描述信息
# block_height:						交易上链的区块高度
#	timestamp:							交易上链时间（UTC 时间）
#	nft:										对应不同操作类型的消息体
# mt:											对应不同操作类型的消息体
# record:									对应不同操作类型的消息体
$tx 是QueryTxRes对象
```

### 7.2 上链交易排队状态查询

```php
# QueryTxQueueReq								上链交易排队状态查询对象
# operation_id:									操作 ID, 创建交易时使用的操作id, 非必填参数

try{
	$tx = $obj->txs->QueryTxQueue(new QueryTxQueueReq("<operation_id>"));
} catch (Exception $exception) {
    // TODO Exception information processing
}

# QueryTxQueueRes							上链交易排队状态查询返回对象
# queue_total:								当前队列中待处理交易总数
# queue_request_time:					当前队列即将被处理交易的请求时间（UTC 时间）
# queue_cost_time:						当前队列中所有交易处理完预估时间（秒）
# tx_queue_position:					Operation ID 对应交易所处队列中的位置；若交易存在队列中，0 则表示正在重试
# tx_request_time:						Operation ID 对应交易的请求时间（UTC 时间）
# tx_cost_time:								Operation ID 对应交易预估处理所需时间（秒）
# tx_message:									Operation ID 对应交易排队描述信息

$tx是QueryTxQueueRes对象
```

