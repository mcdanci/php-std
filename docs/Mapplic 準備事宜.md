# Mapplic 准备事宜

- SVG格式的3D图

- 需要提供每个位置对应的信息， 如铺位一，对应1号，id, 名称，标题，短简介，铺位介绍，铺位展示logo

- 关于每个铺位坐标是前端这边设置，不需要提供

- 后端需要提供基本数据结构：

```
{
	map: '', //3D图文件（最好是线上地址)
	minimap: '', //3D图缩略图文件 
	categories: [{ //数组，区域分类
		id: 'good',
		title: '',
		color: '', //左侧分类栏目颜色
		show: 'false', //是否默认展开
	}],
	locations: [ //数组
		"id": "", 
		"title": "", //位置名称
		"about": "", //左侧短简介
		"description": "", //3D图上显示的简介
		"category": "food", //对应上面分类
		"thumbnail": "images/thumbs/amc.jpg", //展示图片
	],
} 
```
