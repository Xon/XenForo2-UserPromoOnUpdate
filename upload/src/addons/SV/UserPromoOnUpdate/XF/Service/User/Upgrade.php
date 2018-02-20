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
            /** @var \XF\Repository\UserGroupPromotion $usergroupRepo */
            $usergroupRepo = \XF::repository('XF:UserGroupPromotion');
            $usergroupRepo->updatePromotionsForUser($this->user);
        }

        return $active;
    }
}
