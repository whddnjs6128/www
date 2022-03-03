<? 
	session_start(); 
     @extract($_POST);
     @extract($_GET);
     @extract($_SESSION);

	// $view_mode = $_GET['view_mode'];
	$table = "concert";   // 테이블명
	$ripple = "concert_ripple"; // 추가

?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>새소식</title>
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"> -->
	<link href="../common/css/common.css" rel="stylesheet">
	<link href="../sub6/common/css/sub6common.css" rel="stylesheet" >
    <link href="../sub6/css/sub6_content1.css" rel="stylesheet" >
	<link href="./css/list.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/76a09b775c.js" crossorigin="anonymous"></script>
<?
	include "../lib/dbconn.php";

	
  if (!$scale)
    $scale=9;			// 한 화면에 표시되는 글 수

    if ($mode=="search")   // 검색버튼을 통한 리스트 출력
	{
		if(!$search)       // 검색 공란 
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}

		$sql = "select * from $table where $find like '%$search%' order by num desc";  
	}
	else                  // 검색이 아닌 일반 리스트 출력 (페이지 번호에 따른 일반 출력)
	{
		$sql = "select * from $table order by num desc";
	}

	$result = mysql_query($sql, $connect);

	$total_record = mysql_num_rows($result); // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      
	$number = $total_record - $start;
?>
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

		<div class="content_area <?= $view_mode ?>">
			<form name="board_form" method="post" action="list.php?table=<?=$table?>&mode=search&view_mode=<?=$view_mode?>">
				<div id="list_search">
					<div class="list_search_left">
						<div id="list_search1">TOTAL : <?= $total_record ?> 건 </div>
						<select name="scale" onchange="location.href='list.php?scale='+this.value+'&view_mode=<?=$view_mode?>'" class="scale">
							<option value=''>보기</option>
							<option value='3'>3</option>
							<option value='6'>6</option>
							<option value='9'>9</option>
							<option value='18'>18</option>
						</select>
						
					</div>

					<div class="list_search_right">
						<div id="list_search3">
							<select name="find">
								<option value='subject'>제목</option>
								<option value='content'>내용</option>
								<option value='nick'>별명</option>
								<option value='name'>이름</option>
							</select></div>
						<div id="list_search4">
							<label class="hidden" for="search">검색어입력</label>
							<input type="text" name="search" id="search" placeholder="검색어를 입력하세요">
						</div>
						<div id="list_search5">
							<button type="submit" id="seach_btn" name="search_btn">
                                <i class="fas fa-search"></i><span class="hidden">검색버튼</span>
                            </button>
						</div>
					</div>
					<ul>
							<li>
								<a href="list.php?page=<?=$i?>&scale=<?=$scale?>&view_mode=view1">
									<i class="fas fa-list"></i><span class="hidden">목록형</span>
								</a>
							</li>
							<li>
								<a href="list.php?page=<?=$i?>&scale=<?=$scale?>&view_mode=view2">
									<i class="fas fa-th-large"></i><span class="hidden">박스형</span>
								</a>
							</li>
						</ul>
				</div>
			</form>

			<div id="list_top_title">
				<ul>
					<li id="list_title1">번호</li>
					<li id="list_title2">제목</li>
					<!-- <li id="list_title3">글쓴이</li>
					<li id="list_title4">등록일</li>
					<li id="list_title5">조회수</li> -->
				</ul>
			</div>

			<div id="list_content">
<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
      mysql_data_seek($result, $i);       
      // 가져올 레코드로 위치(포인터) 이동  
      $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	  $item_num     = $row[num];
	  $item_id      = $row[id];
	  $item_name    = $row[name];
  	  $item_nick    = $row[nick];
	  $item_hit     = $row[hit];
      $item_date    = $row[regist_day];
	  $item_date = substr($item_date, 0, 10);  

	  $sql = "select * from $ripple where parent=$item_num"; // 추가
	  $result2 = mysql_query($sql, $connect); // 추가
	  $num_ripple = mysql_num_rows($result2); // 추가

	  	//$len_subject = strlen($row[subject]); // 제목의 길이
		$item_subject = str_replace(" ", "&nbsp;", $row[subject]);//문자열을 바꾸는 메소드
		$len_subject = strlen($row[subject]); 

	  if ($len_subject > 80)   //제목의 길이가 지정한 길이보다 크면
		{
			$item_subject = mb_substr($row[subject], 0, 40, 'utf-8');  
			// 첫번째 문자부터 $char_limit만큼 잘라낸다.
			//mb_substr 은 입력받은 문자열을 정해진 길이만큼 잘라서 리턴하는데 
			//2byte 문자인 한글에 대해서도 처리가 가능한 함수입니다. 
			$item_subject = $item_subject."...";
		}

	  if($row[file_copied_0]){ // 첨부된 첫번째 이미지가 있다면
        $item_img = './data/'.$row[file_copied_0];  
      }else{  //첨부 이미지가 없으면 디폴트
        $item_img = './data/default.jpg'  ;
      }
?>
				<ul class="list_item">
                        <li class="list_item1"><?= $number ?></li>
                        <li class="list_item2">
							<a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>">
								<img src="<?=$item_img?>" alt="" width="50" height="50">
							</a>

							<a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>">
								<dl>
									<dt>
										<?= $item_subject ?>
									</dt>
									<dd>
										<?= $item_nick ?> &nbsp/&nbsp
									</dd>
									<dd>
										<?= $item_date ?> &nbsp/&nbsp
									</dd>
									<dd>
									<i class="far fa-eye"></i><span class="hidden">조회수</span> <?= $item_hit ?>
									</dd>

									<dd>
<?
									if ($num_ripple)  // 추가
											echo " <i class='far fa-comment-dots'></i> <span class='hidden'>댓글수</span> $num_ripple";
?>
									</dd>
								</dl>
							</a>
						</li>
                        <!-- <li class="list_item3"></li>
                        <li class="list_item4"></li>
                        <li class="list_item5"></li> -->
                </ul>
<?
   	   $number--;
   }
?>
				<div id="page_button">
					<div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp;
<?
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<b> $i </b>";
		}
		else
		{ 
           if($mode=="search"){  //검색상태일때 페이징 번호 링크 클릭
             echo "<a href='list.php?page=$i&scale=$scale&mode=search&find=$find&search=$search&view_mode=$view_mode'> $i </a>"; 
            }else{    
            
			  echo "<a href='list.php?page=$i&scale=$scale&view_mode=$view_mode'> $i </a>";
           }
		}      
   }
?>
						&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
					</div>
					<div id="button">
						<a href="list.php?table=<?=$table?>&page=<?=$page?>&view_mode<?=$view_mode?>">목록</a>&nbsp;
<? 
	if($userid)
	{
?>
						<a href="write_form.php?table=<?=$table?>">글쓰기</a>
<?
	}
?>
					</div>
				</div> <!-- end of page_button -->

			</div> <!--  list_content -->




		</div><!-- content_area -->
	</article>

	<? include "../common/sub_footer.html" ?>
</body>
</html>


