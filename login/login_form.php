<?
	session_start();
    @extract($_GET); 
    @extract($_POST); 
    @extract($_SESSION);  
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>로그인</title>
	<link rel="stylesheet" href="./css/login.css">
	<link rel="stylesheet" href="../common/css/common.css">

</head>
<body>
	<div class="wrap">
		<header>
			<h1 class="logo"><a href="../index.html">동아ST</a></h1>
		</header>

		<article id="content">
		<form  name="member_form" method="post" action="login.php"> 
					<h2>로그인</h2>
					<div id="id_pw_input">
						<ul>
							<li>
								<label for="id" class="hidden">아이디</label>
								<input type="text" name="id" class="login_input" id="id" placeholder="아이디를 입력하세요">
							</li>
							<li>
								<label for="pass" class="hidden">패스워드</label>
								<input type="password" name="pass" class="login_input" id="pass" placeholder="비밀번호를 입력하세요">
							</li>
						</ul>						
					</div>

					<div id="login_button">
						<button class="login_button" type="submit">로그인</button>
					</div>

					<ul class="find_go">
						<li><a href="./id_find.php">아이디 찾기</a></li>
						<li><a href="./pw_find.php">비밀번호 찾기</a></li>
					</ul>

					<div id="join_button">
						<strong>JOIN US</strong>
                        <p>아직 동아ST 회원이 아니신가요?<br>
						회원가입을 통해 다양한 정보를 확인하세요.</p>
                        <a class="joinUs" href="../member/member_check.html">회원가입</a>
                    </div>
	    </form>
		</article>
	</div>

</body>
</html>

