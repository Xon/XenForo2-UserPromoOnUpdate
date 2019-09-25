<?php

namespace SV\UserPromoOnUpdate\XF\Service\User;



/**
 * Extends \XF\Service\User\Downgrade
 */
class Downgrade extends XFCP_Downgrade
{
    public function downgrade()
    {
        $active = parent::downgrade();
        if ($active)
        {
            $user = $this->user;
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

        return $active;
    }
}
