<?php

namespace SV\UserPromoOnUpdate;

use XF\Entity\User;

class Listener
{
    public static function userEntityPostSave(User $user)
    {
        Globals::queueUserPromotion($user);
    }
}
