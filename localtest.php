<?php
//include 'executer.php';
//include 'methodChecker.php';

//include 'executer.php';
//gradeThis(0 ,'public static String testQuestion(int intone, int inttwo, int intthree,String stringone){ if(intone==1){ re4turn("123mets");}else return "9"; }' , 0);
function gradeThis($question_ID, $answer, $object_number){
$monster_array = []; // TODO ::  push TOTAL / BLOCK / AND Q ID


 //JUST FOR TESTING MAKE SURE YOU REMOVE
//get the test from Garry
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "request=gettest");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);

curl_close ($ch);

//step 1:  GRADE METHOD HEADER
$monster_array = [];
//$server_output=str_replace("plus_sign", '+', $server_output );
//$server_output=str_replace("minus_sign", "\-", $server_output );



//$server_output=str_replace("division_sign", "/", $server_output );
//$server_output=str_replace("multiplication_sign", "*", $server_output );

$decoded_json = json_decode($server_output, true);
$parameters_to_encode = array(
"paramType"=>"int,int,int,String",
  "paramName"=>
   "intone,inttwo,intthree,stringone",
);
$push_parameters = json_encode($parameters_to_encode);
$json_to_encode = array(
  "request"=>
   "add",
  "methodName"=>
   "testQuestion",
  "returnType"=>
   "",
  "type"=>
  "math",
  "difficulty"=>
   "hard",
  "descr"=>
   "concat them",
  "paramType"=>
   "int,int,int,String",
  "paramName"=>
   "intone,inttwo,intthree,stringone",
  "cases"=>
  '[{"inputs":"1,2,3,mets","output":"123mets"},{"inputs":"4,5,6,mets","output":"456mets"},{"inputs":"7,8,9,mets","output":"789mets"},{"inputs":"10,11,12,mets","output":"101112mets"}]',
  "parameters"=> $push_parameters,
);


$full_replica_json = [];
array_push($full_replica_json, $json_to_encode);

$exploded_answer = explode('{', $answer);

//print_r($full_replica_json);
$plus_sign = "+";
//echo $plus_sign;
methodChecker($exploded_answer, $object_number, $decoded_json, $monster_array);
//executer($decoded_json, $object_number, $answer);
}


?>
