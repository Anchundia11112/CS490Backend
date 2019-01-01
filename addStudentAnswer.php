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
 
 //echo(var_dump($input->answerText));
 /*
 
 INSERT INTO `ma895`.`studentAnswer` (`StudentIndex`, `QuestionIndex`, `StudentAnswer`) 
 VALUES 
 ('1', '1', '"def computePower(x, y):\\r\\n return x ** y"');
 
 
 $sql = "Insert INTO studentAnswer(StudentIndex,QuestionIndex,StudentAnswer) VALUES ('$input->studentId','$input->questionId',$input->answerText')";
 if ($conn->query($sql) === TRUE) {
   echo "New record created successfully";
 } 
 else {
   echo "Error: " . $sql . "<br>" . $conn->error;
 }
 */
 $data =  mysqli_real_escape_string($conn,$input->answerText);; 
  
 
 $sql = "Insert INTO studentAnswer(StudentIndex,QuestionIndex,StudentAnswer,examID) VALUES ('$input->studentId','$input->questionId','$input->answerText','$input->examId')";
 if ($conn->query($sql) === TRUE) {
   echo "New record created successfully";
 } 
 else {
   echo "Error: " . $sql . "<br>" . $conn->error;
 }
 
 /*
 $sqlSelecter = "Select studentAnswer as 'result' from studentAnswer WHERE QuestionIndex = 3";
 
 $sql_result = mysqli_query($conn, $sqlSelecter);
    
  $row = mysqli_fetch_assoc($sql_result);
  $answer = $row['result'];
  if ($row) {
    echo $answer;
  }  
 */

 
?>