<?php

$openai_api_key = '';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/images/generations');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer ' . $openai_api_key,
			'Content-Type: application/json'
			));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
				'model' => 'dall-e-3',
				"prompt" => "un chicho divrtiendose en punta cana",
				"n" => 1,
				"size" => "1024x1024"
				)));

$result = curl_exec($ch);

if (curl_errno($ch)) {
	echo 'Error:' . curl_error($ch);
} else {
	$objeto = json_decode($result);
	$imageURL = $objeto->data[0]->url;
	$imageContent = file_get_contents($imageURL);
	file_put_contents("./image.jpg", $imageContent);
}

curl_close($ch);
?>
