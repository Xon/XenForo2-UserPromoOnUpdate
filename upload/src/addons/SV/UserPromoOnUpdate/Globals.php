<?php

namespace SV\UserPromoOnUpdate;


class Globals
{
    public static function queueUserPromotion(\XF\Entity\User $user = null, \Closure $callback = null)
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
        \XF::runOnce('profileUpdatePromotion.u' . $userId, function () use ($user, $callback) {
            if (!$user->exists())
            {
                return;
            }

            if ($callback)
            {
                $callback();
            }

            /** @var \XF\Repository\UserGroupPromotion $userGroupRepo */
            $userGroupRepo = \XF::repository('XF:UserGroupPromotion');
            $userGroupRepo->updatePromotionsForUser($user);
        });
    }

    /**
     * Private constructor, use statically.
     */
    private function __construct() { }
}