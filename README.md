## 实现功能: Mac Login → 给指定手机发短信

### 步骤简介:
1. 注册阿里大于,设置好签名和模板
2. 一个shell脚本:  Login.sh
3. 一个php脚本:    message.php
4. 设置Mac开机运行 Login.sh 

### 文件介绍
- message.php 作用:
  短信服务是要收费的 5分钱一条. 涉及到钱就必须注意使用安全.
  阿里大于通信服务必须进行加密.
  这个加密用shell脚本实现很麻烦.所以就用php了.

- login.sh 作用:
  这个脚本是给Mac 电脑开机启动用的.

Mac电脑开机运行脚本有两种方式.
一种是修改plist
一种是终端输入特定命令.(我们用这种)

### Mac 开机运行脚本:
我们才用的方法 只能开机运行一个脚本. 
终端下输入下面命令就可以.

1. 查看现有的开机运行脚本
   sudo defaults read com.apple.loginwindow LoginHook

2. 删除现有的开机运行脚本
   sudo defaults delete com.apple.loginwindow LoginHook

3. 把某个脚本加入到开机运行
   sudo defaults write com.apple.loginwindow LoginHook '/Users/v/Desktop/sh/Login.sh'
   (/Users/v/Desktop/sh/Login.sh 改成你自己 shell 脚本的位置)


## Login.sh 
把php 后面的路径. 换成你php脚本的路径就可以了




## message.php
带有❤️的 都是要填你自己的阿里大于帐号里面的信息.



