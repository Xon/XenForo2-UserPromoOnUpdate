<?php

namespace SV\UserPromoOnUpdate;


class Globals
{
    public static function queueUserPromotion(\XF\Entity\User $user = null)
    {
        if (!$user)
        {
            return;
        }
        $userId = $user->user_id;
        if (!$userId)
        {
            return;
        }

        // This will queue a task to run at the end of the request. If this is called more than once,
        // it will replace the previous one, ensuring the update only runs once per request.x
        \XF::runOnce('profileUpdatePromotion.u' . $userId, function () use ($user) {
            if (!$user->exists())
            {
                return;
            }

            /** @var \XF\Repository\UserGroupPromotion $usergroupRepo */
            $usergroupRepo = \XF::repository('XF:UserGroupPromotion');
            $usergroupRepo->updatePromotionsForUser($user);
        });
    }

    /**
     * Private constructor, use statically.
     */
    private function __construct() { }
}