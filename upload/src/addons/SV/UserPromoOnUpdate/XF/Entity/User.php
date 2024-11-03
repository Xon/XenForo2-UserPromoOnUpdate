<?php

namespace SV\UserPromoOnUpdate\XF\Entity;

use SV\UserPromoOnUpdate\Globals;

/**
 * @extends \XF\Entity\User
 */
class User extends XFCP_User
{
    protected function _postSave()
    {
        parent::_postSave();
        Globals::queueUserPromotion($this);
    }
}