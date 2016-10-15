<?php
 include('PHPExcel.php');
 //这些数据假设是从M('xxx')->select()里面出来的
 $data = array (
 array ('id' => 1, 'name' => '张三' ), array ('id' => 2, 'name' => '李四' ), array ('id' => 3, 'name' => '王五' ) );
 //PHPExcel支持读模版 所以我还是比较喜欢先做好一个Excel的模版  比较好，不然要写很多代码  模版我放在根目录了
 //创建一个读Excel模版的对象
 $objReader = PHPExcel_IOFactory::createReader ( 'Excel5' );
 $objPHPExcel = $objReader->load ("template.xls" );
 //获取当前活动的表
 $objActSheet = $objPHPExcel->getActiveSheet ();
 $objActSheet->setTitle ( '演示工作表' );
 $objActSheet->setCellValue ( 'A1', '这个是PHPExcel演示标题' );
 $objActSheet->setCellValue ( 'A2', '日期：' . date ( 'Y年m月d日', time () ));
 $objActSheet->setCellValue ( 'F2', '导出时间：' . date ( 'H:i:s' ) );
 //我现在就开始输出列头了
 $objActSheet->setCellValue ( 'A3', '序号' );
 $objActSheet->setCellValue ( 'B3', '姓名' );
 //具体有多少列 看你的数据走  会涉及到计算
 //现在就开始填充数据了  （从数据库中）  $data
 $baseRow = 4; //数据从N-1行开始往下输出  这里是避免头信息被覆盖
 foreach ( $data as $r => $dataRow ) {
 	$row = $baseRow + $r;
 	//将数据填充到相对应的位置
 	$objPHPExcel->getActiveSheet ()->setCellValue ( 'A' . $row, $dataRow ['id'] ); //学员编号
 	$objPHPExcel->getActiveSheet ()->setCellValue ( 'B' . $row, $dataRow ['name'] ); //真实姓名
 }
 //导出
 $filename = time ();
 header ( 'Content-Type: application/vnd.ms-excel' );
 header ( 'Content-Disposition: attachment;filename="' . $filename . '.xls"' ); //"'.$filename.'.xls"
 header ( 'Cache-Control: max-age=0' );
 $objWriter = PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' ); //在内存中准备一个excel2003文件
 $objWriter->save ( 'php://output' );
 ?>
 