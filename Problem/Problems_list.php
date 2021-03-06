<?php 
   require_once("Problems_utility.php");
?>
<script type="text/javascript">
//***Step9 列表中的动作上架/下架Ajax呼叫
function actionSearchProbs(ProbId, Status)
{
   //ajax
   str = "cmd=actionProbs" + "&ProbId=" + ProbId + "&Status=" + Status;
   url_str = "Problem/Problems_action.php?";
   
   //alert(str);
   $('#loadingWrap').show();
   $.ajax
   ({
      beforeSend: function()
      {
         //alert(url_str + str);
      },
      type: 'GET',
      url: url_str + str,
      cache: false,
      success: function(res)
      {
         //alert(res);
         $('#loadingWrap').delay(D_LOADING).fadeOut('slow', function()
         {
            if (!res.match(/^-\d+$/))  //success
            {
               document.getElementsByName("searchProbsButton")[0].click();
            }
            else  //failed
            {  
               //echo "1.0";
               alert(MSG_SEARCH_ERROR);
            }
         });
      },
      error: function(xhr)
      {
         $('#loadingWrap').hide();
         alert("ajax error: " + xhr.status + " " + xhr.statusText);
      }
   });

}

//***Step10 列表中动作删除Ajax呼叫
function deleteSearchProbs(ProbId)
{
   ret = confirm("确定要删除此题目吗?");
   if (!ret)
      return;
   //ajax
   str = "cmd=deleteProbs" + "&" + "ProbId=" + ProbId;
   url_str = "Problem/Problems_delete.php?";
   
   //alert(str);
   $('#loadingWrap').show();
   $.ajax
   ({
      beforeSend: function()
      {
         //alert(url_str + str);
      },
      type: 'GET',
      url: url_str + str,
      cache: false,
      success: function(res)
      {
         //alert(res);
         $('#loadingWrap').delay(D_LOADING).fadeOut('slow', function()
         {
            if (!res.match(/^-\d+$/))  //success
            {
               document.getElementsByName("searchProbsButton")[0].click();
            }
            else  //failed
            {  
               //echo "1.0";
               $('#loadingWrap').hide();
               alert(MSG_SEARCH_ERROR);
            }
         });
      },
      error: function(xhr)
      {
         alert("ajax error: " + xhr.status + " " + xhr.statusText);
      }
   });
}

//***Step11 列表中动作修改Ajax长出修改页面
function modifySearchProbs(ProbId)
{
   str = "cmd=read&ProbId=" + ProbId;
   url_str = "Problem/Problems_modify.php?";
   window.open(url_str + str);
}

function clickSearchProbsPage(obj, n)  //搜尋換頁
{
   if (obj.className == "search_page active")
      return;
   nPage = document.getElementsByName("search_page_no")[0].value;
   document.getElementsByName("search_page_no")[0].value = n;
   str = "search_page_begin_no_" + nPage;
   document.getElementById(str).className = "search_page";
   str = "search_page_end_no_" + nPage;
   document.getElementById(str).className = "search_page";
   str = "search_page_begin_no_" + n;
   document.getElementById(str).className = "search_page active";
   str = "search_page_end_no_" + n;
   document.getElementById(str).className = "search_page active"; 
   
   //clear current table
   str = "search_page" + nPage;
   document.getElementById(str).style.display = "none";
   str = "search_page" + n;
   document.getElementById(str).style.display = "block";
}

//***Step13 新增页面点击保存按钮出发Ajax动作
function newSearchProbsContentFunc()
{
   url_str = "Problem/Problems_upload.php?";
   window.open(url_str);
}

//***Eric 是否可以 删除
function occurTimeDatePicker()
{
   datepicker();
}
</script>

<!--新增修改所跳出的 block 开始-->
<div id="searchProbsContent" class="blockUI" style="display:none;">
</div>
<!--新增修改所跳出的 block 结束--> 

<!--快速查詢 從這裡開始-->
   <div class="searchW">
   <!-- ***Step2 搜索框的设计 开始 -->
      <form>
         <table class="searchField" border="0" cellspacing="0" cellpadding="0">
            <tr>
               <th>题目描述或备注：</th>
               <td><input id="searchProbsDescMemo" type="text" maxlength="50"></td>
               <th>状态 ：</th>
               <td colspan="3">
                  <label><input id="searchProbsCheckBox1" type="checkbox" checked> 上架</label>
                  <label><input id="searchProbsCheckBox2" type="checkbox" checked> 下架</label>
               </td>
            </tr>
            <tr>
               <th>难易：</th>
               <td>
               <select id="searchProbsLevel">
                  <option value=<?php echo NO_LEVEL?>>無
                  <option value=<?php echo EASY_LEVEL?>>易
                  <option value=<?php echo MID_LEVEL?>>中
                  <option value=<?php echo HIGH_LEVEL?>>难
               <select>
               </td>
            </tr>
            <tr>
               <th colspan="4" class="submitBtns">
                  <a class="btn_submit_new searchProbs"><input name="searchProbsButton" type="button" value="开始查询"></a>
               </th>
            </tr>
         </table>
      </form>
      <!-- ***Step2 搜索框的设计 结束 -->
   
      <!-- ***Step3 表格框架 开始 -->
      <div id="sResultW" class="reportW" style="display:block;">
         <div id="searchProbsPages">
            <div class="toolMenu">
               <span align=right class="btn" OnClick="newSearchProbsContentFunc();">上传题库</span>
            </div>
            <table class="report" border="0" cellspacing="0" cellpadding="0">
               <colgroup>
                  <col class="num">
                  <col class="ProbType" />
                  <col class="ProbDesc" />
                  <col class="ProblLevel" />
                  <col class="ProbMemo" />
                  <col class="ProbStatus" />
                  <col class="ProbAction" />
               </colgroup>
               <tr>
                  <th>编号</th>
                  <th>类型</th>
                  <th>描述</th>
                  <th>难易</th>
                  <th>备注</th>
                  <th>状态</th>
                  <th>动作</th>
               </tr>
               <tr>
                  <td colspan="7" class="empty">请输入上方查询条件，并点选[开始查询]</td>
               </tr>
            </table>
            <div class="toolMenu">
               <span align=right class="btn" OnClick="newSearchProbsContentFunc();">上传题库</span>
            </div>
         </div>
      </div>
      <!-- search pages-->
   </div>
<!-- ***Step3 表格框架 结束 -->