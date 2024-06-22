<?php
    // Load configuration file to get bot token and API key
    require 'config.php';
    define ('BOT_TOKEN', $bot_token); // Telegram bot token from config.php
    define ('TELEGRAM_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/'); // Telegram API URL
    define ('API_KEY', $api_key); // ImgBun API key from config.php

    /**
     * Sends a message or photo to the Telegram API
     *
     * @param string $method The Telegram API method to be called
     * @param array $params The parameters to be sent with the API call
     * @return string The result from the Telegram API
     */
    function msg($method, $params){
        if(!$params){
            $params = array();
        }
        $params["method"] = $method;
        $ch = curl_init(TELEGRAM_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
        $result = curl_exec($ch);
        return $result;
    }

    /**
     * Converts text to an image using the ImgBun API
     *
     * @param string $text The text to be converted to an image
     * @return string The JSON response from the ImgBun API
     */
    function Text2Image($text){
        $endpoint = "https://api.imgbun.com/png";
        $api_key = API_KEY;
        $params = array(
            "key" => $api_key,
            "text" => $text,
            "size" => "40"
        );
        $ch = curl_init();
        $queryString = http_build_query($params);
        curl_setopt($ch, CURLOPT_URL, $endpoint.'?'.$queryString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return $response;
    }

    /**
     * Returns predefined text messages based on the given key
     *
     * @param string $msg The key for the desired text message
     * @return string The corresponding text message
     */
    function Text($msg){
        $welcome = "Welcome to the Text to Image Bot.  🤗
Type anything to get that text as an image. 💬🖼";
        $message = "Type anything to get that text as an image. 💬🖼";
        $help = "It's a bot to convert text to image. 💬 -> 🖼
Just type anything you want to convert to image.";
        $info = "ℹ️ Bot Information:
🧑🏻‍💻 Creator: @Meytttii
🔁 API Site: https://imgbun.com
#️⃣ Programming Language: PHP";
        if($msg == "welcome"){return $welcome;}
        if($msg == "help"){return $help;}
        if($msg == "info"){return $info;}
        if($msg == "msg"){return $message;}
    }

    // Get the content from the incoming request
    $content = file_get_contents('php://input');
    $update = json_decode($content, true);
    $chat_id = $update['message']['chat']['id'];
    $text = $update['message']['text'];
    $message_id = $update['message']['message_id'];

    // Handle different commands and text inputs
    if($text == '/start')
    {
        msg('sendMessage', array('chat_id'=>$chat_id, 'text'=>Text('welcome'), 'reply_markup' => array('resize_keyboard' => true, 'keyboard' => array(array('Help❔','Info❕')))));
    }
    elseif($text == 'Help❔')
    {
        msg('sendMessage', array('chat_id'=>$chat_id, 'text'=>Text('help')));
    }
    elseif($text == 'Info❕')
    {
        msg('sendMessage', array('chat_id'=>$chat_id, 'text'=>Text('info'), 'link_preview_options' => ['url' => 'https://t.me/Meytttii'],'reply_markup' => array('resize_keyboard' => true, 'inline_keyboard' => array(array(array('text' => '😼 GitHub', 'url' => 'https://github.com/MehdiSlr'))))));
    }
    else
    {
        // Convert text to image and send the image
        $T2I_Response = json_decode(Text2Image($text), true);
        $ImageUrl = $T2I_Response['direct_link'];
        msg('sendPhoto', array('chat_id'=>$chat_id, 'photo'=>$ImageUrl, 'reply_to_message_id'=>$message_id, 'caption'=>'@Text2SampleImgBot'));
        msg('sendMessage', array('chat_id'=>$chat_id, 'text'=>Text('msg')));
    }
?>
