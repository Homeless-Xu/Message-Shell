##实现功能: Mac 电脑登录 → 给指定手机发短信


1. 注册阿里大于,设置好签名和模
2. 写一个 Login.sh
3. 写一个 message.php

为什么要单独写个 php脚本呢:
短信服务是要收费的. 设计到钱就必须注意安全.所以要使用阿里大于通信服务必须用md5什么的进行加密.这个加密用shell脚本实现很麻烦.所以就用php
login.sh 脚本是给Mac 电脑启动用的

.Mac电脑开机运行脚本有两种方式. 





把这个脚本 加入到苹果自带的命令就可以开机启动(这种方法只支持一个脚本)
sudo defaults write com.apple.loginwindow LoginHook '/Users/v/Desktop/sh/Login.sh'


查看现有的 开机脚本
sudo defaults read com.apple.loginwindow LoginHook

删除现有的 开机脚本
sudo defaults delete com.apple.loginwindow LoginHook



1
