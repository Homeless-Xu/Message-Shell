#!/bin/sh

# 这个是 登录电脑 就发送短信的脚本.

# 把这个脚本 加入到苹果自带的命令就可以开机启动(这种方法只支持一个脚本)
# sudo defaults write com.apple.loginwindow LoginHook '/Users/v/Desktop/php/message.php'

# 查看现有的 开机脚本
# sudo defaults read com.apple.loginwindow LoginHook
# 删除现有的 开机脚本
# sudo defaults delete com.apple.loginwindow LoginHook


php /Users/v/Desktop/php/message.php
