<?php

namespace SV\UserPromoOnUpdate\XF\Service\User;

/**
 * Extends \XF\Service\User\Upgrade
 */
class Upgrade extends XFCP_Upgrade
{
    public function upgrade()
    {
        $active = parent::upgrade();
        if ($active)
        {
            $user = $this->user;
            \XF::runOnce('profileUpdatePromotion.u' . $user->user_id, function () use ($user) {
                /** @var \XF\Repository\UserGroupPromotion $usergroupRepo */
                $usergroupRepo = \XF::repository('XF:UserGroupPromotion');
                $usergroupRepo->updatePromotionsForUser($user);
            });
        }

        return $active;
    }
}
