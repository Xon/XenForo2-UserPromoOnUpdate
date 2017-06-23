<?php

namespace SV\UserPromoOnUpdate;

use XF\Entity\User;

class Listener
{
	public static function userEntityPostSave(User $user)
	{
		\XF::runOnce('profileUpdatePromotion.u' . $user->user_id, function () use ($user)
		{
			\XF::repository('XF:UserGroupPromotion')->updatePromotionsForUser($user);
		});
	}
}