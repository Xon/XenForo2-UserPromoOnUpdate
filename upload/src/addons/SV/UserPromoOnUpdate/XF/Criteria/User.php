<?php

namespace SV\UserPromoOnUpdate\XF\Criteria;

class User extends XFCP_User
{
	protected function isSpecialMatched($rule, array $data, \XF\Entity\User $user)
	{
		$result = parent::isSpecialMatched($rule, $data, $user);

		if ($result === false && preg_match('/^user_field_(.+)$/', $rule, $matches))
		{
			/** @var \XF\CustomField\Set|null $cFS */
			$cFS = $user->user_id ? $user->Profile->custom_fields : null;

			$fieldId = $matches[1];

			if (!$cFS || !isset($cFS->{$fieldId}))
			{
				return false;
			}

			$value = $cFS->{$fieldId};

			if (empty($value) && empty($data['text']))
			{
				return true;
			}
		}

		return $result;
	}
}