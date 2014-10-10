酷炫的移动UI框架
========

#组件列表

1. nav-bar
    1. top-bar
    2. bottom-bar
    3. side-bar
2. Typography(markdown like style)
3. Buttons(colors, corner, round, loading)
4. forms(basic styles)
5. popover
6. tooltip
7. modal
8. loading

#交互要求

全部使用transform3d实现。

#框架形式

UI形成一个库，引入CSS就行

js交互不形成库，编写一批标准gist提供参考（可以适配一些流行框架）

考虑到移动端的特殊性，降低引入文件大小很重要。另外强制使用已经成型的框架对一些定制性高的需求并不友好。

#系统适配

android 2.3+

ios 5+

windows pohone因为测试原因暂时不考虑在内

#兼容性问题收集

1. 安卓2.3不支持fixed的元素进行transform变化
2. iPhone的fixedbug

    >ios5之前不支持fixed，ios5之后是半支持fixed。比如如果你有一个fixed的底部菜单，在平时的时候都是正常的，但是如果这个时候有个输入框，弹出虚拟键盘之后，底部菜单就不知道去哪了。。。
3. 安卓2.3不支持圆角百分比
