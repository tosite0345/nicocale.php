<?php

namespace App;


class Slack extends SlackBase
{
    public function channelsList()
    {
        $res = $this->httpGet('channels.list');
        return $res['channels']; // [0 => [...]]
    }

    public function emojiList()
    {
        $res = $this->httpGet('emoji.list');
        return $res['emoji']; // ['name' => 'png']
    }

    public function usersProfileGet()
    {
        $res = $this->httpGet('users.profile.get');
        return (object)$res['profile'];
    }

    // https://api.slack.com/methods/users.profile.set/test
    // {"status_text":"test","status_emoji":":100:","status_expiration":0}
    // profile=%7B%22status_text%22%3A%22test%22%2C%22status_emoji%22%3A%22%3A100%3A%22%7D
    public function usersProfileSet($status_text = '', $status_emoji = '')
    {
        $params = [
            'status_text' => $status_text,
            'status_emoji' => $status_emoji,
            'status_expiration' => strtotime(date('Y/m/d 23:59:59')),
        ];

        if (empty($status_text) && empty($status_emoji)) throw new \Exception('params not exist');
        $query = $this->to_query($params);
        return $this->httpPost('users.profile.set', "&profile={$query}");
    }

}
