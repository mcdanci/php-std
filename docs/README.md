`// TODO`

# 业务过程
角色 | 行为
--- | ---
用户 | 填写表单进行登记
系统 | 传送登记成功（等待审核）的邮件给用户，同时传送邮件给管理平台管理员
用户 | 收到邮件，等待通知（电话或邮件）
| *二期*
管理平台管理员 | 登陆管理平台进行审核

涉及的电邮 address：
- 用户
- 管理平台（自动化所用）
- 管理平台管理员 (`admin@sshow-onlline.com`)

管理平台（自动化所用）所须配置的电邮：
电邮 | 用途
--- | ---
info@sshow-online.com | 发送展会资讯，接收 **Contact Us** 资料
admin@sshow-onlline.com | 发送和接收 **Registrations** 资料

# Data
## Dictionary
Type:
Key | Role
--- | ---
1 | exhibitor
2 | visitor

`Role type: 1: exhibitor, 2: visitor`

Gender:
Key | Role
--- | ---
1 | Mrs.
2 | Mr.

`Gender: 1: Mrs., 2: Mr.`

Category: `cat` 序列化储存。

Password: 先作 base64 储存，日后再考虑作若干次混合 hash 和 salt 的储存实现。

# Fields
> 注：带 `*` 为必须项。

## Common
Id | Description
--- | ---
name_first | First Name *
name_last | Last Name *
gender | Gender *
email | Email *
tel | Telephone
tel_cell | Cell Phone *
company | Company Name *
street | Street *
city | City *
state | State (Required for U.S. and Canada Only)
zip | Zip Code
country | Country *
website | Company Website *
cat | Category
password | Password (after confirm) *

## Exhibitior
Id | Description
--- | ---
c_opf | Country(ies) with own production facility *
mpt | Major Product Type(s) *
npe | What specific NEW product(s) are you going to exhibit in S-SHOW? *
mc | Major Customer(s)
tse | What other trade shows do you exhibit with (if any)?

## Visitor
Id | Description
--- | ---
job_function | Job Function *
b_or_f_man (brand, f_man) | Brand, Footwear Manufacturer

# Thanks to
Item | Lisense
--- | ---
ThinkPHP | Apache-2.0
league/iso3166 | MIT
phpmailer/phpmailer | LGPL-2.1

# Reference
- http://www.ubmfashion.com/exhibitor-form

# Email Template
```
Dear Administrator,

Please notice that you have obtained a new exhibitor application.

Exhibitor registration information:
Name: ...
...
```
