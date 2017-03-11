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


## Login.sh 文件内容

`#!/bin/sh`
`php /Users/v/Desktop/php/message.php`


> 这里只要把php 后面的路径. 换成你php脚本的路径就可以了




## message.php





'' <?php
'' /**
''  * 短信发送 API
''  *
''  * @param string $to         短信接收者 多个用 英文逗号隔开
''  * @param array $template    模板相关信息 (数组)
'' 			code: 模板 id
'' 			sign_name: 签名
'' 			param: 模板内参数 数组
''  * @param string $extend     这是一个混合类型
''  * @since 1.0
''  * @return array
''  */
'' function sendSms($to, $template, $extend = ''){
'' 	$app_key = '❤️'; // APP Key
'' 	$app_secret = '❤️'; // APP Secret
''  
'' 	$url = 'http://gw.api.taobao.com/router/rest'; // API 地址
'' 	
'' 	/* POST 参数 */
'' 	$post = array(
'' 		'app_key' => $app_key,
'' 		'format' => 'json',
'' 		'method' => 'alibaba.aliqin.fc.sms.num.send',
'' 		'partner_id' => 'apidoc',
'' 		'sign_method' => 'md5',
'' 		'timestamp' => date('Y-m-d H:i:s'),
'' 		'v' => '2.0',
'' 		'extend' => $extend,
'' 		'rec_num' => $to,
'' 		'sms_free_sign_name' => $template['sign_name'],
'' 		'sms_param' => json_encode($template['param']),
'' 		'sms_template_code' => $template['code'],
'' 		'sms_type' => 'normal'
'' 	);
''  
'' 	ksort($post); // 按键名 排序 (大多签名生成的必须步骤)
''  
'' 	/* 按照签名算法 生成签名 */
'' 	$res = '';
'' 	foreach($post as $k => $v){	$res .= $k . $v; }
''  
'' 	$res = str_replace(
'' 		array('/\+/', '/\*/', '/%7E/'),
'' 		array('%20', '%2A', '~'),
'' 		$res
'' 	);
'' 	$post['sign'] = strtoupper(md5($app_secret . $res . $app_secret));
''  
'' 	/* CURL 发送数据 */
'' 	$ch = curl_init();
'' 	curl_setopt($ch, CURLOPT_URL, $url);
'' 	curl_setopt($ch, CURLOPT_POST, 1);
'' 	curl_setopt($ch, CURLOPT_HEADER, 0);
'' 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
'' 	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
'' 	$result = curl_exec($ch);
'' 	curl_close($ch);
''  
'' 	$json = json_decode($result, true);
'' 	return $json['alibaba_aliqin_fc_sms_num_send_response']['result'];
'' }
'' 
'' 
'' 
'' 
'' 
'' 
'' 
'' 
'' 
'' /* 模板信息 */
'' $template = array(
'' 	'code' => '❤️', // 模板 id
'' 	'sign_name' => '❤️', // 信息签名
'' 'param' => array('code' => '345435', 'product' => ' 简爱测试 '), 
'' // 模板内参数,这里的参数名字不能随便改. 值可以随便改.
'' );
''  
'' /* 接收号码 */
'' $to = '❤️';
''  
'' $result = sendSms($to, $template);
''  
'' print_r($result);



> 这个文件里面 带有❤️的 都是要填你自己的阿里大于帐号里面的信息.



