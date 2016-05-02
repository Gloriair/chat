

<head>  <meta charset="utf-8">  
<title>Login Form</title>  
  <link type="text/css" rel="stylesheet" href="chat.css" /> <!-- this is for CSS --> 
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


</head>
<div id ="answerdiv"> 

</div>
<script>
var currentId = 0;

function checkForAnswer(){
    
     $.post( "ajaxg.php", { type: "checkstatus", id:currentId })      
    .done(function( data ) {   
    
             if(data == '0'){
              alert('no answer yet')
             } else {
                getAnswer();
             }       
    });
	}
	


function askQuestion(){

    var var1 = document.getElementById('app_name').value;
    var var2 = document.getElementById('app_ques').value; 
    
    
    $.post( "ajaxg.php", { type: "submitquestion", app_name: var1, app_ques: var2 })      
    .done(function( data ) {        
         
          currentId = data;
          // pop up a box to the user
          $( "#sampledialog" ).dialog();
           $( "#hiddendiv" ).show();
    });
    
    
    // start the timer to check for an answer
    setInterval(function(){ checkForAnswer(); }, 1000);

}
</script>

 <div id="wrapper">
	<div id="menu">
		<p class="welcome">Welcome, dear user!</p>
	</div>
	
	
	<div id="chatbox">  
    Name: <input type="text" name="app_name" id="app_name"></input><br>   
    Question: <input type="text" name="app_ques" id="app_ques"> </input><br>
    <button onclick="askQuestion();">Ask Question</button> 
  	</div>  <!-- end of div chatbox --> 
</div><!-- end of div wrapper -->   
    
    
<div id="sampledialog" title="Basic dialog">
  <p>Thank you for asking a question, please wait for an answer!</p>
</div>

<div id="hiddendiv">
This is an example of a hidden div!, Nobody knows it is here until we tell it to show()

</div>    
    
<script>

  function getAnswer(){
    
     $.post( "ajaxg.php", { type: "getAnswer", id:currentId })      
    .done(function( data ) {   
    
             $("#answerdiv").html(data);       
    });  
}

      $( "#sampledialog" ).hide();
      
       $( "#hiddendiv" ).hide();
  </script>
    

    
