<?php

namespace Drupal\customform\Controller;

use Drupal\node\NodeInterface;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Session\AccountProxy;

class FormController implements ContainerInjectionInterface {
	private $account;
	public function __construct(AccountProxy $account) {
		$this->account = $account;
	}
	public function staticContent() {
		return [
				'#markup' => "Hello this not my custom form"
		];
	}
	public function dynamicContent($arg) {
		return [
				'#markup' => "Helloo this is the argument => " . $arg
		];
	}
	public function upcastedContent(NodeInterface $node) {
		return [
				'#markup' => "this is the title =>" . $node->getTitle ()
		];
	}
	public function nodeAccessCheck(NodeInterface $node) {
		if ($node->getOwnerID () === $this->account->id ()) {
			return AccessResult::allowed ();
		} else {
			return AccessResult::forbidden ();
		}
	}
	public static function create(ContainerInterface $container) {
		return new static ( $container->get ( current_user ) );
	}
}