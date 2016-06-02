<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎登录学生管理系统</title>
<link href="/StudentManagerCenter/Public/styles/style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="/StudentManagerCenter/Public/js/jquery.js"></script>
<script src="/StudentManagerCenter/Public/js/cloud.js" type="text/javascript"></script>
<script src="/StudentManagerCenter/Public/js/jquery-1.11.2.min.js" type="text/javascript" ></script>
<script language="javascript">
	$(function(){
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
	$(window).resize(function(){  
    $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
    })  
});  
</script> 

</head>

<body style="background-color:#1c77ac; background-image:url(/StudentManagerCenter/Public/images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">



    <div id="mainBody">
      <div id="cloud1" class="cloud"></div>
      <div id="cloud2" class="cloud"></div>
    </div>  


<div class="logintop">    
    <span>欢迎登录学生管理系统</span>    
       
    </div>
    
    <div class="loginbody">
    
    <span class="systemlogo"></span> 
       
    <div class="loginbox">
    
    <ul>
    <form action="" method="post">
        <table>
            <tr>
                <td>学号</td>
                <td><input name="stu_num" type="text"  /></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input name="stu_psw" type="password"   /></td>
            </tr>
            <tr>
                <td>验证码</td>
                <td><input type="text" name="captcha" id="captcha"/>
                <td id="checkPac"> <input type="hidden" name="a" id="a" value="0"/></td>
                

            </tr>
            <tr>
                <td colspan="2"><img src="/StudentManagerCenter/index.php/Login/code" alt="CAPTCHA" border="0" onclick= this.src="/StudentManagerCenter/index.php/Login/code/"+Math.random() style="cursor: pointer;" title="看不清？点击更换另一个验证码。" />
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" class="loginbtn" value="登录" onclick="return judge();" /></td>
            </tr>
            <tr>
                <td colspan="2"><font size="4" color="red"><?php echo ($error); ?></font></td>
            </tr>

        </table>      
    </form>
    
    </ul>
    
    
    </div>
    
    </div>
    
    
    
    <div class="loginbm">版权所有   仅供学习交流，勿用于任何商业用途</div>
</body>


<script language="javascript">

     function judge(){
      
        var str = document.getElementById('a').value;
       
       
        if (str == 0) {
            alert("请输入验证码");
            return false;
        } else if(str == 2 ){
            alert("验证码输入错误，请重新输入");
            return false;

        } 
        return true;

    }

    $("#captcha").change(function(){
        
        var captcha = this.value;
        $.ajax({

            type : 'GET',
            url : '/StudentManagerCenter/index.php/Login/checkPac/',
            data : 'captcha='+captcha,
            dataType : 'html',
            success : function(msg){    
                $("#checkPac").html(msg);
            },
            error : function(){
                alert("出错!");
            }
        });

        


    });
</script> 
</html>