## About

Simple script for firebase integration

## Requirements
- [FCM_TOKEN] Console Firebase > Project > Config Project > Cloud Messaging > Server key.

## Send Cloud Message
```php
require __DIR__ . '/vendor/autoload.php';
use Deigon\SDK\Firebase;

$fcm ='zNJqWVtVhWqaDwJc0uWofYYt5brlx5M86-AQnQ7KJWBqb7wQLk1iYmpA8ZirylKDL';

$device_token = 'Y4b2dXWWA-OJqke9wLQNmHrPAQnQ7KJWBqb7wQLk1iYmpA8ZirylKDL_PBOJKmajpHZrVsUdsSrgoCcJOs971x6F7v6gAlJ3yiGJ9tU7FD5dnsep_oBVzLu';
$title = 'Hello';
$message = 'Example message Lorem';

$firebase = new Firebase($fcm);
$firebase->sendCloudMessage($device_token, $title, $message);
```
## Send Various Cloud Messages
```php
require __DIR__ . '/vendor/autoload.php';
use Deigon\SDK\Firebase;

$devices_token = [
'Y4b2dXWWA-OJqke9wLQNmHrPAQnQ7KJWBqb7wQLk1iYmpA8ZirylKDL_PBOJKmajpHZrVsUdsSrgoCcJOs971x6F7v6gAlJ3yiGJ9tU7FD5dnsep_oBVzLu',
'OJqke9wLQNmHrPAQY4b2dXWWA-nQ7KJWBqb7wQLk1iYmpA8ZirylKDL_PBOJKmajpF7v6gAlJ3yiGJ9tU7FD5dnsep_oBVzLHZrVsUdsSrgoCcJOs971x6u',
'rPAQnQ7KJWBqb7wQLLQNmHrPAQY4b2dXWWA-nQ7KJWBqb7wQLpA8ZirylKDL_PBOJKmajpF7v6gAlJ3yiGJ9tU7FD5dnsep_oBVzLHZrVsUdsSrgoCcJOs9',
];
$title = 'Hello';
$message = 'Example message Lorem';

$firebase = new Firebase($fcm);
$firebase->sendMultipleCloudMessage($devices_token, $title, $message);
```

## Security Vulnerabilities

If you discover a security vulnerability within, please send an e-mail to Deigon Prates via [deigonprates@gmail.com](mailto:deigonprates@gmail.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
