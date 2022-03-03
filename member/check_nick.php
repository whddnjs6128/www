<meta charset="utf-8">
<?
	//session_start();

   @extract($_POST);
   @extract($_GET);
   @extract($_SESSION);

   if(!$nick) 
   {
      echo("닉네임을 입력하세요.");
   }
   else
   {
      include "../lib/dbconn.php";
 
      $sql = "select * from member where nick='$nick' ";

      $result = mysql_query($sql, $connect);
      $num_record = mysql_num_rows($result);

      // $search_id ="select id from member where nick='$nick'";
      // $search_id_result = mysql_query($search_id, $connect);



      if ($num_record)
      {
         // if($_SESSION['userid']==$search_id_result)
         // {echo "<span style='color:blue'>현재 닉네임 입니다.</span>";}

            echo "<span style='color:red'>다른 닉네임을 사용하세요.</span>";

         
      }
      else
      {
         echo "<span style='color:green'>사용가능한 닉네입니다.</span>";
      }
		 
      mysql_close();
   }
?>

