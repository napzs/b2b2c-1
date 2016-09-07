Shop
==================


## 说明

### 项目搭建

#### 原始安装方法（推荐）

1、安装 [Composer](http://www.yiiframework.com/doc-2.0/guide-start-installation.html#installing-via-composer)

2、新建数据库 `b2b2c`，建议使用 `utf8` 编码格式

3、执行如下脚本
```
cd shop
composer install
php init
```

4、运行安装程序

```
php yii install
```

或者直接执行数据库迁移工具生成数据库表

```
php yii migrate 
```

#### 访问

添加以下两个域名到 `host` 里面

	> 前台 localhost	b2b2c.dev 
	> 后台 localhost	admin.b2b2c.dev
