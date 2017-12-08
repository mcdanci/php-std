# Flowchart
Registration:
<div class="mermaid">
  graph TB
    n0(Begin) --> n1[Visit Source the Future]
    n1 --> n2{Role selection}
    n2 -- Is exhibitor --> n-e0[Click EXHIBITOR REGISTRATION];
    n-e0 --> n-e1[Read EXHIBITION COST];
    n-e1 --> n-e2[Fill the form of exhibitor registration];
    n-e2 --> n3[Check terms];
    n2 -- Is visitor --> n-v0[Click VISITOR REGISTRATION];
    n-v0 --> n-v1[Fill the form of visitor registration];
    n-v1 --> n3;
    n3 --> n4[Submit]
    n4 --> n5["Get result of submission (in both alert and email which with password) and waiting for addit result"]
    n5 --> End(End)
    click n1 "https://www.sourcethefuture.com/" "Home page,
      or registrant (between exhibitor and visitor) registration from nav. in phase 1,
      powered by WordPress";
</div>

User (in roles among administrator, exhibitor & visitor) signing in:
<div class="mermaid">
  graph TB
    n0(Begin) --> n1{Sign in phase 2 platform}
    n1 -- Incorrect username or password --> n-f0[Reset with email]
    n-f0 --> n-f1[Check email and reset password in limited time]
    n-f1 --> n-f2{Enter new password}
    n-f2 -- Input breaks the rules --> n-f3[Retype tip]
    n-f3 --> n-f2
    n-f2 -- According to the rules and successful--> n1
    n1 -- Successful --> End(End)
</div>

Audit:
<div class="mermaid">
  graph TB
    n0(Begin) --> n1{Sign in phase 2 platform as administrator}
    n1 -- Successful --> n-p0[Select audit module]
    n-p0 --> n-p1[Check registrant list of being audited]
    n-p1 --> n-p2[Select one or more enrties of audit request]
    n-p2 --> n-p3{Audit}
    n-p3 --> n-p4["Decline (with optional reason list)"]
    n-p4 --> n-p5[Email result]
    n-p3 --> n-p6[Pass]
    n-p6 --> n-p5
    n-p5 --> End(End)
</div>

Exhibitor 展位选定：
<div class="mermaid">
  graph TB
    n0(Begin) --> n1{Sign in phase 2 platform}
    n1 -- is exhibitor --> n1p1["定位至「展位选定」模块"]
    n1p1 --> n2[检视并同意参展协议]
    n2 --> n3[选择可选的展区或非展区]
    n3 -- 选好了 --> n5{选择展位类型}
    n5 -- 重选上一项 --> n3
    n5 -- 选好了 --> n6{选择展位}
    n6 -- 选好了 --> n7{完成展位选定并记录所选展位}
    n6 -- 重选上一项 --> n5
    n7 -- 记录过程异常 --> n3
    n7 -- 记录完毕 --> n1p1
    n1p1 -- 已选定展位 --> End("End (and go to payment)")
</div>
