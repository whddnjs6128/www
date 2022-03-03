<? 
	session_start(); 
     @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	include "../lib/dbconn.php";

	if ($mode=="modify") //수정 글쓰기면
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);

		$row = mysql_fetch_array($result);       
	
		$item_subject     = $row[subject];
		$item_content     = $row[content];

		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];
	}

?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>새소식</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link href="../common/css/common.css" rel="stylesheet">
	<link href="../sub6/common/css/sub6common.css" rel="stylesheet" >
    <link href="../sub6/css/sub6_content1.css" rel="stylesheet" >
	<link href="./css/list.css" rel="stylesheet">
	<link href="./css/write.css" rel="stylesheet">

	<script>
  function check_input()
   {
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!");    
          document.board_form.subject.focus();
          return;
      }

      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }
</script>

</head>
<body>
	<? include "../common/sub_header.html" ?>

	<div class="visual">
		<img src="../sub6/common/images/visual.jpg" alt="서브페이지_사업분야_비주얼">
		<h3>고객지원</h3>
	</div>

	<div class="sub_menu">
		<ul>
			<li class="current"><a href="./list.php">새소식</a></li>
			<li><a href="../sub6/sub6_2.html">상담안내</a></li>
			<li><a href="../sub6/sub6_3.html">온라인문의</a></li>
		</ul>
	</div>

	<article id="content">
		<div class="title_area">
			<div class="line_map">
				<i class="fas fa-home"></i> &gt; 고객지원 &gt; <strong>새소식</strong>
			</div>
			<h2>새소식</h2>
			<p><span>최근소식</span>과 동향을 알려드립니다.</p>

		</div>

		<div class="content_area">

		<?
	if($mode=="modify") // 수정글 쓰기
	{

?>
				<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>" enctype="multipart/form-data"> 
<?
	}
	else  //새글 쓰기
	{
?>
				<form  name="board_form" method="post" action="insert.php?table=<?=$table?>" enctype="multipart/form-data"> 
<?
	}
?>
				<div id="write_form">
					
					<div id="write_row1">
						<div class="col1"> 제목</div>
						<div class="col2"><input type="text" name="subject"  value="<?=$item_subject?>"></div>
					</div>

					<div id="write_row2">
						<div class="col1"> 닉네임 </div>
						<div class="col2"><?=$usernick?></div>
						<?
	if( $userid && ($mode != "modify") )
	{   //새글쓰기 에서만 HTML 쓰기가 보인다
?>
						<div class="col3"><input type="checkbox" name="html_ok" value="y"> HTML 쓰기</div>
<?
	}
?>	
					</div>
					
					<div id="write_row3">
						<div class="col1"> 내용   </div>
						<div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
					</div>

					<div id="write_row4"><div class="col1"> 이미지 파일 1   </div>
			                     <div class="col2"><input type="file" name="upfile[]"></div>
					</div>
					<? 	if ($mode=="modify" && $item_file_0)
	{
?>
			<div class="delete_ok"><?=$item_file_0?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0"> 삭제</div>
			<div class="clear"></div>
<?
	}
?>
			<div class="write_line"></div>
			<div id="write_row5"><div class="col1"> 이미지 파일 2  </div>
			                     <div class="col2"><input type="file" name="upfile[]"></div>
			</div>
<? 	if ($mode=="modify" && $item_file_1)
	{
?>
			<div class="delete_ok"><?=$item_file_1?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="1"> 삭제</div>
			<div class="clear"></div>
<?
	}
?>
			<div class="write_line"></div>
			<div class="clear"></div>
			<div id="write_row6"><div class="col1"> 이미지 파일 3   </div>
			                     <div class="col2"><input type="file" name="upfile[]"></div>
			</div>
<? 	if ($mode=="modify" && $item_file_2)
	{
?>
			<div class="delete_ok"><?=$item_file_2?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="2"> 삭제</div>
			<div class="clear"></div>
<?
	}
?>


				</div>
				<div id="write_button">
					<a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>
					<a href="javascript:void(0);" onclick="check_input()">확인</a>
				</div>
			</form>
		</div><!-- content_area -->
	</article>

	<? include "../common/sub_footer.html" ?>
</body>
</html>




