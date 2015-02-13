<?php

namespace Message\Mothership\ReferAFriend\Reward\Constraint;

use Message\Cog\ValueObject\Collection as BaseCollection;

class Collection extends BaseCollection
{
	protected function _configure()
	{
		$this->addValidator(function($item) {
			if (!$item instanceof ConstraintInterface) {
				$type = gettype($item) === 'object' ? get_class($item) : gettype($item);
				throw new \InvalidArgumentException('Item must be an instance of ' . __NAMESPACE__ . '\\ConstraintInterface, ' . $type . ' given');
			}
		});
		$this->setKey(function($item) {
			return $item->getID();
		});
	}

}