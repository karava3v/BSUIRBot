<?php
/**
 * Created by PhpStorm.
 * User: karavaev
 * Date: 15.03.17
 * Time: 10:47 AM
 */

namespace BSUIRBot\Exception;


class GroupNotFoundException extends \Exception
{
    /**
     * @return string
     */
    public function returnMessage(): string
    {
        return $this->getMessage();
    }
}