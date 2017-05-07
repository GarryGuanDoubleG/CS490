<?php
//include 'gradeFunction.php';
include 'localtest.php';
include 'methodChecker.php';
include 'executer.php';
$counter = 0;
$object_number = 0;
if(strcmp($_POST['request'], "login") == 0){login();}
if(strcmp($_POST['request'], "add") == 0){addQuestion();}

if(strcmp($_POST['request'], "releasetest") == 0){

//TODO: get the right line per method -> replace all params

  $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
    curl_setopt($ch, CURLOPT_POST, 1);


    curl_setopt($ch, CURLOPT_POSTFIELDS,
                "request=".$_POST['request']);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec ($ch);
    echo $server_output;
    curl_close ($ch);

}
if(strcmp($_POST['request'], "submittest") == 0){
//var_dump($_POST);

$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
              "request=".$_POST['request']);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);

  echo $server_output;
  curl_close ($ch);

  foreach($_POST as $key => $value) {
    if($value == 'submittest'){continue;}


    if($counter == 0){$questID = $value;  }
    if($counter == 1){  urlencode($value); $answer = $value;

      gradeThis($questID,$answer,$object_number);
      $object_number = $object_number + 1;
$counter = 0;
continue;
     }
     $counter = $counter +1;
     //echo $counter;


    }
}
if(strcmp($_POST['request'], "getbank") == 0){



$ch = curl_init();

  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
  "request=".$_POST['request']."&ascending=".$_POST['ascending']."&sort=".$_POST['sort'].
  "&filter=".$_POST['filter']."&filterText=".$_POST['filterText']);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);
  echo $server_output;
  curl_close ($ch);
}
if(strcmp($_POST['request'], "starttest")==0){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
              "request=".$_POST['request']);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);
  echo $server_output;
  curl_close ($ch);
}
if(strcmp($_POST['request'], "getprofresults")==0){

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
              "request=".$_POST['request']);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);
  echo $server_output;
  curl_close ($ch);
}

if(strcmp($_POST['request'], "maketest") ==0){
  var_dump($_POST);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
              "request=".$_POST['request']."&ids=".$_POST['ids']."&points=".$_POST['points']);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);
  echo $server_output;
  curl_close ($ch);
}

if(strcmp($_POST['request'], "gettest") ==0){
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
              "request=".$_POST['request']);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);
  echo $server_output;
  curl_close ($ch);
}
if(strcmp($_POST['request'], "submitchanges") ==0){
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
              "request=".$_POST['request']."&body=".$_POST['body']);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);
  echo $server_output;
  curl_close ($ch);
}
if(strcmp($_POST['request'], "getstudentresults")==0){
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
              "request=".$_POST['request']);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);
  echo $server_output;
  curl_close ($ch);
}

/*function gradeThis($methodName,$questID,$methodHeader,$testIn, $testOut,$answer){
  //echo $questID;
  //echo $answer;
  //echo $testOut;

  $firstHalf = "public class HelloWorld {

      public static void main(String[] args) { ";
//echo "HERE IT IS";
  $callFunction = $methodName . "(" . $testIn . ");";
  //echo $callFunction;

  $fullString = $firstHalf . $callFunction . "}" . $methodHeader . $answer ."}}";
//echo $fullString;
// quest id , score , comment , answer
file_put_contents('HelloWorld.java',$fullString);
exec('/afs/cad/linux/java8/bin/javac HelloWorld.java',$coutcome,$returnval);
if($returnval == 0){

exec('/afs/cad/linux/java8/bin/java HelloWorld', $outcome);

$outcomeString = implode("",$outcome);
if($testOut == $outcomeString){
echo "correct";
  //echo "request=givescore&questid=".$questID."&score=10&comment=Compiled and output matched!&answer=".$answer;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
              "request=givescore&questid=".$questID."&score=10&comment=Compiled and output matched!&answer=".$answer);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);
  echo $server_output;
  curl_close ($ch);

}else {
  echo "almost";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
              "request="."givescore"."&questid=".$questID."&score="."5"."&comment="."Compiled but no matching output!"."&answer=".$answer);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);
  echo $server_output;
  curl_close ($ch);

}

//match outcomestring with output
}else{
echo $testIn;
echo "wrongbro";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);


  curl_setopt($ch, CURLOPT_POSTFIELDS,
              "request="."givescore"."&questid=".$questID."&score="."0"."&comment="."No Compile!"."&answer=".$answer);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $server_output = curl_exec ($ch);
  echo $server_output;
  curl_close ($ch);

}

}*/

function addQuestion(){
  
$array = [
	  "paramName" => $_POST['paramName'],
	  "paramType" => $_POST['paramType'],
	  ];
$handlegg = json_encode($array);



$_POST['parameter']=$handlegg;

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
  curl_setopt($ch, CURLOPT_POST, 1);

 //$_POST['returntype']
 //$_POST[]
  curl_setopt($ch, CURLOPT_POSTFIELDS,
	      "request=".$_POST['request']."&methodName=".$_POST['methodName']."&type=".$_POST['type']."&difficulty=".$_POST['difficulty']."&descr=".$_POST['descr']."&returnType=".$_POST['returnType']."&cases=".$_POST['cases']."&parameter=".$_POST['parameter']);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   $server_output = curl_exec ($ch);
   echo $server_output;
  curl_close ($ch);

}

function login(){


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://web.njit.edu/~gg99/cs490/back.php");
curl_setopt($ch, CURLOPT_POST, 1);


curl_setopt($ch, CURLOPT_POSTFIELDS,
	    "request=login&username=".$_POST['username']."&password=".$_POST['password']);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);

/*if($server_output == "t"){echo "t"; }
  else if($server_output == 's') {echo "s";}
  else {echo "none";}*/
echo $server_output;
curl_close ($ch);
}
/*
//if (strpos($server_output, 'Success') !== false) {
//  echo 'y';
//} else { echo 'n';}
//echo $server_output;

//$ch = curl_init();

//curl_setopt($ch, CURLOPT_URL,"https://cp4.njit.edu/cp/home/login");
//curl_setopt($ch, CURLOPT_POST, 1);


//curl_setopt($ch, CURLOPT_POSTFIELDS,
	//    "user=".$_POST['username']."&pass=".$_POST['password']."&uuid="."0xACA021");
//curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.text');
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//$server_output = curl_exec ($ch);
//echo $server_output
//curl_close ($ch);

//if (strpos($server_output, 'Failed') !== false) {
//  echo 'n';
//} else { echo 'y';}
//echo $server_output
//echo var_dump($_POST);


*/




?>
