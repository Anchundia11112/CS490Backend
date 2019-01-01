<?php
  $serverName = "sql1.njit.edu";
 
  $dBName = 'ma895';
  
  //This creates a new connection
  $conn = new mysqli($serverName, $userName, $password,$dBName);
  
  //Checks to see if the connnection failed 
  if ($conn->connect_error){
    die("Connection failed: " . $conn->error);  
  }
  //,TestCases,TestOutputs
  $sql = "Select 
            QuestionTable.*,TestCases.TestCaseID,TestOutputs.Answer, TestCaseParam.Parameter
          FROM 
            QuestionTable,TestCases,TestOutputs, TestCaseParam
          Where 
            QuestionTable.QuestionID = TestCases.QuestionID and TestCases.TestCaseID=TestOutputs.TestCaseID and TestCaseParam.TestCaseID = TestCases.TestCaseID";

  $thingToEcho;
  $thingToEcho->questions = array();
             
  $result = mysqli_query($conn,$sql);
  
  while($row = mysqli_fetch_array($result)){                              
     $row_array['result'] = $row;
     array_push($thingToEcho->questions,$row_array);
        
  };
  
  $myJson = json_encode($thingToEcho,true);
  echo $myJson;
  

  $conn->close();
  
?>
