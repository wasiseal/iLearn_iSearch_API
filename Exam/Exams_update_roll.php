<?php

   require_once("Exams_utility.php");
   require_once("../Problem/Problems_utility.php");

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
   $login_name = "Phantom";
   
   //query          
   $link;
   $db_host;
   $admin_account;
   $admin_password;
   $connect_db;
   $str_query;
   $str_query1;
   $result;                 //query result
   $result1;
   $row;                    //result data array
   $row1;
   $row_number;
   $refresh_str;

   header('Content-Type:text/html;charset=utf-8');

   //define
   define("DB_HOST", $db_host);
   define("ADMIN_ACCOUNT", $admin_account);
   define("ADMIN_PASSWORD", $admin_password);
   define("CONNECT_DB", $connect_db);
   define("TIME_ZONE", "Asia/Shanghai");
   define("ILLEGAL_CHAR", "'-;<>");                         //illegal char

   //return value
   define("DB_ERROR", -1);
   define("SYMBOL_ERROR", -3);
   define("SYMBOL_ERROR_CMD", -4);
   define("MAPPING_ERROR", -5);
   
   //timezone
   date_default_timezone_set(TIME_ZONE);

   //----- Check number -----
   function check_number($check_str)
   {
      if(!is_numeric($check_str))
      {
         return SYMBOL_ERROR;
      }
      if($check_str < 0)
      {
         return SYMBOL_ERROR;
      }
      return $check_str;
   }

   //get data from client
   $cmd;
   $UserId;

   //query
   $link;

   if (($exam_id = check_number($_POST["exam_id"])) == SYMBOL_ERROR)
   {
      sleep(DELAY_SEC);
      echo DB_ERROR;       
      return;
   }
   
   
   //link    
   $link = @mysqli_connect(DB_HOST, ADMIN_ACCOUNT, ADMIN_PASSWORD, CONNECT_DB);    
   if (!$link)  //connect to server failure    
   {
      sleep(DELAY_SEC);
      echo DB_ERROR;
      return;
   }

   $users_id = $_POST["users_id"];
   
   //select all current ids
   //if not exist in upload id,
   // set Status = -1

   //for all upload id
   //  if exist -> update status to 1
   //else
   //insert it
   
   function update_examroll_status($user_id, $exam_id, $status)
   {
      $link = @mysqli_connect(DB_HOST, ADMIN_ACCOUNT, ADMIN_PASSWORD, CONNECT_DB);
      if (!$link) 
      {   
         die(MSG_ERR_CONNECT_TO_DATABASE);
      }
      
      $str_query = "update examroll set Status=$status where ExamId=$exam_id AND UserId=$user_id";
      if(($result = mysqli_query($link, $str_query))){
         return SUCCESS;
      }
      else
      {
         return ERR_UPDATE_DATABASE;
      }
   }

   $str_query = "select * from examroll where ExamId=$exam_id";

   if($result = mysqli_query($link, $str_query)){
      $row_number = mysqli_num_rows($result);
      for ($i=0; $i<$row_number; $i++)
      {
         $row = mysqli_fetch_assoc($result);
         if (!in_array($row["UserId"], $users_id))
         {
            if (($ret = update_examroll_status($row["UserId"], $exam_id, INACTIVE)) != SUCCESS)
            {
               echo $ret;
               return;
            }
         }
         else
         {
            if (($ret = update_examroll_status($row["UserId"], $exam_id, ACTIVE)) != SUCCESS)
            {
               echo $ret;
               return;
            }
            if(($key = array_search($row["UserId"], $users_id)) !== false) {
               array_splice($users_id, $key, 1);
            }
         }
      }   
   }
   
   // left ids are all new ids, so just insert it
   foreach ($users_id as $user_id)
   {
      $str_query = "INSERT INTO examroll (ExamId,UserId,IsSubmit,Status) VALUES ($exam_id,$user_id,".NOT_SUBMIT.",".ACTIVE.")";
      if(!($result = mysqli_query($link, $str_query))){
         if($link){
            mysqli_close($link);
         }
         sleep(DELAY_SEC);
         echo -__LINE__;
         return;
      }      
   }
   
   echo SUCCESS;
   return;
?>