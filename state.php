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
}//正文开始
if(isset($_POST['local'])){
if($_POST['local']=='book_state'){
    if(isset($_POST['state'])&&isset($_POST['id'])&&isset($_POST['book_state']))
{
    try{
        include_once $_SERVER['DOCUMENT_ROOT'].'/jbk/includes/magicquotes.inc.php';
        include $_SERVER['DOCUMENT_ROOT'].'/jbk/includes/connect.inc.php';
        $sql='UPDATE lend_state SET state= :state  ,book_state=:book_state WHERE lend_id=:lend_id';
        $s=$pdo->prepare($sql);
        $s->bindValue(':lend_id',$_POST['id']);
        $s->bindValue(':state',$_POST['state']);
        $s->bindValue(':book_state',$_POST['book_state']);
        $s->execute();
    }
    catch(PDOException $e)
    {
        $output='更改状态失败：'.$e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'].'/jbk/includes/output.inc.php';
        exit();
    }
    header('Location: .');
    exit();
}
else {
    header('Location: .');
    exit();
}}
if($_POST['local']=='get_state'){
    if(isset($_POST['id'])&&isset($_POST['get_state']))
{
    if($_POST['get_state']=='0'){
        //设置学生违约
        //获取学生id
        try{
        include_once $_SERVER['DOCUMENT_ROOT'].'/jbk/includes/magicquotes.inc.php';
        include $_SERVER['DOCUMENT_ROOT'].'/jbk/includes/connect.inc.php';
        $lend_id=$_POST['id'];
        $sql="select student_id from lend_state where lend_id=:lend_id";
        $s=$pdo->prepare($sql);
        $s->bindValue(':lend_id',$lend_id);
        $s->execute();}
        catch(PDOException $e)
    {
        $output='查询学生失败：'.$e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'].'/jbk/includes/output.inc.php';
    }
     $row=$s->fetch();
        $student_id=$row[0];
    //设置违规
    try{
        include_once $_SERVER['DOCUMENT_ROOT'].'/jbk/includes/magicquotes.inc.php';
        include $_SERVER['DOCUMENT_ROOT'].'/jbk/includes/connect.inc.php';
       $sql = 'SELECT credit FROM student  WHERE id=:id';
       $s = $pdo->prepare($sql);
       $s->bindValue(':id', $student_id);
       $s->execute();
       $row = $s->fetch();
       $credit=$row['credit'];
       $credit++;
       $sql = 'UPDATE student SET credit=:credit  WHERE id=:id';
       $s = $pdo->prepare($sql);
       $s->bindValue(':id', $student_id);
       $s->bindValue(':credit',$credit);
       $s->execute();
   }
     catch(PDOException $e)
    {
        $output='设置违规失败：'.$e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'].'/jbk/includes/output.inc.php';
        exit();
    }
    }
    //修改取书状态
    try{
        include_once $_SERVER['DOCUMENT_ROOT'].'/jbk/includes/magicquotes.inc.php';
        include $_SERVER['DOCUMENT_ROOT'].'/jbk/includes/connect.inc.php';
        $sql='UPDATE lend_state SET get_state=:get_state WHERE lend_id=:lend_id';
        $s=$pdo->prepare($sql);
        $s->bindValue(':lend_id',$_POST['id']);
        $s->bindValue(':get_state',$_POST['get_state']);
        $s->execute();
    }
    catch(PDOException $e)
    {
        $output='更改状态失败：'.$e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'].'/jbk/includes/output.inc.php';
        exit();
    }
    header('Location: .');
    exit();
}
else {
    header('Location: .');
    exit();
}
}
}
