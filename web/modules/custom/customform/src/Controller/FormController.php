<?php
namespace Drupal\customform\Controller;
use Drupal\node\NodeInterface;
use Drupal\Core\Access\AccessResult;

class FormController {

public function staticContent () {
	return [
	'#markup' => "Hello this not my custom form"
 ];
}

public function dynamicContent ($arg) {
	return [
	'#markup' => "Helloo this is the argument => ".$arg
	];
}
public function upcastedContent (NodeInterface $node) {
	return [
	'#markup' => "this is the title =>".$node->getTitle()
 ];	
}
public function nodeAccessCheck(NodeInterface $node) {
	$id= \Drupal::service('current_user')->id();
	if($node->getOwnerID() === $id) {
			return AccessResult::allowed();
		}
		else {
			return AccessResult::forbidden();
		}
	}
}