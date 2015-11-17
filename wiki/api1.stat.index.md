# GET /api1/stat

统计


## 参数：

1.公共参数

发送请求时必须传入公共参数，详见[公共参数说明](api1.game.index.md)

2.私有参数

参数          |类型          |字段说明
-------------|--------------|-------------
game_id      | int          |游戏ID, 统计App的启动次数和UV game_id = 0 表示App自身

## 使用方法

```
http://laradmin.local.com/api1/stat?
game_id=0&
version=1.0.0&
platform=android&
os_version=6.0&
device_id=JGDI-FJHGK-JWHF34-GGF
```

## 返回结果
成功
```
{
    "status": "200"
}
```
错误
```
{
    "status": "404",
    "message": "game_id is not found"
}
```