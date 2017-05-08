<?php

function methodChecker($exploded_answer, $object_number, $decoded_json, $monster_array){
$score_tally = 10;
$local_points = 0;
$param_flag = false;
$response = '';
$methodArray = [];
$errorFlag = false;
$response = '';
$paramsArray = [];
$generated_params_header = '(';
$method_header = 'public static';
$responseArray = [];

 //preg_replace('/\s+/S', " ", $send_answer_to_arian);
$send_answer_to_arian = implode('{',$exploded_answer);
//$send_answer_to_arian = preg_replace('/\s+/S', " ", $send_answer_to_arian);
 
 
//echo ($decoded_json[$object_number]['testcases'];


//generate header
//check for correct method name
if (strpos($exploded_answer[0], $decoded_json[$object_number]['method_name']) !== false)
{
$response = $response . 'Method name: correct. ';
$score_tally = 10;
$local_points = 20;

} else { $errorFlag = true;
$response = $response . 'Method name: incorrect. ';
$score_tally = $score_tally - 2;
$local_points = 0;
 }
 
if(strpos($exploded_answer[0], 'public static void') !==false){
                               $decoded_json[$object_number]['returnType'] = 'void';

}
if(strpos($exploded_answer[0], 'public static String') !==false){
                               $decoded_json[$object_number]['returnType'] = 'String';

}
if(strpos($exploded_answer[0], 'public static int') !==false){
                               $decoded_json[$object_number]['returnType'] = 'int';

}
if(strpos($exploded_answer[0], 'public static boolean') !==false){
                               $decoded_json[$object_number]['returnType'] = 'boolean';

}
// check for correct params

$json_params = json_decode($decoded_json[$object_number]['parameters'], true);
//var_dump($json_params);
$exploded_paramName = explode(',' , $json_params['paramName']);// exploded paramName
$exploded_paramType = explode(',' , $json_params['paramType']);// exploded paramType

for ($i = 0; $i < count($exploded_paramType); $i++) {
   $paramPush = $exploded_paramType[$i] . " " . $exploded_paramName[$i];
   array_push($paramsArray, $paramPush);
}
for($j = 0; $j < count($paramsArray); $j++){
$params_compare_string = $paramsArray[$j] . ')';
$params_compare_string2 = $paramsArray[$j] . ',';

if (strpos($exploded_answer[0], $params_compare_string) !== false)
{

 $response = $response;
 
 
} elseif (strpos($exploded_answer[0], $params_compare_string2) !== false)
      {

          $response = $response;
      } else {
      $param_flag = true;
      //$response = $response . 'Params Bad. ';
      $errorFlag = true;
      }
}
// NEW LINES OF CODE POSSIBLY DELETE



if($param_flag == true){ $score_tally = $score_tally - 3;  $response = $response . 'Error in parameters. ';}else {$local_points = $local_points + 30; $response = $response . ' Parameters matched. ';}
/*
$intreturn = ' int ';
$stringreturn = ' String ';
$voidreturn = ' void ';
$booleanreturn = ' boolean ';
if ($decoded_json[$object_number]['returnType'] == "") {
 if (strpos($exploded_answer[0], $intreturn) !== false){
   $decoded_json[$object_number]['returnType'] = 'int';
 }
 if (strpos($exploded_answer[0], $stringreturn) !== false){
   $decoded_json[$object_number]['returnType'] = 'String';
 }
 if (strpos($exploded_answer[0], $voidreturn) !== false){
   $decoded_json[$object_number]['returnType'] = 'void';
 }
 if (strpos($exploded_answer[0], $boolean) !== false){
   $decoded_json[$object_number]['returnType'] = 'boolean';
 }
}*/
// check for correct type
/*
$return_type_to_check = ' '.$decoded_json[$object_number]['returnType'];
if(strpos($exploded_answer[0], $return_type_to_check) !== false)
{
    $response = $response.  ' Return valid.';
} else { $response = $response.  ' Return type invalid'; $errorFlag = true;}*/


//generate HEADER

$oneMinus = count($paramsArray) - 1;

for($count = 0; $count < count($paramsArray); $count++){
  if($count == $oneMinus){
  $generated_params_header = $generated_params_header . $paramsArray[$count] . ')';

} else
$generated_params_header = $generated_params_header . $paramsArray[$count] . ',';
}


$methodPairs = array(
'part' => 'Method Header',
'points' => $local_points,
'grader' => $response,
'comments' => '',

);
$questionPair = array(
'question_id' => $decoded_json[$object_number]['question_id'],

);
$final_score = array(
'score' => 10,

);
array_push($monster_array, $final_score);
array_push($monster_array, $questionPair);
array_push($responseArray, $methodPairs);
// THIS IS THE PART THAT REPLACES THE ANSWER WITH NECESSARY CHANGES IT DOES NOT GRADE , GRADING IS ABOVE
 $matches = array();
preg_match_all('/[a-zA-Z]+[,|)]/', $exploded_answer[0], $matches);

for($yes = 0; $yes < count($matches); $yes++){
$matches[$yes] = str_replace(',','',$matches[$yes]);
$matches[$yes] = str_replace(')','',$matches[$yes]);
}
//print_r($matches);
$json_params = json_decode($decoded_json[$object_number]['parameters'], true);
$exploded_paramName = explode(',' , $json_params['paramName']);// exploded paramName
 $imploded_answer = implode('{', $exploded_answer);
 echo $imploded_answer;
 
for($no = 0; $no < count($exploded_paramName); $no++){
//echo $exploded_paramName[$no];
//print_r($matches);

 $imploded_answer = str_replace($matches[0][$no],$exploded_paramName[$no],$imploded_answer);
}
echo $imploded_answer;
$exploded_answer = explode('{',$imploded_answer);

if($errorFlag == true){
$method_header = $method_header . ' ' . $decoded_json[$object_number]['returnType'] .' '. $decoded_json[$object_number]['method_name'] . $generated_params_header;

$exploded_answer[0] = $method_header;

$imploded_answer = implode('{', $exploded_answer);
//echo $imploded_answer;
print_r($responseArray);
//echo $imploded_answer;
//echo "ABOUT TO INITIATE EXECUTER";
executer($decoded_json, $object_number, $imploded_answer, $responseArray, $monster_array, $local_points, $send_answer_to_arian);
} else{

$imploded_answer = implode('{', $exploded_answer);
print_r($responseArray);
//echo $imploded_answer;

//echo "Method Header : Perfect Score";
executer($decoded_json, $object_number, $imploded_answer, $responseArray, $monster_array, $local_points, $send_answer_to_arian);
}
//public static void testQuestion(int numberOne, int numberTwo){System.out.println("0");}
//public static void anotherTest(int name){ System.out.println("4");





}


?>
