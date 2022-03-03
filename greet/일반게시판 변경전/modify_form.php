<? 
	session_start(); 
     @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
   //세션변수 4
    //num=7&page=1

	include "../lib/dbconn.php";

	$sql = "select * from greet where num=$num";
	$result = mysql_query($sql, $connect);

	$row = mysql_fetch_array($result);       	
	$item_subject     = $row[subject];
	$item_content     = $row[content];
?>

<!DOCTYPE html>
<html lang="en">
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

</head>
<body>
	<? include "../common/sub_header.html" ?>

	<div class="visual">
		<img src="../sub6/common/images/visual.jpg" alt="서브페이지_사업분야_비주얼">
		<h3>고객지원</h3>
	</div>

	<div class="sub_menu">
		<ul>
			<li class="current"><a href="./sub6_1.html">새소식</a></li>
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

		<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>"> 
				<div id="write_form">
					
					<div id="write_row1">
						<div class="col1"> 제목</div>
						<div class="col2"><input type="text" name="subject" value="<?=$item_subject?>"></div>
					</div>

					<div id="write_row2">
						<div class="col1"> 닉네임 </div>
						<div class="col2"><?=$usernick?></div>
					</div>
					
					<div id="write_row3">
						<div class="col1"> 내용   </div>
						<div class="col2"><textarea rows="15" cols="79" name="content"><?=$item_content?></textarea></div>
					</div>
				</div>
				<div id="write_button">
					<a href="list.php?page=<?=$page?>">목록</a>
					<input type="submit" value="확인">
				</div>
			</form>
		</div><!-- content_area -->
	</article>

	<? include "../common/sub_footer.html" ?>
</body>
</html>


