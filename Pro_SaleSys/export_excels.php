<?php
session_start();
if(isset($_SESSION['account'])){

	require_once 'mysql_tool.php';
	require_once 'excel_tool/PHPExcel.php';
	//********************************************************************
	if(isset($_GET['ids'])){
		// header("Content-Type: application/force-download");
		// header("Content-type:application/vnd.ms-excel");
		// header("Content-Disposition:filename=test.xls");
		
		$ids = $_GET['ids'];
		$ids = explode(",", $ids); 
		$mysqlTool=new MysqlTool;
		$complaints=$mysqlTool->getComplaintByIds($ids);
		
		ceateExcel($complaints);
		$filename = "compressed/".time() . ".zip"; //"./" . date ( 'YmdH' )
		$zip=new ZipArchive();
		if($zip->open($filename, ZipArchive::CREATE)=== TRUE){  
			
 			addFileToZip('compress/', $zip); //调用方法，对要打包的根目录进行操作，并将ZipArchive的对象传递给方法   
 			$zip->close(); //关闭处理的zip文件
 			
 			header ( "Cache-Control: max-age=0" );
			header ( "Content-Description: File Transfer" );
			header ( 'Content-disposition: attachment; filename=' . basename ( $filename ) ); // 文件名
			header ( "Content-Type: application/zip" ); // zip格式的
			header ( "Content-Transfer-Encoding: binary" ); // 告诉浏览器，这是二进制文件
			header ( 'Content-Length: ' . filesize ( $filename ) ); // 告诉浏览器，文件大小
			@readfile ( $filename );//输出文件;
			delFile (  "compress/" );
			delFile("compressed/");
			//delFile("E:\PHP_WorkPlace\Apache24\Pro_SaleSys");
		}else{
			exit('创建文件失败');
		}
		
		// export($complaints[0]);
	}
}
else{
	header("Location:manage_login.php");
}
	// //**************************************************************************
	function addFileToZip($path,$zip){    
		$handler=opendir($path); 
		//打开当前文件夹由$path指定。   
		while(($filename=readdir($handler))!==false){      
			if($filename != "." && $filename != ".."){//文件夹文件名字为'.'和‘..’，不要对他们进行操作  
		    	if(is_dir($path."/".$filename)){// 如果读取的某个对象是文件夹，则递归                
		    		addFileToZip($path."/".$filename, $zip); 
		    		break;           
		    	}else{ //将文件加入zip对象
		    		if(strpos($path,'DATA') >=0)    //使用绝对等于
                    	$zip->addFile($path."/".$filename);            
		    	}        
			}    
		}    
		@closedir($path);
	}
	function ceateExcel($complaints){
		// if($complaint->getId()!=null){
	 	//创建一个读Excel模版的对象
 		$filename = time ();
 		//获取当前活动的表
 		for($i=0;$i<count($complaints);$i++){
 		$objReader = PHPExcel_IOFactory::createReader ( 'Excel5' );
 		$objPHPExcel = $objReader->load ("template.xls" );
 		$complaint=$complaints[$i];
 		// $objPHPExcel->setActiveSheetIndex($i);
 		// $objPHPExcel->createSheet();
 		
 		$objActSheet = $objPHPExcel->getActiveSheet ();
 		//现在就开始填充数据了 （从数据库中） $data
 		$data=$complaint;
 		//将数据填充到相对应的位置
 		$objPHPExcel->getActiveSheet ()->setCellValue ( 'B1' , $complaint->getFeedBackDate()); //学员编号
 		$objPHPExcel->getActiveSheet ()->setCellValue ( 'B2' , $complaint->getClientName() ); //真实姓名
 		$objPHPExcel->getActiveSheet ()->setCellValue ( 'B3' , $complaint->getContacter() );
 		$objPHPExcel->getActiveSheet ()->setCellValue ( 'B4' , $complaint->getProblemType() );
 		$objPHPExcel->getActiveSheet ()->setCellValue ( 'B5' , $complaint->getGuiGe() );
 		$objPHPExcel->getActiveSheet ()->setCellValue ( 'B6' , $complaint->getProblemDescription());
 		$objPHPExcel->getActiveSheet ()->setCellValue ( 'B7' , $complaint->getClientDemmand() );
 		$objPHPExcel->getActiveSheet ()->setCellValue ( 'D1' , $complaint->getFeedbacker() );
 		$objPHPExcel->getActiveSheet ()->setCellValue ( 'D3' , $complaint->getContactNumber() );
 		$objPHPExcel->getActiveSheet ()->setCellValue ( 'D4' , $complaint->getParents() );
 		$objPHPExcel->getActiveSheet ()->setCellValue ( 'D5' , $complaint->getDingLiang() );
 		//$objPHPExcel->getActiveSheet ()->setCellValue ( 'B8' , $complaint->getClientName() );
 		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName($complaint->getFile());
		$objDrawing->setDescription($complaint->getFile());
		$objDrawing->setPath('client/upfile/'.$complaint->getFile());
		$objDrawing->setHeight(120);
		$objDrawing->setWidth(120);
		$objDrawing->setCoordinates('B8');
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
 		//导出
 		
 		//在客户端下载
 		// header ( 'Content-Type: application/vnd.ms-excel' );
 		// header ( 'Content-Disposition: attachment;filename="' . $filename . '.xls"' ); //"'.$filename.'.xls"
 		// header ( 'Cache-Control: max-age=0' );
 		//保存在服务器
 		$objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' ); //在内存中准备一个excel2003文件
 		// $objWriter->save ( 'php://output' );	
 		$objWriter->save('compress/'.$filename.$i.'.xls');
 		// }
 		}


	}
	function delFile($dirName){
    	if(file_exists($dirName) && $handle=opendir($dirName)){
        	while(false!==($item = readdir($handle))){
            	if($item!= "." && $item != ".."){
                	unlink($dirName.'/'.$item);
            	}
        	}
        	closedir( $handle);
    	}
	}


?>


 