<?php

namespace SV\UserPromoOnUpdate;

use XF\Entity\User;

class Listener
{
    public static function userEntityPostSave(User $user)
    {
        if (!$user->exists())
        {
            return;
        }
        // This will queue a task to run at the end of the request. If this is called more than once,
        // it will replace the previous one, ensuring the update only runs once per request.x
        \XF::runOnce('profileUpdatePromotion.u' . $user->user_id, function () use ($user) {
            if (!$user->exists())
            {
                return;
            }

            /** @var \XF\Repository\UserGroupPromotion $usergroupRepo */
            $usergroupRepo = \XF::repository('XF:UserGroupPromotion');
            $usergroupRepo->updatePromotionsForUser($user);
        });
    }
}
