<?php

namespace Bothelp\Operations;

use Bothelp\BothelpApi;
use Bothelp\Object\Subscriber;

class SubscriberOperations
{
    /** @var BothelpApi */
    private $api;

    public function __construct(BothelpApi $api)
    {
        $this->api = $api;
    }

    /**
     * Получить всех подписчиков
     *
     * @param array $params ['after' => 0, 'createdAtAfter' => 1577836800]
     * @return Subscriber[]
     * @throws \Throwable
     */
    public function getAll(array $params = []): array
    {
        $params['after'] = $params['after'] ?? 0;
        $data            = $this->api->request('subscribers', $params, 'GET');
        $params['after'] = $data['paging']['cursor']['after'] ?? 0;
        $result          = array_map(function($data) {
            return new Subscriber($data);
        }, $data['data'] ?? []);

        if ($params['after'] && $result) {
            $result = array_merge($result, $this->getAll($params));
        }

        return $result;
    }

    /**
     * Добавить подписчику теги
     *
     * @param int $subscriberId ID подписчика
     * @param array $tags Массив тегов
     * @return array ['success' => true]
     * @throws \Throwable
     */
    public function addTags(int $subscriberId, array $tags = []): array
    {
        return $this->api->request('subscribers/'. $subscriberId, [[
            'op'    => 'add',
            'path'  => '/tags',
            'value' => $tags,
        ]], 'PATCH');
    }

    /**
     * Удалить у подписчика теги
     *
     * @param int $subscriberId ID подписчика
     * @param array $tags Массив тегов
     * @return array ['success' => true]
     * @throws \Throwable
     */
    public function removeTags(int $subscriberId, array $tags = []): array
    {
        return $this->api->request('subscribers/'. $subscriberId, [[
            'op'    => 'remove',
            'path'  => '/tags',
            'value' => $tags,
        ]], 'PATCH');
    }

    /**
     * Изменить полное имя подписчика
     *
     * @param int $subscriberId ID подписчика
     * @param string $name Полное имя
     * @return array ['success' => true]
     * @throws \Throwable
     */
    public function replaceName(int $subscriberId, string $name): array
    {
        return $this->api->request('subscribers/'. $subscriberId, [[
            'op'    => 'replace',
            'path'  => '/name',
            'value' => $name,
        ]], 'PATCH');
    }

    /**
     * Изменить имя подписчика
     *
     * @param int $subscriberId ID подписчика
     * @param string $firstName Имя
     * @return array ['success' => true]
     * @throws \Throwable
     */
    public function replaceFirstName(int $subscriberId, string $firstName): array
    {
        return $this->api->request('subscribers/'. $subscriberId, [[
            'op'    => 'replace',
            'path'  => '/firstName',
            'value' => $firstName,
        ]], 'PATCH');
    }

    /**
     * Изменить фамилию подписчика
     *
     * @param int $subscriberId ID подписчика
     * @param string $lastName Фамилия
     * @return array ['success' => true]
     * @throws \Throwable
     */
    public function replaceLastName(int $subscriberId, string $lastName): array
    {
        return $this->api->request('subscribers/'. $subscriberId, [[
            'op'    => 'replace',
            'path'  => '/lastName',
            'value' => $lastName,
        ]], 'PATCH');
    }

    /**
     * Изменить номер телефона подписчика
     *
     * @param int $subscriberId ID подписчика
     * @param string $phone Номер телефона
     * @return array ['success' => true]
     * @throws \Throwable
     */
    public function replacePhone(int $subscriberId, string $phone): array
    {
        return $this->api->request('subscribers/'. $subscriberId, [[
            'op'    => 'replace',
            'path'  => '/phone',
            'value' => $phone,
        ]], 'PATCH');
    }

    /**
     * Изменить email подписчика
     *
     * @param int $subscriberId ID подписчика
     * @param string $email Email
     * @return array ['success' => true]
     * @throws \Throwable
     */
    public function replaceEmail(int $subscriberId, string $email): array
    {
        return $this->api->request('subscribers/'. $subscriberId, [[
            'op'    => 'replace',
            'path'  => '/email',
            'value' => $email,
        ]], 'PATCH');
    }

    /**
     * Изменить заметку подписчика
     *
     * @param int $subscriberId ID подписчика
     * @param string $note Заметка
     * @return array ['success' => true]
     * @throws \Throwable
     */
    public function replaceNote(int $subscriberId, string $note): array
    {
        return $this->api->request('subscribers/'. $subscriberId, [[
            'op'    => 'replace',
            'path'  => '/notes',
            'value' => $note,
        ]], 'PATCH');
    }

    /**
     * Изменить пользовательское поле подписчика
     *
     * @param int $subscriberId ID подписчика
     * @param string $customField Значение пользовательского поля
     * @return array ['success' => true]
     * @throws \Throwable
     */
    public function replaceCustomField(int $subscriberId, string $customField): array
    {
        return $this->api->request('subscribers/'. $subscriberId .'/customFields', [[
            'op'    => 'replace',
            'path'  => '/webinar',
            'value' => $customField,
        ]], 'PATCH');
    }

    /**
     * Отправить подписчику сообщение
     *
     * @param int $subscriberId ID подписчика
     * @param string $content Текст сообщения
     * @return array ['success' => true]
     * @throws \Throwable
     */
    public function sendMessage(int $subscriberId, string $content): array
    {
        return $this->api->request('subscribers/'. $subscriberId .'/messages', [[
            'content' => $content,
        ]], 'POST');
    }
}