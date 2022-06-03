<?php

$data = json_decode(file_get_contents('php://input'));





// $chatId = $data->message->chat->id;
// $messageText = $data->message->text;
// $result = curlExec('sendMessage', ['chat_id' => $chatId, 'text' => $messageText]);

// function curlExec($method, $params='') {
//     $url = 'https://api.telegram.org/bot5411827284:AAEsyM8X47_qIFK0rAIqQvs7KAKMzPdrvsQ/';
//     $curl = curl_init();
//     curl_setopt_array($curl, array(
//         CURLOPT_SSL_VERIFYPEER => 0,
//         CURLOPT_POST => 1,
//         CURLOPT_HEADER => 0,
//         CURLOPT_RETURNTRANSFER => 1,
//         CURLOPT_URL => $url . $method,
//         CURLOPT_POSTFIELDS => $params,
//     ));
//     $result = curl_exec($curl);
//     curl_close($curl);
//     return $result;
// };