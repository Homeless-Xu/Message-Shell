<?php
/**
 * 短信发送 API
 *
 * @param string $to         短信接收者 多个用 英文逗号隔开
 * @param array $template    模板相关信息 (数组)
			code: 模板 id
			sign_name: 签名
			param: 模板内参数 数组
 * @param string $extend     这是一个混合类型
 * @since 1.0
 * @return array
 */
function sendSms($to, $template, $extend = ''){
	$app_key = '23672767'; // APP Key
	$app_secret = 'a7011a438509d41693619d8bd720f906'; // APP Secret
 
	$url = 'http://gw.api.taobao.com/router/rest'; // API 地址
	
	/* POST 参数 */
	$post = array(
		'app_key' => $app_key,
		'format' => 'json',
		'method' => 'alibaba.aliqin.fc.sms.num.send',
		'partner_id' => 'apidoc',
		'sign_method' => 'md5',
		'timestamp' => date('Y-m-d H:i:s'),
		'v' => '2.0',
		'extend' => $extend,
		'rec_num' => $to,
		'sms_free_sign_name' => $template['sign_name'],
		'sms_param' => json_encode($template['param']),
		'sms_template_code' => $template['code'],
		'sms_type' => 'normal'
	);
 
	ksort($post); // 按键名 排序 (大多签名生成的必须步骤)
 
	/* 按照签名算法 生成签名 */
	$res = '';
	foreach($post as $k => $v){	$res .= $k . $v; }
 
	$res = str_replace(
		array('/\+/', '/\*/', '/%7E/'),
		array('%20', '%2A', '~'),
		$res
	);
	$post['sign'] = strtoupper(md5($app_secret . $res . $app_secret));
 
	/* CURL 发送数据 */
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$result = curl_exec($ch);
	curl_close($ch);
 
	$json = json_decode($result, true);
	return $json['alibaba_aliqin_fc_sms_num_send_response']['result'];
}









/* 模板信息 */
$template = array(
	'code' => 'SMS_53050330', // 模板 id
	'sign_name' => '徐健', // 信息签名
'param' => array('code' => '345435', 'product' => ' 简爱测试 '), 
// 模板内参数,这里的参数名字不能随便改. 值可以随便改.
);
 
/* 接收号码 */
$to = '18621923213';
 
$result = sendSms($to, $template);
 
print_r($result);