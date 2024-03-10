<?php

$apiKey = '';

// Definir la URL de la API y tu clave de autenticación
$url = 'https://api.openai.com/v1/chat/completions';
$content = file_get_contents("/home/fsilva/content", true);

// Definir el cuerpo de la solicitud
$data = array(
				"model" => "gpt-3.5-turbo",
				"messages" => array(
						array(
								"role" => "system",
								"content" => "Crea resumenes de lo que te de el usuario y formatealo en HTML con bootstrap"
							 ),
						array(
								"role" => "user",
								"content" => $content
							 )
						)
			 );

// Convertir el cuerpo de la solicitud a formato JSON
$data_string = json_encode($data);

// Inicializar cURL
$ch = curl_init($url);

// Configurar las opciones de cURL
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'Content-Type: application/json',
						'Authorization: Bearer ' . $apiKey));

// Ejecutar la solicitud y obtener la respuesta
$result = curl_exec($ch);

// Manejar errores si los hay
if (curl_errno($ch)) {
		echo 'Error:' . curl_error($ch);
}else{
		$objeto = json_decode($result);
		echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
		echo '<div class="container mt-5">';
		echo $objeto->choices[0]->message->content;
}

// Cerrar la conexión cURL
curl_close($ch);
// Mostrar la respuesta

?>
