swoole-jobs跟ThinkPHP5 结合示范

===============

## 使用
* git clone  https://github.com/kcloze/swoole-jobs-tp5.git
* 配置 `application/swoole-jobs.php`队列相关地址
* php swoole-jobs start

## 推送任务示例
* php think push

## 查看日志
* `runtime/swoole-jobs/log`日志信息

## 接入自己的项目
* composer.json增加swoole-jobs包依赖：`"kcloze/swoole-jobs":"^4.0.2"`
* `composer update`
* 复制根目录swoole-jobs到自己项目，修改权限`chmod u+x swoole-jobs`
* 复制配置文件`application/swoole-jobs.php`到自己配置目录