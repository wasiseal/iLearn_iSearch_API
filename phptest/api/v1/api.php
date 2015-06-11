<?
   require_once("utility.php");
   require_once("../../Exam/Exams_utility.php");
   require_once("../../Problem/Problems_utility.php");

   define("FILE_NAME", "d:/phptest/DB.conf");
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
   
   
   $request_method = $_SERVER["REQUEST_METHOD"];
   $request_uri = $_SERVER["REQUEST_URI"];
   $resource = explode(URI_START_WITH, $request_uri);
   array_shift($resource);


   if ($request_method == "GET")
   {
      // /exam/{exam_id}, download the exam json file
      if (preg_match("/exam\/([0-9]+)/", $resource[0], $matches))
      {
         $exam_id = $matches[1];
         $exam_json_file_path = EXAM_JSON_FILE_DIR."/$exam_id.json";
         $download_file_name = $exam_id.".json";
         
         if (!file_exists($exam_json_file_path))
         {
           //header('Content-Type:text/html;charset=utf-8');
           http_response_code(404);
           echo(json_encode(array("message"=> "exam not found", "code"=> ERR_FILE_NOT_EXIST)));
           return;
         }
         // get exam json file
         header("Content-type: application/octet-stream");
         header("Content-Disposition: attachment; filename=\"$download_file_name\"");
         readfile($exam_json_file_path);
      }
      // /user/{user_id}/exam, list all exams related to this user
      else if (preg_match("/user\/([0-9]+)\/exam/", $resource[0], $matches))
      {
         $exams_info = array();
         
         $user_id = $matches[1];

         $link = @mysqli_connect(DB_HOST, ADMIN_ACCOUNT, ADMIN_PASSWORD, CONNECT_DB);    
         if (!$link)  //connect to server failure    
         {
            sleep(DELAY_SEC);
            echo DB_ERROR;
            return;
         }
         
         // get active exam list related to this user
         // for each exam, get exam info, and added IsSubmit info
         $str_query = "select * from examroll where UserId=$user_id AND Status=".ACTIVE;
         if($result = mysqli_query($link, $str_query)){
            $row_number = mysqli_num_rows($result);
            for ($i=0; $i<$row_number; $i++)
            {
               //get exam info
               $row = mysqli_fetch_assoc($result);
               array_push($exams_info, get_exam_info($row["ExamId"], $row["IsSubmit"]));
            }   
         }
   
         echo json_encode(array("exams"=>$exams_info));
         return;
      }
      else
      {
         http_response_code(400);
         echo json_encode(array("message"=> "invalid parameter", "code"=> ERR_INVALID_API));
         return;
      }
     
      

   }
   else if ($request_method == "PUT")
   {
      // upload result
      if (preg_match("/user\/([0-9]+)\/result\/([0-9]+)/", $resource[0], $matches))
      {
         $user_id = $matches[1];
         $exam_id = $matches[2];
         $putdata = fopen("php://input", "r");
         // check user exist
         // check exam id exist
 
         $tmp_file_path = EXAM_RESULT_FILES_DIR."/".time().hash('md5', $user_id).".json";
         $file_path = EXAM_RESULT_FILES_DIR."/".$exam_id."_".$user_id.".json";
         $fp = fopen($tmp_file_path, "w");
         
         
         //check putdata status
         
         
         while($data = fread($putdata, 4*1024*1024))
         {
            // get index of Content-Type: application/octet-stream\n\n
            $start = strpos($data, "Content-Type: application/octet-stream\r\n");
            $content_start = strpos($data, "{", $start);
            //echo $content_start;
            
            if (($end = strpos($data, "\r\n", $content_start)) == 0) {
               if (($end = strpos($data, "\n", $content_start)) == 0) {
                  // error
                  // return
               }
            }
               
            $content_length = $end - $content_start;   
            $content = substr($data, $content_start, $content_length);
            
            // and get index of next \n
            // fwrite the data 
            fwrite($fp, $content);
         } 
         fclose($fp);
         fclose($putdata);
         
         // read file and check the result
         // 
         
 
         // return success
         
      }
      else
      {
         http_response_code(400);
         echo json_encode(array("message"=> "invalid parameter", "code"=> ERR_INVALID_API));
         return;
      }
   }

   
   function get_exam_info($exam_id, $is_submit)
   {
      $exam_info = array();
      
      $link = @mysqli_connect(DB_HOST, ADMIN_ACCOUNT, ADMIN_PASSWORD, CONNECT_DB);
      if (!$link) 
      {   
         die(MSG_ERR_CONNECT_TO_DATABASE);
      }
      
      $str_query = "select * from exams where ExamId=$exam_id";
      if($result = mysqli_query($link, $str_query)){
         $row = mysqli_fetch_assoc($result);
         $exam_info = array("exam_id"=>$row["ExamId"],
                            "exam_name"=>$row["ExamName"],
                            "submit"=>$is_submit,
                            "status"=>$row["Status"],
                            "type"=>$row["ExamType"],
                            "begin"=>$row["ExamBegin"],
                            "end"=>$row["ExamEnd"],
                            "expire_time"=>$row["ExpireTime"],
                            "ans_type"=>$row["ExamAnsType"],
                            "description"=>$row["ExamDesc"],
                            "location"=>$row["ExamLocation"],
                            "pwd"=>$row["ExamPassword"]);
      }
      return $exam_info;
   }
   
   
   //print_r($request_method);
   //$resource = array_shift($request_uri);
   // parse uri

   // according to url, choose the function

?>