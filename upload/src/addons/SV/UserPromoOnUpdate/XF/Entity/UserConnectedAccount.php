<?php

namespace SV\UserPromoOnUpdate\XF\Entity;

use SV\UserPromoOnUpdate\Globals;

/**
 * @extends \XF\Entity\UserConnectedAccount
 */
class UserConnectedAccount extends XFCP_UserConnectedAccount
{
    protected function _postSave()
    {
        parent::_postSave();
        if ($this->isInsert())
        {
            Globals::queueUserPromotion($this->User, function () {
                $this->User->clearCache('ConnectedAccounts');
            });
        }
    }

    protected function _postDelete()
    {
        parent::_postDelete();
        Globals::queueUserPromotion($this->User, function () {
            $this->User->clearCache('ConnectedAccounts');
        });
    }
}