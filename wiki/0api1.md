# API 说明

## HOST

http://laradmin.local.com

## 关于 API 响应

成功
```
{
    "status": 200
}
```
失败
```
{
    "status": 400,
    "message": "The os version field is required."
}
```
`status code`

- 200 OK: 成功
- 400 Bad Request: 无效的请求，返回值中可以看到错误的详细信息
- 401 Unauthorized: 认证失败
- 403 Forbidden: 无访问权限
- 404 Not Found: 请求的资源已经不存在


## 关于 API 请求

#### 公共参数
参数          |类型          |字段说明
-------------|--------------|-------------
version      | string       |必选, app 的版本号
platform     | string       |必选,ios,android,wp
os_version   | string       |必选, 系统版本
device_id    | string       |必选, 设备ID



## API 列表

- GET [/api1/stat](api1.stat.index.md)  # 统计
