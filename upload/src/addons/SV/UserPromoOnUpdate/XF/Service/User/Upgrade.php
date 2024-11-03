<?php

namespace SV\UserPromoOnUpdate\XF\Service\User;

use SV\UserPromoOnUpdate\Globals;

/**
 * @extends \XF\Service\User\Upgrade
 */
class Upgrade extends XFCP_Upgrade
{
    public function upgrade()
    {
        $active = parent::upgrade();
        if ($active)
        {
            Globals::queueUserPromotion($this->user);
        }

        return $active;
    }
}
