<?php

namespace Message\Mothership\ReferAFriend\Reward\Config\Trigger;

use Message\Cog\DB\Transaction;
use Message\Cog\DB\TransactionalInterface;

class Create implements TransactionalInterface
{
	private $_transaction;
	private $_transOverride = false;

	public function __construct(Transaction $transaction)
	{
		$this->_transaction = $transaction;
	}

	public function setTransaction(Transaction $transaction)
	{
		$this->_transaction   = $transaction;
		$this->_transOverride = true;
	}

	public function save(TriggerInterface $trigger)
	{
		$this->_addToTransaction($trigger);
		$this->_commitTransaction();
	}

	public function saveBatch($triggers)
	{
		if (!$triggers instanceof Collection || !is_array($triggers)) {
			$type = gettype($triggers) === 'object' ? get_class($triggers) : gettype($triggers);
			throw new \InvalidArgumentException('$triggers must be an instance of Trigger\\Collection or an array, ' . $type . ' given');
		}

		foreach ($triggers as $trigger) {
			$this->_addToTransaction($trigger);
		}

		$this->_commitTransaction();
	}

	private function _addToTransaction(TriggerInterface $trigger)
	{
		$this->_transaction->add("
			INSERT INTO
				refer_a_friend_reward_trigger
				(
					reward_config_id,
					`name`
				)
				VALUES
				(
					:rewardConfigID?i,
					:name?s
				)
		", [
			'rewardConfigID' => $trigger->getRewardConfig()->getID(),
			'name'           => $trigger->getName(),
		]);
	}

	private function _commitTransaction()
	{
		if (false === $this->_transOverride) {
			$this->_transaction->commit();
		}
	}
}