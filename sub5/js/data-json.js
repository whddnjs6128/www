var mtab1 = document.getElementById('t1');
var mtab2 = document.getElementById('t2');
var tab1 = document.querySelector('a.tab1');
var tab2 = document.querySelector('a.tab2');



var xhr = new XMLHttpRequest();                 // XMLHttpRequest 객체를 생성한다.

function change(){
    tab1.classList.remove('current');
    tab2.classList.remove('current');
    this.classList.add('current');
}

function currenttab() {
    tab1.addEventListener('click',change);
    tab2.addEventListener('click',change);
}

currenttab();


function ajax_call(localm){
  //alert(xhr.responseText);
  //if(xhr.status === 200) {                      // If server status was ok
    responseObject = JSON.parse(xhr.responseText);  //서버로 부터 전달된 json 데이터를 responseText 속성을 통해 가져올 수 있다.
	var localText='';                                                 // parse() 메소드를 호출하여 자바스크립트 객체로 변환한다.
    if(localm==1){
        localText='요약재무상태표';
    }else if(localm==2){
        localText='요약포괄손익계산서';
    }

    var newContent = '';

    newContent = '<h3>'+localText+'</h3>';
    newContent += '<p>(단위 : 백만원)</p>';

    newContent += '<table>';
    newContent += '<thead><tr>';
    newContent += '<th scope="col">항목</th>';
    newContent += '<th scope="col">2019년 1분기</th>';
    newContent += '<th scope="col">2020년 1분기</th>';
    newContent += '<th scope="col">2021년 1분기</th>';
    newContent += '</tr></thead>';  

    newContent += '<tbody>';
    
    for (var i = 0; i < responseObject.finance.length; i++) {
      
      newContent += '<tr>';
      newContent += '<th scope="row">'+ responseObject.finance[i].th+'</th>';
      newContent += '<td>'+ responseObject.finance[i].td1 + '</td>';    
      newContent += '<td>'+ responseObject.finance[i].td2 + '</td>';    
      newContent += '<td>'+ responseObject.finance[i].td3 + '</td>';    
      newContent += '</tr>'; 
        
    }
    
    newContent += '</tbody>';
    newContent += '</table>';
 
    document.getElementById('contacts1').innerHTML = newContent;

}

xhr.onload = function() {                       // When readystate changes
   ajax_call(1);
};
xhr.open('GET', 'data/data.json', true);        // 요청을 준비한다.
xhr.send(null);                                 // 요청을 전송한다


mtab1.onclick = function(){
    xhr.onload = function() {                       // When readystate changes
    ajax_call(1);
};
xhr.open('GET', 'data/data.json', true);        // 요청을 준비한다.
xhr.send(null);     
}


mtab2.onclick = function(){
    xhr.onload = function() {                       // When readystate changes
    ajax_call(2);
};
xhr.open('GET', 'data/data2.json', true);        // 요청을 준비한다.
xhr.send(null);     
}







