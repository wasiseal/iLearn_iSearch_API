<?php
   require_once("../Problem/Problems_utility.php");
   require_once("Exams_utility.php");
   
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

   header('Content-Type:text/html;charset=utf-8');
   
   //define
   define("DB_HOST", $db_host);
   define("ADMIN_ACCOUNT", $admin_account);
   define("ADMIN_PASSWORD", $admin_password);
   define("CONNECT_DB", $connect_db);
   define("TIME_ZONE", "Asia/Shanghai");
   define("ILLEGAL_CHAR", "'-;<>");                          //illegal char
   define("STR_LENGTH", 50);

   //return value
   define("DB_ERROR", -1);
   define("SYMBOL_ERROR", -3);
   define("SYMBOL_ERROR_CMD", -4);
   define("MAPPING_ERROR", -5);
   
   //timezone
   date_default_timezone_set(TIME_ZONE);

   //get data from client
   $cmd;
   $ProbName;
   $Status;

   //query
   $link;
   $str_query;
   $str_update;
   $result;                 //query result
   $row;                    //1 data array
   $return_string;
   //1.get information from client
   
   function check_number($check_str)
   {
      if ($check_str == "")
      {
         $check_str = 0;
      }
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

   $exam_name = $_POST["exam_name"];
   $from_timestamp = $_POST["from_timestamp"];
   $to_timestamp = $_POST["to_timestamp"];
   $expire_timestamp = $_POST["exam_expire_timestamp"];
   $exam_probs_id = $_POST["exam_probs_id"];
   $exam_content = $_POST["exam_content"];
   $exam_desc = $_POST["exam_desc"];
   $exam_password = $_POST["exam_password"];
   
   if (!isset($_POST["exam_functions_id"]))
   {
      $exam_functions_id = [];
   }
   else
   {
      $exam_functions_id = $_POST["exam_functions_id"];
   }
 
   if(($exam_status = check_number($_POST["exam_status"])) == SYMBOL_ERROR)
   {
      sleep(DELAY_SEC);
      echo SYMBOL_ERROR;
      return;
   }

   if(($exam_type = check_number($_POST["exam_type"])) == SYMBOL_ERROR)
   {
      sleep(DELAY_SEC);
      echo SYMBOL_ERROR;
      return;
   }
   
   if(($exam_answer_type = check_number($_POST["exam_answer_type"])) == SYMBOL_ERROR)
   {
      sleep(DELAY_SEC);
      echo SYMBOL_ERROR;
      return;
   }
   
   if(($exam_location = check_number($_POST["exam_location"])) == SYMBOL_ERROR)
   {
      sleep(DELAY_SEC);
      echo SYMBOL_ERROR;
      return;
   }
   
   // begin, end, expire time to datetime
   $sql_begin_datetime = timestamp_to_datetime($from_timestamp);
   $sql_end_datetime = timestamp_to_datetime($to_timestamp);
   $sql_expire_datetime = timestamp_to_datetime($expire_timestamp);
   // get all function name
   $functions_name = [];
   
   //link
   $link = @mysqli_connect(DB_HOST, ADMIN_ACCOUNT, ADMIN_PASSWORD, CONNECT_DB);    
   if (!$link)  //connect to server failure    
   {
      sleep(DELAY_SEC);
      echo DB_ERROR;       
      return;
   }   
   
   
   foreach ($exam_functions_id as $function_id)
   {
      $str_query = "select * from functions where FunctionId=$function_id";
      if($result = mysqli_query($link, $str_query))
      {
         $row = mysqli_fetch_assoc($result);
         array_push($functions_name, $row['FunctionName']);
      }
      else
      {
         if($link){
            mysqli_close($link);
         }
         sleep(DELAY_SEC);
         echo -__LINE__;
         return;
      }   
   }
   
   // ExamContent = exam_content + exam_selected_functions
   // yes_true,single,multi,easy,mid,hard, function name ...
   $exam_content = array_merge($exam_content, $functions_name);
   $exam_content_str;
   
   // yesno,singel,multi,easy,mid,high,function1,function2
   for ($i=0; $i<count($exam_content); $i++)
   {
      if ($i == 0)
      {
         $exam_content_str = $exam_content[$i];
      }
      else
      {
         $exam_content_str = $exam_content_str.",".$exam_content[$i];
      }
   }

   $str_query = <<<EOD
                INSERT INTO exams (ExamName,ExamType,ExamLocation,ExamBegin,ExamEnd,ExamAnsType,
                  ExamPassword,Status,ExamDesc,ExamContent,ExpireTime,CreatedUser,
                  CreatedTime,EditUser,EditTime) VALUES
                ('$exam_name',$exam_type,$exam_location,'$sql_begin_datetime','$sql_end_datetime',$exam_answer_type,
                 '$exam_password',$exam_status,'$exam_desc','$exam_content_str','$sql_expire_datetime',1,
                 now(),1,now())
EOD;
   
   if(!($result = mysqli_query($link, $str_query)))
   {
      if($link){
         mysqli_close($link);
      }
      sleep(DELAY_SEC);
      echo -__LINE__;
      return;
   }
   
   $str_query = "select * from exams where ExamName='$exam_name'";
   $exam_id;
   if($result = mysqli_query($link, $str_query))
   {
      $row = mysqli_fetch_assoc($result);
      $exam_id = $row["ExamId"];
   }
   else
   {
      if($link){
         mysqli_close($link);
      }
      sleep(DELAY_SEC);
      echo -__LINE__;
      return;
   }
 

   // construct the problems json array
   /*
     {
        “id”: 1, 
        “description”: “this is an example of 多選”,
        “level”: 1
        “type”: 3,
         “selectors”: [{“id”: “A”, “content”: “first option”}, {“id”: “B”, “content”: “second option”}, {“id”: “C”, ”content”: “third option”}, {“id”:”D”, content: ”fourth option”},]},
         “answer”: [A,B,C],
         “memo”: “題目答案的說明”
      }
   */
   $problems = array();
   
   foreach ($exam_probs_id as $prob_id)
   {
      $str_query = "select * from problems where ProblemId=$prob_id";
      if($result = mysqli_query($link, $str_query))
      {
         $row = mysqli_fetch_assoc($result);
      }
      else
      {
         if($link){
            mysqli_close($link);
         }
         sleep(DELAY_SEC);
         echo -__LINE__;
         return;
      }
      
      $selectors = array();
      if (!is_empty($row["ProblemSelectA"]))
      {
         array_push($selectors, array("id"=>"A", "content"=> $row["ProblemSelectA"]));
      }
      if (!is_empty($row["ProblemSelectB"]))
      {
         array_push($selectors, array("id"=>"B", "content"=> $row["ProblemSelectB"]));
      }
      if (!is_empty($row["ProblemSelectC"]))
      {
         array_push($selectors, array("id"=>"C", "content"=> $row["ProblemSelectC"]));
      }
      if (!is_empty($row["ProblemSelectD"]))
      {
         array_push($selectors, array("id"=>"D", "content"=> $row["ProblemSelectD"]));
      }
      if (!is_empty($row["ProblemSelectE"]))
      {
         array_push($selectors, array("id"=>"E", "content"=> $row["ProblemSelectE"]));
      }
      if (!is_empty($row["ProblemSelectF"]))
      {
         array_push($selectors, array("id"=>"F", "content"=> $row["ProblemSelectF"]));
      }
      if (!is_empty($row["ProblemSelectG"]))
      {
         array_push($selectors, array("id"=>"G", "content"=> $row["ProblemSelectG"]));
      }
      if (!is_empty($row["ProblemSelectH"]))
      {
         array_push($selectors, array("id"=>"H", "content"=> $row["ProblemSelectH"]));
      }
      if (!is_empty($row["ProblemSelectI"]))
      {
         array_push($selectors, array("id"=>"I", "content"=> $row["ProblemSelectI"]));
      }
      
      $answers = parse_answer($row["ProblemAnswer"]);
      
      
      array_push($problems, array(
                              "id"=> (int)$row["ProblemId"],
                              "description"=> $row["ProblemDesc"],
                              "level"=> (int)$row["ProblemLevel"],
                              "type"=> (int)$row["ProblemType"],
                              "selectors" => $selectors,
                              "answer" => $answers,
                              "memo"=> $row["ProblemMemo"],
                           )
      );
   }
   
   
   
   // save to json file, file_name id.json
   $json_file_name = EXAM_FILES_DIR."/".$exam_id.".json";
   $exam_json = json_encode(
      array(
         "exam_id" => (int)$exam_id,
         "exam_name" => $exam_name,
         "status" => (int)$exam_status,
         "type" => (int)$exam_type,
         "begin" => (int)$from_timestamp,
         "end" => (int)$to_timestamp,
         "expire_time" => (int)$expire_timestamp,
         "ans_type" => (int)$exam_answer_type,
         "description" => $exam_desc,
         "location" => (int)$exam_location,
         "password" => $exam_password,
         "questions" => $problems,
      )
   );

   file_put_contents($json_file_name, $exam_json);

   echo 0;
   return;
?>
