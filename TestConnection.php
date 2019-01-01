<?php
  $serverName = "sql1.njit.edu";
  
  $dBName = 'ma895';
  
  //This creates a new connection
  $conn = new mysqli($serverName, $userName, $password,$dBName);
  
  //Checks to see if the connnection failed 
  if ($conn->connect_error){
    die("Connection failed: " . $conn->error);  
  }
  //echo "The connection was successful\n";  
   
  $fakeName = 'ab123';    //Test Variables 
  $fakePass = 'Manch786329';
  
  $hashedPass = protect($conn,md5($fakePass));  //Hashing the password and protecting from injections
  
  /*
  $sql = "INSERT into InstructorTable(Username,Password) VALUES ('$fakeName','$hashedPass')";
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  */
  
  $name = $_POST['user'];
  $password = $_POST['pass'];
  
  $hashedPassword2 = md5($password);
  
  $sql = "SELECT Username,Password FROM InstructorTable WHERE Username ='$name' AND Password = '$hashedPassword2'";
  if($result = mysqli_query($conn,$sql)){
    
    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);     
      $response->succeeded = 'true'; //How i am sendiing to mid 
      
      $myString = '{"succeeded":"Database accepts"}';
      echo "$myString";
    }
    else{
      $myString = '{"succeeded":"Database does not accepts"}';
      echo "$myString";
    }
    
  }
  
  function protect($conn,$string){
    $string = mysqli_real_escape_string($conn,trim(strip_tags($string)));  //This is to protect against of injections and other hazards
    return $string;
  } 
 
  $conn->close();
  
?>