# 自定义抽奖概率计算

## 开源地址
https://github.com/JZhao1020/prize-sdk

##1.安装
```
composer require hao/prize-sdk 
```

##2.示例
```
$arr = [
   ['id' => 1,'prize' => '一等奖', 'v' => 1],
   ['id' => 2,'prize' => '二等奖', 'v' => 1],
   ['id' => 3,'prize' => '三等奖', 'v' => 100],
   ['id' => 4,'prize' => '谢谢参与', 'v' => 1000],
];

$result = \Prize\Prize::init($arr);
dump($result);
```