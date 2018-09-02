<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/jbk/includes/magicquotes.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/jbk/includes/access.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/jbk/includes/connect.inc.php';
include $_SERVER['DOCUMENT_ROOT'] . '/jbk/includes/main.php';
if (! userIsLoggedIn()) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/jbk/includes/login.html.php';
    exit();
}
if (!userHasRole('teacher')) {
    $error='您没有权限访问此页面';
    include $_SERVER['DOCUMENT_ROOT'] . '/jbk/includes/accessdenied.html.php';
    exit();
}
if (userHasRole('teacher')) {
        /* $nowtime=date("Y-m-d H:i:s", time()+6*60*60);//由于时区不同导致的误差，需加以矫正
        $today_unix=strtotime(date("Y-m-d H:i:s", time()+6*60*60))-strtotime(date("H:i:s", time()+6*60*60))+strtotime("15:00:00");
        $yesterday_unix=strtotime(date("Y-m-d H:i:s", time()-24*60*60))-strtotime(date("H:i:s", time()-24*60*60))+strtotime("15:00:00");
        $today=date("Y-m-d H:i:s",$today_unix);
        $yesterday=date("Y-m-d H:i:s",$yesterday_unix);
     $placeholders=array();
    $sql = "SELECT lend_inf.id,state,number,datetime,ISBN,name,bookname,location,bookshel FROM lend_inf INNER JOIN lend_state ON lend_inf.id=lend_id INNER JOIN student ON student_id=student.id WHERE datetime<=:today AND state='未处理'";
    $placeholders[':today']=$today;
    //$placeholders[':yesterday']=$yesterday;
    $role='student';//要看学生的留言
    $lend_infs=lend_infs($sql,$placeholders,$role);
    //收集已处理的请求
    $sql="SELECT lend_inf.id,get_state,number,datetime,ISBN,name,bookname,location,bookshel FROM lend_inf INNER JOIN lend_state ON lend_inf.id=lend_id INNER JOIN student ON student_id=student.id WHERE book_state='1'";
    $lend_infs_get=lend_infs_get($sql,$role);
    //
    if(isset($_POST['action'])and $_POST['action']=='导出到word并打印'){
            include 'downword.php';
            exit();
        }
            include 'admin.html.php';*/
        header("Location:./order/");
        exit();
    }