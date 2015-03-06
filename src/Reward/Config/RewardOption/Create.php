<?php

namespace Message\Mothership\ReferAFriend\Reward\Config\RewardOption;

use Message\Mothership\ReferAFriend\Reward\Config\ConfigInterface;

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

	public function save(ConfigInterface $config)
	{
		foreach ($config->getRewardOptions() as $rewardOption) {
			$this->_addToTransaction($config, $rewardOption);
		}

		$this->_commitTransaction();
	}

	private function _addToTransaction(ConfigInterface $config, RewardOptionInterface $rewardOption)
	{
		$this->_transaction->add("
			INSERT INTO
				refer_a_friend_reward_option
				(
					reward_config_id,
					`name`,
					`value`
				)
				VALUES
				(
					:rewardConfigID?i,
					:name?s,
					:value?s
				)
		", [
			'rewardConfigID' => $config->getID(),
			'name'           => $rewardOption->getName(),
			'value'          => $rewardOption->getValue(),
		]);
	}

	private function _commitTransaction()
	{
		if (false === $this->_transOverride) {
			$this->_transaction->commit();
		}
	}
}