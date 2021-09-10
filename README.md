# PHP клиент для работы с API Bothelp.io


## Требования
* PHP >= 7.1
* [symfony/http-client](https://github.com/symfony/http-client)


## Установка
```sh
composer require semivan/bothelp-api-client
```


## Использование
```php
$client = new \Bothelp\BothelpClient();

// Получить всех подписчиков
$subscribers = $client->subscribers()->getAll();

// Добавить подписчику теги
$client->subscribers()->addTags($subscriberId, ['tag1', 'tag2', 'tag3']);

// Удалить у подписчика теги
$client->subscribers()->removeTags($subscriberId, ['tag1', 'tag2']);

// Изменить полное имя подписчика
$client->subscribers()->replaceName($subscriberId, 'name');

// Изменить имя подписчика
$client->subscribers()->replaceFirstName($subscriberId, 'firstname');

// Изменить фамилию подписчика
$client->subscribers()->replaceLastName($subscriberId, 'lastname');

// Изменить номер телефона подписчика
$client->subscribers()->replacePhone($subscriberId, '+71234567890');

// Изменить email подписчика
$client->subscribers()->replaceEmail($subscriberId, 'email@example.com');

// Изменить заметку подписчика
$client->subscribers()->replaceNote($subscriberId, 'note');

// Изменить пользовательское поле подписчика
$client->subscribers()->replaceCustomField($subscriberId, 'custom field value');

// Отправить подписчику сообщение
$client->subscribers()->sendMessage($subscriberId, 'message text');
```
