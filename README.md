# S Show
## API
[![Total Downloads](https://poser.pugx.org/topthink/think/downloads)](https://packagist.org/packages/topthink/think)
[![Latest Stable Version](https://poser.pugx.org/topthink/think/v/stable)](https://packagist.org/packages/topthink/think)
[![Latest Unstable Version](https://poser.pugx.org/topthink/think/v/unstable)](https://packagist.org/packages/topthink/think)
[![License](https://poser.pugx.org/topthink/think/license)](https://packagist.org/packages/topthink/think)

### Copyright Information
#### ThinkPHP 5.0
- © 2006 ~ 2017, by [ThinkPHP](http://www.thinkphp.cn/).
-  All rights reserved.
- [Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0).
- ThinkPHP® 商标和著作权所有者为上海顶想信息科技有限公司。

See [LICENSE.txt](LICENSE.txt) for detail.

## S Show Phase 2
在资源（包含但不限于人才同工作时间）允许的情况下，S Show phase 2 生存周期同时采用 DDD 为主，TDD 为辅的策略进行。

## 生存周期
`TODO`

Phase 2 生存周期规划（未计展位模块），如下图所示：
<div class="mermaid">
gantt
  dateformat YYYY-MM-DD
  title Phase 2 生存周期规划
    section Phase 2 启动与计划
      项目计划: done, 2017-10-30, 5d
      Phase 1 回顾: crit, active, 2017-11-23, 2017-12-08
      项目启动: 2017-11-23, 5d
      项目实施的启动: 5d
    section 需求分析
      定义用户场景: 5d
      定义用户用例: 5d
      确定需求: crit, 5d
    section 系统与测试设计——系统设计
      概要设计: crit, done, 2017-10-30, 2017-11-30
      详细设计: crit, active, 2017-12-01, 2017-12-05
    section 系统与测试设计——测试设计
      定义测试策略: 2017-12-01, 1d
      制定测试计划: 1d
    section 编码与测试执行——编码环境准备
      确定编码规范: active, des-coding-ready, 2017-11-28, 2017-12-08
    section 编码与测试执行——编码
      View layer: after des-coding-ready, 1d
      Controller layer: 1d
      Model layer: 1d
      系统集成: 1d
    section 编码与测试执行——测试
      确定测试需求: 1d
      编写测试用例: 1d
    section 编码与测试执行——测试——测试编码
      View layer: after des-coding-ready, 1d
      Controller layer: 1d
      Model layer: 1d
    section 编码与测试执行——测试——测试执行
      集成测试: 1d
      部署测试: 1d
    section 测试评估与验收部署——测试评估与验收
      编写测试（评估）报告: 1d
      自动化测试: 1d
      验收测试: 1d
      测试结果评估: 1d
    section 测试评估与验收部署——部署
      制定部署方案: 1d
      部署: 1d
</div>
