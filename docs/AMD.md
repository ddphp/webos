# AMD 规范

项目采用 AMD 规范加载和管理 JS 文件。

所有的 HTML 使用 require.js 统一管理 js 文件的加载。

所有的项目 JS 模块均使用 define 进行定义。

每个 HTML 页面只能包含一个 script 标签，用于加载 require.js。

其它 JS 模块通过此 script 标签的 data-main 指定的入口文件加载。

JS 模块 require 通过 require.config 配置依赖, define 仅需申明依赖而无须配置依赖。

模块别名使用 . 作为连字符。

baseUrl 设置为 '/js'。

以下情况需定义 paths 别名：

1. 非 AMD 规范类库
2. 未申明依赖关系类库
3. 非 baseUrl 目录下类库
4. 多源的类库

别名命名规范：

整个项目每个模块的别名具有维一性。

1. 具名模块以其指定名称命名
2. 非具名模块以 [根路径名称].[子路径名称···].[模块名称] 命名
3. 别名不应包含版本等非模块名称信息