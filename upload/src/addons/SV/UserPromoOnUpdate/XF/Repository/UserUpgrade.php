<?php

namespace SV\UserPromoOnUpdate\XF\Repository;

use XF\Entity\UserUpgradeActive;
use XF\Entity\UserUpgradeExpired;

/**
 * Extends \XF\Repository\UserUpgrade
 */
class UserUpgrade extends XFCP_UserUpgrade
{
    public function expireActiveUpgrade(UserUpgradeActive $active, UserUpgradeExpired $expired = null)
    {
        parent::expireActiveUpgrade($active, $expired);
        $user = $expired->User;
        if ($user)
        {
            \XF::runOnce('profileUpdatePromotion.u' . $user->user_id, function () use ($user) {
                /** @var \XF\Repository\UserGroupPromotion $usergroupRepo */
                $usergroupRepo = \XF::repository('XF:UserGroupPromotion');
                $usergroupRepo->updatePromotionsForUser($user);
            });
        }
    }
}
