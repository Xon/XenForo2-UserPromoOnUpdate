<?php

namespace SV\UserPromoOnUpdate;


use SV\StandardLib\Helper;
use XF\Entity\User as UserEntity;
use XF\Repository\UserGroupPromotion as UserGroupPromotionRepo;

abstract class Globals
{
    public static function queueUserPromotion(?UserEntity $user = null, ?\Closure $callback = null)
    {
        if ($user === null)
        {
            return;
        }
        $userId = (int)$user->user_id;
        if ($userId === 0)
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

            $userGroupRepo = Helper::repository(UserGroupPromotionRepo::class);
            $userGroupRepo->updatePromotionsForUser($user);
        });
    }

    /**
     * Private constructor, use statically.
     */
    private function __construct() { }
}