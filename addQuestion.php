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

  $innerArrayCount = count($input->testCaseInput);

  
  // Inserting Question ID, Function Name, Type, Difficulty, Question Description
  $sql = "INSERT into QuestionTable(Difficulty,Question,Function,Topic,points,constraints) VALUES ('$input->difficulty','$input->questionText','$input->functionName','$input->topic','$input->points','$input->constraints')";
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  echo("\n");
  
  //Inserting Test Case ID's and Question ID's 
  $result = mysqli_query($conn, "SELECT MAX(QuestionID) AS 'max' FROM QuestionTable");
  $row = mysqli_fetch_assoc($result);
  $currID = $row['max'];
  //echo($currID . "\n");
  
  //GETTING THE MAX TESTCASE ID
  $testCaseLargest = mysqli_query($conn, "SELECT MAX(TestCaseID) AS 'max' FROM TestCases");
  $rowLargest = mysqli_fetch_assoc($testCaseLargest);
  $currTCID = $rowLargest['max'];  
  
  // loop x number of times
  for($i=0; $i<$innerArrayCount; $i++)
  {
    $sqlPartial = "INSERT INTO TestCases(QuestionID) VALUES ('$currID')";
     if ($conn->query($sqlPartial) === TRUE) {
       echo "New record created successfully\n";
     } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
       }
  }
  
  
//Inserting TestCaseID, Result for said Test Case
  foreach($input->testCaseOutput as $valueT){
    //echo $valueT . "\n";
  
    $sql = "INSERT into TestOutputs(Answer) VALUES ('$valueT')";
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully\n";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }  
  
  
          
 $result->close();
                 
 $incrementer = 0;
 $testCaseIndex = 1;
 
 
 $sql = "select Grade as 'theGrade' from gradeTable where ExamID  = '$input->examId' and StudentID = '$input->studentId'";
 $sql_result = mysqli_query($conn, $sql);
    
  $row = mysqli_fetch_assoc($sql_result);
  $grade = $row['theGrade'];
  if ($row) {
    echo $grade;
  }  
 $currTCID++;
 // Inserting Testcase Input hase Test Case ID, Parameter, and Position      
 foreach($input->testCaseInput as $row){
   $incrementer++;
   $testCaseIndex++;
   
   
   foreach($row as $cell){
     $sqlPara = "INSERT INTO TestCaseParam(TestCaseID,Parameter,Position) VALUES ('$currTCID','$cell','$incrementer')";
     $incrementer++;
     if ($conn->query($sqlPara) === TRUE) {
       echo "New record created successfully\n";
     } else {
         echo "Error: " . $sqlPara . "<br>" . $conn->error;
     }
    
   }  
 
  $incrementer = 0;
  $currTCID++;
 }

  $conn->close();
  
?>