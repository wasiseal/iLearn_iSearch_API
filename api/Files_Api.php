<?php
   if(is_array($_GET)&&count($_GET)>0){   //判断是否有Get参数
      if(isset($_GET["cid"])){
         $categoryid = $_GET["cid"];
      }
      else {
         echo json_encode(array("status"=>-2, "result"=>"分类夹下文件不存在！")); //-2没有传部门ID
         return; 
      }
   }
   else{
      echo json_encode(array("status"=>-1, "result"=>"分类夹下文件不存在！")); //-1没有传任何参数
      return;
   }
   define("FILE_NAME", "../DB.conf");
   define("DELAY_SEC", 3);
   define("FILE_ERROR", -2);
   
   if (file_exists(FILE_NAME))
   {
      include(FILE_NAME);
   }
   else
   {
      sleep(DELAY_SEC);
      echo FILE_ERROR;
      return;
   }
   
   header('Content-Type:application/json;charset=utf-8');
   
   //define
   define("DB_HOST", $db_host);
   define("ADMIN_ACCOUNT", $admin_account);
   define("ADMIN_PASSWORD", $admin_password);
   define("CONNECT_DB", $connect_db);
   define("TIME_ZONE", "Asia/Shanghai");
   define("ILLEGAL_CHAR", "'-;<>");                         //illegal char

   //return value
   define("SUCCESS", 0);
   define("DB_ERROR", -1);
   
   //timezone
   date_default_timezone_set(TIME_ZONE);      

   //query
   $link;
   $str_query;
   $str_update;
   $result;                 //query result
   $categorycount;
   
   //link    
   $link = @mysqli_connect(DB_HOST, ADMIN_ACCOUNT, ADMIN_PASSWORD, CONNECT_DB);    
   if (!$link)  //connect to server failure    
   {
      sleep(DELAY_SEC);
      echo DB_ERROR;       
      return;
   }
   
   $datafile = array();
   class Stucategory{
      public $Id;
      public $Name;
      public $Title;
      public $Desc;
      public $Path;
      public $PageNo;
      public $Type;
      public $Status;
      public $EditTime;
      public $CategoryId;
      public $ZipSize;
   }
   
   //----- query -----
   $str_file = "select FileId,FileName,FileTitle,FileDesc,FilePath,PageNo,FileType,Status,EditTime,CategoryId,ZipSize from files where CategoryId = $categoryid and Status in (0,1);";
   
   if($rs = mysqli_query($link, $str_file)){
      $filecount = mysqli_num_rows($rs);
      while($row = mysqli_fetch_assoc($rs)){      
         $sc = new Stucategory();
         $sc->Id = $row['FileId'];
         $sc->Name = $row['FileName'];
         $sc->Title = $row['FileTitle'];
         $sc->Desc = $row['FileDesc'];
         $sc->Path = $row['FilePath'];
         $sc->PageNo = $row['PageNo'];
         $sc->Type = $row['FileType'];
         $sc->Status = $row['Status'];
         $sc->EditTime = date("Y/m/d H:i:s",strtotime($row['EditTime']));
         $sc->CategoryId = $row['CategoryId'];
         $sc->ZipSize = $row['ZipSize'];
         array_push($datafile,$sc);
      }
      // mysqli_close($link);
      
      //$data = doSql('SELECT nodeID id,fid,nodeName text FROM mytable');
      //$bta = new BuildTreeArray($data,'id','fid',0);
      //$data = $bta->getTreeArray();
   }
   else
   {
      if($link){
         mysqli_close($link);
      }
      sleep(DELAY_SEC);
      // echo -__LINE__;
      echo json_encode(array("status"=> 0, "result"=>"分类夹下文件获取失败！")); 
      return;
   }
   
   mysqli_close($link);
   echo json_encode(array("status"=> 1, "count"=>$filecount, "data"=>$datafile, "result"=>""));      
   return;
?>