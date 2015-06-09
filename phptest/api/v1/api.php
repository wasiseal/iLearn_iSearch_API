<?
   require_once("utility.php");

   $request_method = $_SERVER["REQUEST_METHOD"];
   $request_uri = $_SERVER["REQUEST_URI"];
   $resource = explode(URI_START_WITH, $request_uri);
   array_shift($resource);


   if ($request_method == "GET")
   {
      $api_info = explode("/", $resource[0]);
      $api_name = $api_info[0];
      print_r($api_name);
      
      if ($api_name == "exam")
      {
         if (isset($api_info[1]))
         {
            $exam_id = $api_info[1];
            $exam_json_file_path = EXAM_JSON_FILE_DIR."/$exam_id.json";
            $download_file_name = $exam_id.".json";
            
            if (!file_exists($exam_json_file_path))
            {
               //header('Content-Type:text/html;charset=utf-8');
               echo(json_encode(array("message"=> "exam not found", "code"=> ERR_FILE_NOT_EXIST)));
               return;
            }

            // get exam json file 
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"$download_file_name\"");
            readfile($exam_json_file_path);          
         }
         else
         {
            echo json_encode(array("message"=> "invalid parameter", "code"=> ERR_INVALID_API));
            return;
         }
      }
   }
   else if ($request_method == "POST")
   {
      
   }

   
   
   //print_r($request_method);
   //$resource = array_shift($request_uri);
// parse uri

// according to url, choose the function

?>