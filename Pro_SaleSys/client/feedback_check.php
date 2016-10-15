<?php
session_start();
require_once 'ComplaintMassage.php';
require_once 'mysql_tool.php';
  
//检查图片
if($_FILES['file']['error'] > 0 && $_FILES['file']['error']!=4){ 
   echo '!problem:'; 
   switch($_FILES['file']['error']) 
   { 
     case 1: echo '文件大小超过服务器限制'; 
             break; 
     case 2: echo '文件太大！'; 
             break; 
     case 3: echo '文件只加载了一部分！'; 
             break; 
   } 

   exit; 
} 
if($_FILES['file']['error'] <= 0 ){
if($_FILES['file']['size'] > 1000000){ 
   echo '文件过大！'; 
   exit; 
} 
if($_FILES['file']['type']!='image/jpeg' && $_FILES['file']['type']!='image/gif'){ 
   echo '文件不是JPG或者GIF图片！'; 
   exit; 
} 
$today = date("YmdHis"); 
$filetype = $_FILES['file']['type']; 
if($filetype == 'image/jpeg'){ 
  $type = '.jpg'; 
} 
if($filetype == 'image/gif'){ 
  $type = '.gif'; 
} 
$file_name= $_SESSION['account'].'_' . $today . $type;//$_SESSION['account'].'_' .
$upfile = 'upfile/'.$file_name; 
}

/*********开始处理提交的数据***********/
$complaint=new ComplaintMassage;
$complaint->setFeedBackDate($_POST['feed_back_date']);
$complaint->setClientName($_POST['client_name']);
$complaint->setProblemType($_POST['problem_type']);
$complaint->setParents($_POST['juan_zhi_id']);
$complaint->setContacter($_POST['contacter']);
$complaint->setContactNumber($_POST['contact_number']);
$complaint->setGuiGe($_POST['gui_ge']);
$complaint->setDingLiang($_POST['ding_liang']);
$complaint->setProblemDescription($_POST['problem_description']);
$complaint->setClientDemmand($_POST['client_demmand']);
if($_FILES['file']['error'] <=0){
  $complaint->setFile($file_name);
}
$complaint->setFeedbacker($_POST['feedbacker']);
$mysqlTool=new MysqlTool;
$tag=$mysqlTool->addComplaint($complaint);
// if($tag==false){
if(!$tag){  
  echo $tag;
  echo '<h1 style="color:ff0000">提交失败！</h1><br>';  
  echo '<a href="feedback.php">点此返回</a>';  
}else{
  if($_FILES['file']['error'] <= 0 ){
    if(is_uploaded_file($_FILES['file']['tmp_name'])) 
    { 
      if(!move_uploaded_file($_FILES['file']['tmp_name'], $upfile)) 
      { 
        echo '移动文件失败！'; 
        exit; 
      } 
    } 
    else 
    { 
      echo 'problem!'; 
      exit; 
    } 
  }
  echo '<h1>提交成功！</h1><br>';  
  echo '<a href="feedback.php">点此返回</a>'; 
}
  
?>
