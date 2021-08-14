<?php

namespace SV\UserPromoOnUpdate\XF\Criteria;

class User extends XFCP_User
{
    protected function isSpecialMatched($rule, array $data, \XF\Entity\User $user)
    {
        $result = parent::isSpecialMatched($rule, $data, $user);

        if (!empty($data['matchNone']) && \preg_match('/^user_field_(.+)$/', $rule, $matches))
        {
            /** @var \XF\CustomField\Set $cFS */
            $cFS = $user->user_id ? $user->Profile->custom_fields : null;
            if (!$cFS)
            {
                return false;
            }

            $fieldId = $matches[1];

            $value = $cFS->offsetExists($fieldId) ? $cFS->offsetGet($fieldId) : '';

            return $value === '' || $value === [];
        }

        return $result;
    }
}
