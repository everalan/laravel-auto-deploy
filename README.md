自动部署 Laravel，适用于小型网站。
## 执行原理
根据代码更改，自动执行以下代码  
- git pull --stat
- composer install --no-dev
- php artisan config:cache
- php artisan route:cache
- php artisan queue:restart
- php artisan migrate --force
- php artisan migrate --force

## 环境要求

1. PHP >= 7.0
2. Laravel >= 5.6

## 安装

```shell
$ composer require everalan/laravel-auto-deploy
```
## 用法

### 手动执行

`php artisan auto-deploy`

### 通过 `git` 的 `webhook` 自动执行
运行一个 `PHP` 进程来监听请求，执行上述代码。
```bash
/usr/bin/php -S 0.0.0.0:8374 /path/to/project/vendor/everalan/laravel-auto-deploy/server.php
```
然后在 `github` 等添加 `webhook` 到服务器的 8374 端口。  
#### supervisord
如果你使用 `supervisord`，可以添加以下配置  
```ini
[program:auto-deploy]
process_name=%(program_name)s_%(process_num)02d
command=/usr/bin/php -S 0.0.0.0:8374 /path/to/project/vendor/everalan/laravel-auto-deploy/server.php
autostart=true
autorestart=true
user=root
numprocs=1
redirect_stderr=true
```
#### nginx
如果你不想开放对应的端口，而是直接使用 `nginx` 来调用，可以在 `nginx` 配置文件中添加以下代码
```nginx
location ^~ /auto-deploy {
    proxy_pass http://127.0.0.1:8374/;
}
```
## License

MIT