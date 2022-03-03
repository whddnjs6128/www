<?
   function latest_article($table, $loop, $char_limit) //테이블명, 리스트개수 , 제목글제한수(byte)
   {
		include "dbconn.php";

		//latest_article("concert", 2, 30);

		
		$sql = "select * from $table order by num desc limit $loop";
		$result = mysql_query($sql, $connect);

		while ($row = mysql_fetch_array($result))
		{
			$num = $row[num];
			 $len_subject = mb_strlen($row[subject], 'utf-8');
			$subject = $row[subject];

            $len_content = mb_strlen($row[content], 'utf-8');
            $content = $row[content];

			if ($len_subject > $char_limit)
			{
				//$subject = str_replace( "&#039;", "'", $subject);               
               $subject = mb_substr($subject, 0, $char_limit, 'utf-8');
				$subject = $subject."...";
			}

            if ($len_content > 70)   //제목의 길이가 지정한 길이보다 크면
			{
                $content = mb_substr($content, 0, 70, 'utf-8');   // 첫번째 문자부터 $char_limit만큼 잘라낸다.
												  //mb_substr 은 입력받은 문자열을 정해진 길이만큼 잘라서 리턴하는데 
												  //2byte 문자인 한글에 대해서도 처리가 가능한 함수입니다. 
			    $content = $content."...";   // 잘라낸 문자열에 ...을 추가한다.
			}


			$regist_day = substr($row[regist_day], 0, 10);

            

            if($row[file_copied_0]){
                $concertimg='./greet/data/'.$row[file_copied_0];
            }else{
                $concertimg= './greet/data/default.jpg';
            }

             echo "      
             <li>
            <a href='./greet/view.php?table=$table&num=$num'>
                <img src='$concertimg' alt='뉴스이미지'>
            </a>
            <dl>
                <dt><a href='./greet/view.php?table=$table&num=$num'>$subject</a></dt>
                <dd><a href='./greet/view.php?table=$table&num=$num'>$content</a></dd>
                <dd><span> $regist_day</span></dd>
            </dl>
            </li>
			";  

		}
		mysql_close();
   }
?>