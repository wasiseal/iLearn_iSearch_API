<?php
   define("SUCCESS", 0);
   
   define("INACTIVE", 0);
   define("ACTIVE", 1);
   
   define("NOT_SUBMIT", 0);
   define("SUBMIT", 1);

   define("ERR_NOT_ENOUGH_PROBLEM", -500);
   
   define("ERR_ADJUST_LEVEL", -1000);
   
   define("EXAM_FILES_DIR", "./Exam_files");
   define("EXAM_RESULT_FILES_DIR", "./Result_files");
   
   define("MSG_NOT_ENOUGH_TRUE_FALSE", "是非题数不足");
   define("MSG_NOT_ENOUGH_SEL_PROB", "单选题数不足");
   define("MSG_NOT_ENOUGH_MULTI_PROB", "多选题数不足");
   
   define("OLINE_TEST", 0);
   define("ONSITE_TEST", 1);

   class Problem
   {
      function __construct($id, $desc, $type, $level)
      {
         $this->id = $id;
         $this->desc = $desc;
         $this->type = $type;
         $this->level = $level;
      }

      public $id;
      public $desc;
      public $type;
      public $level;
   }
   
   class ExamDetail
   {
      /*
      error
      {
         "status":,
         "problems": [problem_obj, ...],
         "errors":[message, message..]
      }
      */
      
      function __construct(){}
 
      public $status = array();
      public $problems = array();
      public $errors = array();
   }
   
   
   function rand_select_problems($problems, $num)
   {
      $selected_problems = array();

      for ($i=0; $i<$num; $i++)
      {
         if(count($problems) == 0)
         {
            break;
         }
         else
         {
            $index = rand(0, count($problems)-1);
            array_push($selected_problems, $problems[$index]);
            array_splice($problems, $index, 1);
         }
      }

      return $selected_problems;
   }
   
   function add_one_level_and_remove_one_level($problems, &$selected_problems,
                                               $added_level, $removed_level)
   {
      $added_problems;
      
      foreach ($problems as $problem)
      {
         if($problem->level == $added_level && !is_in_problem_set($problem, $selected_problems))
         {
            $added_problems = $problem;

         }
      }
      
      if (isset($added_problem))
      {
         for ($i=0; $i<count($selected_problems); $i++)
         {
            if ($selected_problems[$i]->level == $removed_level)
            {
               array_splice($selected_problems, $i, 1);
               array_push($selected_problems, $added_problems);
               return SUCCESS;
            }
         }
      }

      return ERR_ADJUST_LEVEL;
   }
   
   function is_in_problem_set($problem, $selected_problems)
   {
      for($i=0; $i<count($selected_problems); $i++)
      {
         if ($problem->id == $selected_problems[$i])
         {
            return true;
         }
      }

      return false;
   }
   
   function timestamp_to_datetime($timestamp)
   {
      return date("Y-m-d H:i:s", $timestamp);
   }
   
   function is_empty($str)
   {
      if (!isset($str)) 
      {
         return true;
      }
      else if ($str == "")
      {
         return true;
      }

      return false;
   }
   
   function parse_answer($str)
   {
      $answers = array();

      for ($i=0; $i<strlen($str); $i++)
      {
         array_push($answers, $str[$i]);
      }

      return $answers;
   }
   
?>
