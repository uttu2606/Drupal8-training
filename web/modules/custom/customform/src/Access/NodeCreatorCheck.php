<?php

namespace Drupal\customform\Access;
use Drupal\Core\Session\AccountProxy;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\node\NodeInterface;
use Drupal\Core\Access\AccessResult;

class NodeCreatorCheck implements AccessInterface {
	private $account;
	public function __construct(AccountProxy $account) {
		$this->account =$account;
	}
	public function access(NodeInterface $node) {
		if($node->getOwnerID() === $this->account->id()) {
			return AccessResult::allowed();
		}
		else {
			return AccessResult::forbidden();
		}
	}
}