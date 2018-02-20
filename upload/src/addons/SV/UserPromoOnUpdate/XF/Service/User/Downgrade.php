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
            /** @var \XF\Repository\UserGroupPromotion $usergroupRepo */
            $usergroupRepo = \XF::repository('XF:UserGroupPromotion');
            $usergroupRepo->updatePromotionsForUser($this->user);
        }

        return $active;
    }
}
