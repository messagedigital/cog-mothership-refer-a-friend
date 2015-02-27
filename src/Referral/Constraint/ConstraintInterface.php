<?php

namespace Message\Mothership\ReferAFriend\Referral\Constraint;

use Message\Mothership\ReferAFriend\Referral\ReferralEntityInterface;
use Message\Mothership\ReferAFriend\Referral\ReferralInterface;
use Symfony\Component\Form\FormBuilderInterface;

interface ConstraintInterface extends ReferralEntityInterface
{
	/**
	 * @param ReferralInterface $referral
	 */
	public function validate(ReferralInterface $referral);

	/**
	 * @param $value
	 */
	public function setValue($value);

	/**
	 * @return mixed
	 */
	public function getValue();

	/**
	 * @return string | FormBuilderInterface
	 */
	public function getFormType();

	/**
	 * @return array
	 */
	public function getFormOptions();
}