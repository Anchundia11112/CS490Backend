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
  
 
  
  $sql = "UPDATE examQuestionBreakdownPoints SET grade='$input->grade', comment='$input->comment', adjustment='$input->adjustment', reason='$input->reason' WHERE studentId = '$input->studentId' AND questionId = '$input->questionId' AND ExamID = '$input->examId'";
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  } 
  $sql = "UPDATE ExamStatus SET GradeReleased='$input->gradeReleased' WHERE ExamID = '$input->examId'";
  $conn->close();
  
?>