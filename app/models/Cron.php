<?php
/**
 * Created by PhpStorm.
 * User: karavaev
 * Date: 13.03.17
 * Time: 5:39 PM
 */

namespace app\models;

use app\drivers\Redis;
use app\models\bots\Telegram;
use app\Config;

class Cron
{
    public static function writeToCronUsers()
    {
       $bot      = new Telegram(Config::getTGtoken());
       $debugBot = new Telegram(Config::getTGDebugToken());

       $Redis = new Redis();
       $cronUsers = $Redis->getCronUsers();

        $date = BSUIR::getDate(time());
        foreach ($cronUsers as $userRedis) {
            $user = (object) $Redis->getCurrentUser("user:$userRedis");
            $msg = 'Доброе утро, '.$user->{'display_name'}.PHP_EOL.
                'Сегодня твои занятия:'.PHP_EOL.BSUIR::parseSchedule(BSUIR::getGroupSchedule(BSUIR::getGroupID($user->{'group_id'}), $date['day'], $date['week']));
            $bot->sendMessage($user->{'user_id'}, $msg);
        }
        $debugBot->sendMessage($bot->debugchat, 'Обновил группы. Выслал всем сообщения!');
    }
}