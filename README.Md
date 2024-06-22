# Text to Image Telegram Bot

This project is a simple Telegram bot that converts text messages into images using the ImgBun API. Users can interact with the bot to receive images generated from their text inputs.

## Features

- Converts text messages into images.
- Responds with a welcome message, help information, and bot information.
- Uses the ImgBun API for image generation.

## Technologies Used

- PHP
- Telegram Bot API
- cURL for making HTTP requests

## Setup

Follow these steps to set up the bot locally:

### Prerequisites

- PHP installed on your server or local machine.
- A Telegram bot token from BotFather.
- An API key from ImgBun.

### Configuration

1. Create a bot token from BotFather.

2. Create an API key from ImgBun.

3. Clone the repository

```bash
git clone https://github.com/MehdiSlr/Text2Img_Bot.git
cd Text2Img_Bot
```

4. Create a `config.php` file 

Create a `config.php` file in the root directory and add your bot token and ImgBun API key:

```php
<?php
$bot_token = 'YOUR_TELEGRAM_BOT_TOKEN';
$api_key = 'YOUR_IMGBUN_API_KEY';
?>
```

5. Deploy the bot

Upload the bot script `index.php` and `config.php` to your server. Set the webhook for your bot using the Telegram API:

```bash
https://api.telegram.org/bot<YOUR_TELEGRAM_BOT_TOKEN>/setWebhook?url=https://<YOUR_DOMAIN>/index.php
```

## Usage

- Start the Bot: Send `/start` to the bot to receive a welcome message.
- Get Help: Click on `Help❔` to receive help information.
- Get Info: Click on `Info❕` to receive bot information.
- Convert Text to Image: Type any text message, and the bot will respond with an image of the text.

## Acknowledgements

- [ImgBun](https://imgbun.com) API for text to image conversion.
- [Telegram](https://core.telegram.org/bots/api) for the Telegram bot API.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Support

If you have any questions or feedback, please [open an issue](https://github.com/MehdiSlr/Text2Img_Bot/issues/new) on GitHub.

## Author

Created by [Mehdi Salari](https://github.com/MehdiSlr) - Telegram [Meytttii](https://t.me/Meytttii).

