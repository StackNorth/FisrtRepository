<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>
	学生信息管理平台
</title><link href="/StudentManagerCenter/Public/styles/StudentStyle.css" rel="stylesheet" type="text/css" /><link href="/StudentManagerCenter/Public/js/jBox/Skins/Blue/jbox.css" rel="stylesheet" type="text/css" /><link href="/StudentManagerCenter/Public/styles/ks.css" rel="stylesheet" type="text/css" />
    <script src="/StudentManagerCenter/Public/js/jBox/jquery-1.4.2.min.js" type="text/javascript"></script>
    <script src="/StudentManagerCenter/Public/js/jBox/jquery.jBox-2.3.min.js" type="text/javascript"></script>
    <script src="/StudentManagerCenter/Public/js/jBox/i18n/jquery.jBox-zh-CN.js" type="text/javascript"></script>
    <script src="/StudentManagerCenter/Public/js/Common.js" type="text/javascript"></script>
    <script src="/StudentManagerCenter/Public/js/Data.js" type="text/javascript"></script>
    <script type="text/javascript">
        $().ready(function () {
            setStudMsgHeadTabCheck();
            showUnreadSysMsgCount();
        });

        //我的信息头部选项卡
        function setStudMsgHeadTabCheck() {
            var currentUrl = window.location.href;
            currentUrl = currentUrl.toLowerCase();
            var asmhm = "";
            $("#ulStudMsgHeadTab li").each(function () {
                asmhm = $(this).find('a').attr("href").toLowerCase();
                if (currentUrl.indexOf(asmhm) > 0) {
                    $(this).find('a').attr("class", "tab1");
                    return;
                }
            });
        }

        //显示未读系统信息
        function showUnreadSysMsgCount() {
            var unreadSysMsgCount = "0";
            if (Number(unreadSysMsgCount) > 0) {
                $("#unreadSysMsgCount").html("(" + unreadSysMsgCount + ")");
            }
        }

        //退出
        function loginOut() {
            if (confirm("确定退出吗？")) {
                StudentLogin.loginOut(function (data) {
                    if (data == "true") {
                        window.location = "/Login.aspx";
                    }
                    else {
                        jBox.alert("退出失败！", "提示", new { buttons: { "确定": true} });
                    }
                });
            }
        }
        //更改报考类别
        function changeCateory(thisObj, id) {
            var oldCateoryId = $("#cateoryId").val();
            var cateoryId = "";
            if (id != null) {
                cateoryId = id;
            }
            else {
                cateoryId = thisObj.val();
            }
            var studentId = $("#studentId").val();
            if (cateoryId.length <= 0) {
                jBox.tip("报考类别不能为空！");
                if (id == null) {
                    thisObj.val(oldCateoryId);
                }
            }
            else {
                studentInfo.changeStudentCateory(cateoryId, function (data) {
                    var result = $.parseJSON(data);
                    if ((String(result.ok) == "true")) {
                        window.location.href = "/Index.aspx";
                    }
                    else {
                        jBox.tip(result.message);
                    }
                });
            }
        }
    </script>
    
<script type="text/javascript">

    function showMsg(msg, obj) {
        jBox.tip(msg);
        $("#" + obj).focus();
    }

</script>
</head>
<body>

     <div class="banner">
        <div class="bgh">
            <div class="page">
                <div id="logo">
                    <a href="/StudentManagerCenter/index.php/Index/index/">
                        <img src="/StudentManagerCenter/Public/images/Student/logo.gif" alt="" width="165" height="48" />
                    </a>
                </div>
                <div class="topxx">
                     <a href="/StudentManagerCenter/index.php/MyInfo/index/">我的信息</a>
                     <a href="/StudentManagerCenter/index.php/User/systemMsge/">通知</a>
                     <a href="/StudentManagerCenter/index.php/User/updatePassword/">密码修改</a> 
                     <a onclick="loginOut()" href="javascript:">安全退出</a>
                </div>
                <div class="blog_nav">
                    <ul>
                        <li><a href="/StudentManagerCenter/index.php/Index/index/">我的信息</a></li>
                        <li><a href="/StudentManagerCenter/index.php/Education/index/">教务中心</a></li>
                        <li><a href="/StudentManagerCenter/index.php/Account/index/">我的学费</a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="page">
        <div class="box mtop">
         
