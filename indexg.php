
<head>
 <meta charset="utf-8">  
<title>IWA Main Assignment, Gloria Bartolome, Student 2015705</title>  
  <link type="text/css" rel="stylesheet" href="chat1.css" /> <!-- this is for CSS --> 
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>

<body>

	<script>
	var currentId = 0;

function checkForAnswer(){
    
     $.post( "ajaxg.php", { type: "checkstatus", id:currentId })      
    .done(function( data ) {   
    
             if(data == '0'){
			 // alert('no answer yet') / for debugging purpose
            } else {
			// alert('got an answer!') / for debugging purpose
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
			Name:<br><input type="text" name="app_name" id="app_name"></input><br><br> 
			Question: <br><textarea type="text" name="app_ques" rows="10" cols="5" id="app_ques"> </textarea><br>
			<button onclick="askQuestion();">Send</button> <br><br>
			
			<div id="answerdiv"> </div>
	 
			<button onclick="getOsloNorwayTime()">Show Oslo Norway Time</button>
 
 <div id="timediv" title="Time"></div>
  
  	</div>  <!-- end of div chatbox --> 
</div><!-- end of div wrapper -->   
  
     
<div id="sampledialog" title="Basic dialog">
  <p>Thank you for asking a question, please wait for an answer!</p>
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

	  
function getOsloNorwayTime(){
  $.get( "https://api.xmltime.com/timeservice?accesskey=LHdAgMV13o&secretkey=ZA3WMXjE7zaKDBn4q7fH&version=2&out=xml&placeid=norway%2Foslo", function( data ) {
  debugger
  xml = new XMLSerializer().serializeToString(data.documentElement);
  xmlDoc = $.parseXML( xml ),
  $xml = $( xmlDoc ),
  $title = $xml.find( "time" ).attr("iso");
   
  $( "#timediv" ).empty();
  $( "#timediv" ).append( $title );
  
  });
}

  </script>
   </body> 

    
