<?php
function executer($decoded_json, $object_number, $answer, $responseArray, $monster_array, $score_tally){
 



  $scaler = 0;
  $score_executer = 0;
  $grader_response = '';
  $paramsArrayE = [];
  $params_to_be_executed = '(';
  //print_r($responseArray);




  //execute a return program

 
  $json_inputs = json_decode($decoded_json[$object_number]['testcases'], true);
  //loop through input json
 
  for($i = 0; $i < count($json_inputs); $i++){
  $params_to_be_executed = '(';
    $input_count = count($json_inputs);
    $exploded_inputs = explode(',',$json_inputs[$i]['inputs']);
    //$exploded_outputs = explode(',', $json_inputs[$i]['output'])
    
    
    $json_params = json_decode($decoded_json[$object_number]['parameters'], true);

    $exploded_paramType = explode(',' , $json_params['paramType']);// exploded paramType
    //var_dump($exploded_paramType);
    // loop through specific input
  for($j = 0; $j < count($exploded_inputs); $j++){
  //echo count($exploded_inputs);
    $oneMinus = count($exploded_inputs) - 1;

    if($j == $oneMinus){
    //  if(strpos($exploded_inputs[$j], 'plus_sign') !== false){$exploded_inputs[$j] = ' \+ ' ;}
      
      if(strpos($exploded_paramType[$j], 'String') !== false){
        $params_to_be_executed = $params_to_be_executed . '"' . $exploded_inputs[$j] . '")';
      }else {
        $params_to_be_executed = $params_to_be_executed . $exploded_inputs[$j] . ')';
      }



    }else{
      //if(strpos($exploded_inputs[$j], 'plus_sign') !== false){$exploded_inputs[$j] = ' \+ ';}
      if(strpos($exploded_paramType[$j], 'String') !== false){
        $params_to_be_executed = $params_to_be_executed . '"' . $exploded_inputs[$j] . '",';} //elseif(strpos($exploded_paramType[$j
        else {
          $params_to_be_executed = $params_to_be_executed . $exploded_inputs[$j] . ',';}

        }
       // echo ' |  ';
 //echo $params_to_be_executed;



// echo $params_to_be_executed; 
  }
  

  $firstHalf = "public class HelloWorld {

      public static void main(String[] args) { ";
  $callFunction = $decoded_json[$object_number]['method_name'] . $params_to_be_executed;
  $secondHalf = "}" . $answer ."}";
  //echo $answer;
 
  if(strpos($answer , 'return') !== false){
$callFunction = 'System.out.println(' . $callFunction . ');';

  }
  if(strpos($answer, 'System.out.println(') !== false){

    $callFunction = $callFunction . ';';
  }

  $fullProgram = $firstHalf . $callFunction . $secondHalf;
 //echo $fullProgram;
                    

//echo $params_to_be_executed;
 $params_to_be_executed = '(';
$scaler = 5/$input_count;
 $coutcome = [];
  
  file_put_contents('HelloWorld.java',$fullProgram);
  exec('/afs/cad/linux/java8/bin/javac HelloWorld.java 2>&1',$coutcome,$returnval);
 $imploded_coutcome = implode(" ", $coutcome);
 $result = preg_replace("/[^a-zA-Z0-9]+/", " ", $imploded_coutcome);
  //print_r($coutcome);
  //echo $result;
  if($returnval == 0){
    $outcome = [];
    exec('/afs/cad/linux/java8/bin/java HelloWorld', $outcome); 
    if(strpos($outcome[0], $json_inputs[$i]['output'] ) !== false){
     
    echo "Matched and compiled.";} else { echo "Compiled but no match"; }
    }else{ echo "No compile";}
     $testcaseArray = array(
  'part' => 'Test Case',
  'points' => 10,
  'grader' => "Front End Recieved.",
  'comments' => '',

  );
  array_push($responseArray, $testcaseArray);
  }
  //SEND THE DATA HERE
  //print_r($responseArray);
  $blockArray = array(
   'block' => $responseArray,

);
$garry_final_grading = json_encode($blockArray);
$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
              "request=givescore&jsonobj=".$garry_final_grading."&score="."10"."&question_id=".$decoded_json[$object_number]['question_id']);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);

  echo $server_output;
  curl_close ($ch);

  }
  /*
 $imploded_coutcome = implode(" ", $coutcome);
  if($returnval == 0){
    exec('/afs/cad/linux/java8/bin/java HelloWorld', $outcome);

    if(strpos($outcome[0], $json_inputs[$i]['output'] ) !== false){
     //print_r($outcome[0]);
     $grader_response = "Matched and compiled.";
     $score_executer = $scaler * 1 + $score_executer;



   }
    else{  $grader_response =  "Compile success. Outcome match: failed."; $score_executer =  $scaler * (1/2) + $score_executer;}
  } else {

     $grader_response = "Compile Errors: " . $imploded_coutcome; }



  $testcaseArray = array(
  'part' => 'Test Case',
  'points' => $score_executer,
  'grader' => $grader_response,
  'comments' => '',

  );
  array_push($responseArray, $testcaseArray);

}


array_push($monster_array, $final_score);
$blockArray = array(
   'block' => $responseArray,

);
$score_final = $score_tally + $score_executer;
$score_final = $score_final * 100;
$score_final = $score_final / 10;
//echo $decoded_json[$object_number]['points'];
$score_final = $score_final * $decoded_json[$object_number]['points'];
$score_final = $score_final / 100;
$garry_final_grading = json_encode($blockArray);
array_push($monster_array, $blockArray);


$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
              "request=givescore&jsonobj=".$garry_final_grading."&score=".$score_final."&question_id=".$decoded_json[$object_number]['question_id']);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);

  echo $server_output;
  curl_close ($ch);

  //var_dump($_POST);
//$encoded_response = json_encode($responseArray);
//echo $encoded_response;
//echo $params_to_be_executed;

?>