<div class="leftbox">
    <div class="l_nav2">
        <div class="ta1">
            <strong>个人中心</strong>
            <div class="leftbgbt">
            </div>
        </div>
        <div class="cdlist">
            <div>
                <a href="/StudentManagerCenter/index.php/MyInfo/index/">我的信息</a></div>
            <div>
                <a href="/StudentManagerCenter/index.php/MyInfo/classInfo/">班级信息 </a>
            </div>
            <div>
                <a href="/StudentManagerCenter/index.php/User/letter/">短信息</a></div>
            <div>
                <a href="/StudentManagerCenter/index.php/User/systemMsge">学院通知</a></div>
            <div>
                <a href="/StudentManagerCenter/index.php/MyInfo/objection">我的异议</a></div>
        </div>
        <div class="ta1">
            <strong>教务中心</strong>
            <div class="leftbgbt2">
            </div>
        </div>
        <div class="cdlist">
            <div>
                <a href="/StudentManagerCenter/index.php/Education/application/">我的报考</a></div>
            <div>
                <a href="/StudentManagerCenter/index.php/Education/index/">我的成绩</a></div>
            <div>
                <a href="/StudentManagerCenter/index.php/Education/book/">我的书籍</a></div>
        </div>
    
       
        <div class="ta1">
            <strong>财务中心</strong><div class="leftbgbt2">
            </div>
        </div>
        <div class="cdlist">
            <div>
                <a href="/StudentManagerCenter/index.php/Account/index/">我的财务</a></div>
        </div>
        <div class="ta1">
           
            </div>
        </div>
    </div>

           <!--  <div class="leftbox">
               <div class="l_nav2">
                   <div class="ta1">
                       <strong>个人中心</strong>
                       <div class="leftbgbt">
                       </div>
                   </div>
                   <div class="cdlist">
                       <div>
                           <a href="Index.aspx.html">我的信息</a></div>
                       <div>
                           <a href="ClassInfo.aspx.html">班级信息 </a>
                       </div>
                       <div>
                           <a href="../User/StudentInfor/Letter.aspx.html">短信息</a></div>
                       <div>
                           <a href="../User/StudentInfor/systemMsge.aspx.html">学院通知</a></div>
                       <div>
                           <a href="Objection.aspx.html">我的异议</a></div>
                   </div>
                   <div class="ta1">
                       <strong>教务中心</strong>
                       <div class="leftbgbt2">
                       </div>
                   </div>
                   <div class="cdlist">
                       <div>
                           <a href="../EducationCenter/Application.aspx.html">我的报考</a></div>
                       <div>
                           <a href="../EducationCenter/Score.aspx.html">我的成绩</a></div>
                       <div>
                           <a href="../EducationCenter/Book.aspx.html">我的书籍</a></div>
                   </div>
                   <div class="ta1">
                       <strong>学习中心</strong><div class="leftbgbt2">
                       </div>
                   </div>
                   <div class="cdlist">
                       <div>
                           <a href="../OnlineTeaching/StudentMaterial.aspx.html">资料下载</a></div>
                       <div>
                           <a href="../OnlineTeaching/StudentStudyRecordList.aspx.html">学习历程</a></div>
                   </div>
                  
                   <div class="ta1">
                       <strong>财务中心</strong><div class="leftbgbt2">
                       </div>
                   </div>
                   <div class="cdlist">
                       <div>
                           <a href="../MyAccount/wdcw.aspx.html">我的财务</a></div>
                   </div>
                   
               </div>
           </div> -->
           <div class="rightbox">
            
            <h2 class="mbx">我的信息 &gt; 我的异议</h2>
            <div class="morebt">
                

               
<ul id="ulStudMsgHeadTab">
    <li><a class="tab2" onclick="" href="/StudentManagerCenter/index.php/MyInfo/index/">个人资料</a> </li>
    <li><a class="tab2" onclick="" href="/StudentManagerCenter/index.php/MyInfo/classInfo/">班级信息</a></li>
    <li><a class="tab2" onclick="" href="/StudentManagerCenter/index.php/User/letter/">短信息</a></li>
    <li><a class="tab2" onclick="" href="/StudentManagerCenter/index.php/User/systemMsge/">通知<span style="color:#ff0000; padding-left:5px;" id="unreadSysMsgCount"></span></a></li>
    <li><a class="tab2" onclick="" href="/StudentManagerCenter/index.php/MyInfo/objection">我的异议</a></li>
</ul>

            </div>
            <div class="cztable">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <th style="text-align:center;" width="5%">序号</th>
                        <th style="text-align:center;" width="10%">类型</th>
                        <th width="15%">标题</th>
                        <th width="20%">内容</th>
                        <th style="text-align:center;" width="18%">添加时间</th>
                        <th style="text-align:center;" width="13%">状态</th>
                    </tr>
                    
                    <tr style="height: 28px" class="tdbg" align="center">
                        <td colspan="13" align="left" style="color: Red; font-weight:bold;">未找到异议信息!</td>
                    </tr>
                    
                </table>
            </div>

            

          </div>
        </div>
   
  </div>
</body>
</html>