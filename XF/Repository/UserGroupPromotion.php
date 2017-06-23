<?php

namespace SV\UserPromoOnUpdate\XF\Repository;

class UserGroupPromotion extends XFCP_UserGroupPromotion
{
	public function updatePromotionsForUser(\XF\Entity\User $user, $userGroupPromotionLogs = null, $userGroupPromotions = null)
	{
		return parent::updatePromotionsForUser($user, $userGroupPromotionLogs, $userGroupPromotions);
	}
}