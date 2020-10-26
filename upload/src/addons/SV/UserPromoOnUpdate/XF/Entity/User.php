<?php

namespace SV\UserPromoOnUpdate\XF\Entity;

use SV\UserPromoOnUpdate\Globals;

class User extends XFCP_User
{
    protected function _postSave()
    {
        parent::_postSave();
        Globals::queueUserPromotion($this);
    }
}