<?php

$openai_api_key = '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'; // Replace with your actual API key

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/audio/speech');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer ' . $openai_api_key,
			'Content-Type: application/json'
			));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
				'model' => 'tts-1',
				'input' => '',
				'voice' => 'alloy'
				)));

$result = curl_exec($ch);

if (curl_errno($ch)) {
	echo 'Error:' . curl_error($ch);
} else {
	echo "ok";
	echo "\n";
	// Saving the result as an MP3 file
	file_put_contents('./audio.mp3', $result);
}

curl_close($ch);
?>
