<? 
	session_start(); 
     @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

    //세션변수
    //view.php?num=7&page=1

	include "../lib/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];


	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];


    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}	

	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i]) //업로드한 파일이 존재하면 0 1 2
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
            //GetImageSize(서버에 업로드된 파일 경로 파일명)
              // => 파일의 너비와 높이값, 종류
			$image_width[$i] = $imageinfo[0];  //파일너비
			$image_height[$i] = $imageinfo[1]; //파일높이
			$image_type[$i]  = $imageinfo[2];  //파일종류

        if ($image_width[$i] > 1160) // 레이아웃 너비 
				$image_width[$i] = 1160;
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}

	$new_hit = $item_hit + 1;

	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>


<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>동아ST제품</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link href="../common/css/common.css" rel="stylesheet">
	<link href="../sub2/common/css/sub2common.css" rel="stylesheet" >
    <link href="../sub2/css/sub2_content1.css" rel="stylesheet" >
	<link href="./css/list.css" rel="stylesheet">
	<link href="./css/view.css" rel="stylesheet">


	<script>
    function del(href) 
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    }
</script>

</head>
<body>
	<? include "../common/sub_header.html" ?>

	<div class="visual">
            <img src="../sub2/common/images/visual.jpg" alt="서브페이지_사업분야_비주얼">
            <h3>사업분야</h3>
        </div>


        <div class="sub_menu">
            <ul>
                <li class="current"><a href="./list.php">동아ST제품</a></li>
                <li><a href="../sub2/sub2_2.html">사업소개</a></li>
                <li><a href="../sub2/sub2_3.html">제품FAQ</a></li>
            </ul>
        </div>

	<article id="content">
		<div class="title_area">
			<div class="line_map">
				<i class="fas fa-home"></i> &gt; 사업분야 &gt; <strong>동아ST제품</strong>
			</div>
			<h2>동아ST 제품</h2>
			<p>혁신적 의약품 생산기업,<span> 동아ST</span>만의 신제품을 소개합니다.</p>
		</div>

		<div class="content_area">

		<div id="view_title">
			<div id="view_title1"><?= $item_subject ?></div>
			<!-- <div id="view_title2">
				<ul>
					<li><span class="hidden">관리자 아이콘</span><i class="fas fa-user" aria-hidden="true"></i> &nbsp;<?= $item_nick ?> </li>
					<li>조회 : <?= $item_hit ?> &nbsp;&nbsp;<?= $item_date ?></li>
				</ul>

			</div>	 -->
		</div>

		<div id="view_content">
<?
	for ($i=0; $i<3; $i++)  //업로드된 이미지를 출력한다
	{
		if ($image_copied[$i])
		{
			$img_name = $image_copied[$i];
			$img_name = "./data/".$img_name; 
             // ./data/2019_03_22_10_07_15_0.jpg
			$img_width = $image_width[$i];
			
			echo 
			"
				<div class='img_box'>
				<img src='$img_name' width='$img_width'>
				</div>
			"."<br><br>";
		}
	}
?>
			<div class="content_txt">
				<?= $item_content ?>
			</div>
		</div>

		<div id="view_button">
			<a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>
<? 
	if($userid==$item_id || $userlevel==1 || $userid=="admin") // 글의 아이디가 같거나 관리자 계정으로 볼때
	{
?>
				<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">수정</a>
				<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')">삭제</a>
<?
	}
?>
<? 
	if($userid )  //로인인이 되면 글쓰기 버튼이 보여라
	{
?>
				<a href="write_form.php?table=<?=$table?>">글쓰기</a>
<?
	}
?>

		</div>
		</div><!-- content_area -->
	</article>

	<? include "../common/sub_footer.html" ?>

</body>
</html>




