<?php
/** receive POST data from slack
	Sample:
	token=XXXXXXXXXXXXXXXXXX
	team_id=T0001
	team_domain=example
	channel_id=C2147483705
	channel_name=test
	timestamp=1355517523.000005
	user_id=U2147483697
	user_name=Steve
	text=googlebot: What is the air-speed velocity of an unladen swallow?
	trigger_word=googlebot:
**/

# map POST data to variables
$vars = array('token','team_id', 'team_domain', 'channel_id', 'channel_name', 'timestamp', 'user_id', 'user_name', 'text', 'trigger_word');
foreach ($vars as $v) {
  if (isset($_POST[$v])) {
    $$v = $_POST[$v];
  }
}

# authorization
if ($token != "aBbwJUqA6wbreQfDYCI4refz") {die('unauthorized token');}

# authorized. do stuff.
$choosefrom = array(rock, paper, scissors);
$choice = rand(0,2);
$computer = $choosefrom[$choice];

$user_choice = strtolower(trim($trigger_word));
$fulltext = strtolower(trim($text));

#being silly
if ($user_choice != $fulltext) {
	if (substr($fulltext,0,4)==rock) {
		$answer = ":rockon:";
	}
	else {
		$answer = "Huh?";
	}
}
# win/lose logic. copied from elsewhere, hence the ugly.
elseif ( (in_array($user_choice, $choosefrom)) ) {
	$answer = "I choose $computer. ";

	if($user_choice == $computer){
		$answer .= 'draw.';
	}
	else if($user_choice == 'rock' && $computer == 'scissors'){
		$answer .= 'You win.';
	}
	else if($user_choice == 'rock' && $computer == 'paper'){
		$answer .= 'You lose.';
	}
	else if($user_choice == 'scissors' && $computer == 'rock'){
		$answer .= 'You lose.';
	}
	else if($user_choice == 'scissors' && $computer == 'paper'){
		$answer .= 'You win.';
	}
	else if($user_choice == 'paper' && $computer == 'rock'){
		$answer .= 'You win.';
	}
	else if($user_choice == 'paper' && $computer == 'scissors'){
		$answer .= 'You lose.';
	}
}
else {
	$answer = "Huh?";
}

# output
$response = array('text' => $answer);
header('Content-Type: application/json');
echo json_encode($response);

?>