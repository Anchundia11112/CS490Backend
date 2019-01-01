<?php
  $serverName = "sql1.njit.edu";
  
  $dBName = 'ma895';
  
  //This creates a new connection
  $conn = new mysqli($serverName, $userName, $password,$dBName);
  
  //Checks to see if the connnection failed 
  if ($conn->connect_error){
    die("Connection failed: " . $conn->error);  
  }

 $inputJSON = file_get_contents('php://input');
 $input= json_decode( $inputJSON ); 

 $data =  mysqli_real_escape_string($conn,$input->answerText);; 
  
 $sqlSelecter = "Select studentAnswer as 'result' from studentAnswer WHERE QuestionIndex = '$input->questionId'and StudentIndex = '$input->studentId' and 
 examID = '$input->examId'";
 
 $sql_result = mysqli_query($conn, $sqlSelecter);
    
  $row = mysqli_fetch_assoc($sql_result);
  $answer = $row['result'];
  if ($row) {
    echo $answer;
  }  


 
?>
