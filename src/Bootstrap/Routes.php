<?php

namespace Message\Mothership\ReferAFriend\Bootstrap;

use Message\Cog\Bootstrap\RoutesInterface;

class Routes implements RoutesInterface
{
	public function registerRoutes($router)
	{
		$router['ms.cp.refer_a_friend']->setParent('ms.cp')->setPrefix('/refer-a-friend');
		$router['ms.cp.refer_a_friend']->add('ms.cp.refer_a_friend.dashboard', '/', 'Message:Mothership:ReferAFriend::Controller:Dashboard#index');
		$router['ms.cp.refer_a_friend']->add('ms.cp.refer_a_friend.createAction', '/create', 'Message:Mothership:ReferAFriend::Controller:Reward#createAction')
			->setMethod('POST')
		;
		$router['ms.cp.refer_a_friend']->add('ms.cp.refer_a_friend.create', '/create', 'Message:Mothership:ReferAFriend::Controller:Reward#create');
		$router['ms.cp.refer_a_friend']->add('ms.cp.refer_a_friend.set_options_action', '/options/{type}', 'Message:Mothership:ReferAFriend::Controller:Reward#setOptionsAction')
			->setRequirement('type', '[a-z0-9\-_\/]+')
			->setMethod('POST')
		;
		$router['ms.cp.refer_a_friend']->add('ms.cp.refer_a_friend.set_options', '/options/{type}', 'Message:Mothership:ReferAFriend::Controller:Reward#setOptions')
			->setRequirement('type', '[a-z0-9\-_\/]+')
			->setMethod('GET')
		;
	}
}