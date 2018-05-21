<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$text = $json->fulfillmentMessages[]->text->text;

	switch ($text) {
		case 'hi':
			$fulfillmentText = "Hi, Nice to meet you";
			break;

		case 'bye':
			$fulfillmentText = "Bye, good night";
			break;

		case 'anything':
			$fulfillmentText = "Yes, you can type anything here.";
			break;
            
		case '':
			$fulfillmentText = "You've sent a <space> or NULL text to the web service";
			break;
		
		default:
			$fulfillmentText = "Sorry, I didnt get that. Please ask me something else.";
			break;
	}

	$response = new \stdClass();
	$response->fulfillmentText = $fulfillmentText;
	$response->fulfillmentMessages[] = $fulfillmentText;
	$response->source = "webhook";
	echo json_encode($fulfillmentText);
}
else
{
	echo "Method not allowed";
}

?>