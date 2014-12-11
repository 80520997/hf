<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>会员后台管理</title>
        <link href="/static/admin/images/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="/static/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="/admin/system/jsmenulist"></script>

        <script type="text/javascript">
            //设置右侧窗口高度
            function setHeight(h) {
                $("#right_win").height(h);
            }
        </script>
    </head>

    <body>
        <div class="main">
            <div class="nav">
                <div class="logo"></div>
                <div class="inp" id="top_menu">
                </div>
				<a href="/admin/login/logout" target="_self">安全退出</a>
            </div>
            <table width="100%" height="100%" cellspacing="0" cellpadding="0" style="float:left">
                <tr>
                    <div class="box"></div>
                    <td width="200" valign="top" style="padding:0 12px">
                        <div class="left">
                            <p id="left_menu_title"></p>
                            <ul id="left_menu">
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </div>
                    </td> 
                    <td width="100%" valign="top">
                        <iframe allowtransparency="true" frameborder="0"  frameborder="0" width="100%" id="right_win" name="right_win" src="/admin/index/intro/"></iframe>
                        <!--管理权限设置开始-->
                        <!--管理员权限结束-->
                    </td>
                </tr>
            </table>
        </div>
        </div>
        </div>
    </body>
    <script type="text/javascript">
        var html = "";
        for (var i = 0; i < menulist.length; ++i)
    {
            html += '<input type="button" ref="' + menulist[i].action + '" value="' + menulist[i].title + '" class="' + (i == 0 ? 'foc' : '') + '"/>';
            if (i == 0)
    {
                var str = "";
                for (var j = 0; j < menulist[i].list.length; ++j)
    {
				//使右面的iframe跳转到第一个链接地址 add by zhaitao
					if(j==0){
					window.frames["right_win"].location.href="/admin/"+ menulist[i].action +'/' + menulist[i].list[j].action;
					}
                    str += '<li><a href="/admin/' + menulist[i].action + '/' + menulist[i].list[j].action + '" target="right_win">' + menulist[i].list[j].title + '</a></li>';
                }
                $("#left_menu").html(str);
                $("#left_menu_title").text(menulist[i].title);
            }
        }

        $("#top_menu").html(html);

        $("#top_menu input").click(function() {
            $(this).parent().find("input").removeClass("foc");
            $(this).addClass("foc");
            var action = $(this).attr("ref");
            for (var i = 0; i < menulist.length; ++i)
    {
                if (menulist[i].action == action)
    {
                    var str = "";
                    for (var j = 0; j < menulist[i].list.length; ++j)
    {
					//使右面的iframe跳转到第一个链接地址 add by zhaitao
					if(j==0){
					window.frames["right_win"].location.href="/admin/"+ menulist[i].action +'/' + menulist[i].list[j].action;
					}
					
					
                    str += '<li><a href="/admin/' + menulist[i].action + '/' + menulist[i].list[j].action + '" target="right_win">' + menulist[i].list[j].title + '</a></li>';
                    }
                    $("#left_menu").html(str);
                    $("#left_menu_title").text(menulist[i].title);
					
                }
            }
        });
    </script>
</html>