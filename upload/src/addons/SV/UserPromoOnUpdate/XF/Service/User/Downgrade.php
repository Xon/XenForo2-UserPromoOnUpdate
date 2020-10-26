<?php

namespace SV\UserPromoOnUpdate\XF\Service\User;

use SV\UserPromoOnUpdate\Globals;

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
            Globals::queueUserPromotion($this->user);
        }

        return $active;
    }
}
