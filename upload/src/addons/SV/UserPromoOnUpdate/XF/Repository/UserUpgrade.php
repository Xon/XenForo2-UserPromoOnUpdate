<?php

namespace SV\UserPromoOnUpdate\XF\Repository;

use SV\UserPromoOnUpdate\Globals;
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
        if ($expired)
        {
            Globals::queueUserPromotion($expired->User);
        }
    }
}
