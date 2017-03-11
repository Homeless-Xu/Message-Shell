# 阿里大于笔记
工具:

API 参数详细说明
[https://api.alidayu.com/doc2/apiDetail?spm=0.0.0.0.DgW2BP&apiId=25450]


API测试工具:
[https://api.alidayu.com/apitools/apiTools.htm?spm=a3142.7395905.4.24.hIlSTL&catId=20711&apiId=25450&apiName=alibaba.aliqin.fc.sms.num.send&scopeId=]




## API 测试工具:

格式 json 
API 类目: 阿里大于API
API 名称: alibaba.aliqin.fc.sms.num.send   我这里是发短信的.
提交方式 post
SDK: php
APPkey  ....
APPsecret  ....
sms type: normal
sms-free-sign-name: 签名
rec-num  18621923213  接收短信的手机号码
sms-template-code:  ..

然后就发送成功了.



其实测试工具 就是发了一个请求而已...
脚本也是可以发请求的..



### 阿里大于主要参数.
'' $c = new TopClient;
'' $c->appkey = appkey;
'' $c->secretKey = secret;
'' $req = new AlibabaAliqinFcSmsNumSendRequest;
'' $req->setSmsType("normal");
'' $req->setSmsFreeSignName("徐健");
'' $req->setRecNum("18621923213");
'' $req->setSmsTemplateCode("SMS_53050330");

