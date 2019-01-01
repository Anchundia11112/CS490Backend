<?php
  $serverName = "sql1.njit.edu";
  $userName = "ma895";
  $password = "mSwMX8YJ";
  $dBName = 'ma895';
  
  //This creates a new connection
  $conn = new mysqli($serverName, $userName, $password,$dBName);
  
  //Checks to see if the connnection failed 
  if ($conn->connect_error){
    die("Connection failed: " . $conn->error);  
  }
 
   
  $inputJSON = file_get_contents('php://input');
  $input= json_decode( $inputJSON ); 
  
 
  
  $sql = "UPDATE QuestionTable SET points='$input->points' WHERE  questionID = '$input->questionId'";
  if ($conn->query($sql) === TRUE) {
    echo "New record successfully updated.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  } 
  $sql = "UPDATE ExamStatus SET GradeReleased='$input->gradeReleased' WHERE ExamID = '$input->examId'";
  $conn->close();
  
?>