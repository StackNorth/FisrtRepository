<?php if (!defined('THINK_PATH')) exit();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>
	学生信息管理平台
</title>
    <link href="/StudentManagerCenter/Public/styles/StudentStyle.css" rel="stylesheet" type="text/css" />
    <link href="/StudentManagerCenter/Public/js/jBox/Skins/Blue/jbox.css" rel="stylesheet" type="text/css" />
    <link href="/StudentManagerCenter/Public/styles/ks.css" rel="stylesheet" type="text/css" />
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
                        window.location = "/Login.html";
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
    
<script type="text/javascript" language="javascript">

    function confirmStatus(pid, ptype) {
        if (confirm("确定确认无误吗？") == true) {
            financialInfor.modifyStudentPaymentStatus(pid, ptype, function (data) {
                var result = $.parseJSON(data);
                if ((String(result.ok) == "true")) {
                    jBox.alert(result.message, "提示");
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500);
                }
                else {
                    $.jBox.error(result.message, '提示');
                }
            });
        }
    }

    function submitObjection(pid) {
        var mtitle = "缴费有异议";
        var html = "<div style='padding:10px;'><div style='width:65px; height:120px; float:left;'>异议内容：</div><div style='width:250px; height:120px; float:left;'><textarea id='objeCont' name='objeCont' style='width:250px; height:105px;'></textarea></div></div>";

        var submit = function (v, h, f) {
            if (f.objeCont == '' || f.objeCont.length > 80) {
                $.jBox.tip("请您输入异议内容，且不超过80个字！", 'error', { focusId: "objeCont" }); // 关闭设置 objeCont 为焦点
                return false;
            }

            StudentCompain.insertCompain('', mtitle, 2, f.objeCont, function (data) {
                var obj = $.parseJSON(data);
                var resultObj = false;
                if (obj.ok) {
                    financialInfor.modifyStudentPaymentStatus(pid, 3, function (data) {
                        var result = $.parseJSON(data);
                        if ((String(result.ok) == "true")) {
                            jBox.alert("成功提交异议！", "提示");
                            setTimeout(function () {
                                window.location.reload();
                            }, 1500);
                        }
                        else {
                            jBox.tip("提交异议失败！");
                            return false;
                        }
                    });
                }
                else {
                    jBox.tip("提交异议失败！");
                }
            });
        };

        $.jBox(html, { title: "提交异议", submit: submit });
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
                     <a onclick="loginOut()" href="/StudentManagerCenter/index.php/Login/login">安全退出</a>
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

            <div class="rightbox">
                
<h2 class="mbx">教务中心 &gt; 我的财务</h2>
<div class="cztable">
    <div style="padding-bottom:20px;">
        <table border="0" cellspacing="0" cellpadding="0" width="100%">
            <tr align="center">
                <th width="20%">【邹智】总缴费统计 </th>
                <th>应缴费用 </th>
                <th>实缴费用 </th>
                
                <th>欠缴费用 </th>
                <th>缴费次数 </th>
            </tr>
            
            <tr>
                <td align="center" class="greenfont">&nbsp;</td>
                <td align="right" class="greenfont">
                    <span style="color: #FF0000; font-size: 16px; font-weight: bold;">
                        7800.00
                    </span>
                </td>
                <td align="right" class="greenfont">
                    <span style="color: #FF0000; font-size: 16px; font-weight: bold;">
                        3700.00
                    </span>
                </td>
                
                <td align="right" class="greenfont">
                    <span style="color: #FF0000; font-size: 16px; font-weight: bold;">
                        4100.00
                    </span>
                </td>
                <td align="right" class="greenfont">
                    <span style="color: #FF0000; font-size: 16px; font-weight: bold;">
                        4
                    </span>
                </td>
            </tr>
           
        </table>
    </div>
<div>
注：请仔细查看自己的缴费记录，如无误请点击“<span class="red">确定无误</span>”，如不正确请点击“<span class="red">有异议</span>”。 <br />
其中缴费项目缴费说明相同，相加后的起来对比。应缴总和=实缴总和+欠缴总和 <br />
    <div>
        <p>&nbsp;</p>
        <p><strong>欠费项目：</strong></p>
    </div>
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr align="center">
            <th>序号</th>
            <th>欠费项目</th>
            <th>应交金额</th>
            <th>已交金额</th>
            <th>欠交金额</th>
        </tr>


        <tr>
            <td style="text-align:center">
            <span style="color: #FF0000; font-size: 16px; font-weight: bold;">
            1
            </span>
            </td>
            <td>
            <span style="color: #FF0000;  font-size: 16px; font-weight: bold;">
            毕业工本费
            </span>
            </td>
            <td style="text-align:right">
            <span style="color: #FF0000;  font-size: 16px; font-weight: bold;">
            100.00
            </span>
            </td>
            <td style="text-align:right">
            <span style="color: #FF0000;  font-size: 16px; font-weight: bold;">
            0.00
            </span>
            </td>
            <td style="text-align:right">
            <span style="color: #FF0000;  font-size: 16px; font-weight: bold;">
            100.00
            </span>
            </td>
        </tr>


        <tr>
            <td style="text-align:center">
            <span style="color: #FF0000; font-size: 16px; font-weight: bold;">
            2
            </span>
            </td>
            <td>
            <span style="color: #FF0000;  font-size: 16px; font-weight: bold;">
            论文答辩费
            </span>
            </td>
            <td style="text-align:right">
            <span style="color: #FF0000;  font-size: 16px; font-weight: bold;">
            300.00
            </span>
            </td>
            <td style="text-align:right">
            <span style="color: #FF0000;  font-size: 16px; font-weight: bold;">
            0.00
            </span>
            </td>
            <td style="text-align:right">
            <span style="color: #FF0000;  font-size: 16px; font-weight: bold;">
            300.00
            </span>
            </td>
        </tr>


        <tr>
            <td style="text-align:center">
            <span style="color: #FF0000; font-size: 16px; font-weight: bold;">
            3
            </span>
            </td>
            <td>
            <span style="color: #FF0000;  font-size: 16px; font-weight: bold;">
            第二年学费、教材费、学杂费
            </span>
            </td>
            <td style="text-align:right">
            <span style="color: #FF0000;  font-size: 16px; font-weight: bold;">
            3700.00
            </span>
            </td>
            <td style="text-align:right">
            <span style="color: #FF0000;  font-size: 16px; font-weight: bold;">
            0.00
            </span>
            </td>
            <td style="text-align:right">
            <span style="color: #FF0000;  font-size: 16px; font-weight: bold;">
            3700.00
            </span>
            </td>
        </tr>


    </table>

    <div>
        <p>&nbsp;</p>
        <p><strong>自考缴费：</strong></p>
    </div>
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr align="center">
            <th>序号</th>
            <th>交费项目</th>
            <th>交费金额</th>
            
            <th>交费时间</th>
            <th>操作</th>
        </tr>


        <tr>
            <td style="text-align:center">1</td>
            <td>毕业工本费</td>
            <td>0.00</td>
            
            <td>2013-12-20 04:47</td>
            <td>

                        
                           <a href="javascript:;" onclick="confirmStatus('95c4b378-6de2-41f6-a2cf-6b0e27b562f3', 2)">[确认无误]</a> &nbsp; &nbsp;
                <a href="javascript:;" onclick="submitObjection('95c4b378-6de2-41f6-a2cf-6b0e27b562f3')">[有异议]</a>
                
            </td>
        </tr>
   
    
        <tr>
            <td style="text-align:center">2</td>
            <td>论文答辩费</td>
            <td>0.00</td>
            
            <td>2013-12-20 04:47</td>
            <td>

                        
                           <a href="javascript:;" onclick="confirmStatus('4073419c-5dfc-4629-9379-7cecc7e61200', 2)">[确认无误]</a> &nbsp; &nbsp;
                <a href="javascript:;" onclick="submitObjection('4073419c-5dfc-4629-9379-7cecc7e61200')">[有异议]</a>
                
            </td>
        </tr>
   
    
        <tr>
            <td style="text-align:center">3</td>
            <td>第二年学费、教材费、学杂费</td>
            <td>0.00</td>
            
            <td>2013-12-20 04:47</td>
            <td>

                        
                           <a href="javascript:;" onclick="confirmStatus('bb91b039-004b-4da6-b765-012d19b205f1', 2)">[确认无误]</a> &nbsp; &nbsp;
                <a href="javascript:;" onclick="submitObjection('bb91b039-004b-4da6-b765-012d19b205f1')">[有异议]</a>
                
            </td>
        </tr>
   
    
        <tr>
            <td style="text-align:center">4</td>
            <td>第一年学费、教材费、学杂费</td>
            <td>3700.00</td>
            
            <td>2013-12-20 04:47</td>
            <td>

                        
                               <font color="#008000">已审核</font>
                               
            </td>
        </tr>
   
    
    </table>
</div>
</div>

            </div>
        </div>
        <div class="footer">
            <p>
                &copy;copyright 2012 广博教育 csgb.net 版权所有 站长统计</p>
        </div>
    </div>
</body>
</html>