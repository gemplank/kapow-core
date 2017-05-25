<?php
/**
 * Class Controller_Formatting
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

namespace kapow\kapow_core;

/**
 * The main loader for the formatting
 */
class Controller_Formatting {

	/**
	 * Body Classes
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $body_classes;

	/**
	 * IFrames
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $iframes;

	/**
	 * Responsive Embeds
	 *
	 * @var 	object
	 * @access	private
	 * @since	0.1.0
	 */
	private $responsive_embeds;

	/**
	 * Constructor.
	 *
	 * @param Body_Classes      $body_classes      Body Classes.
	 * @param iFrames           $iframes           iFrames.
	 * @param Responsive_Embeds $responsive_embeds Responsive Embeds.
	 *
	 * @since 0.1.0
	 */
	public function __construct(
		Body_Classes $body_classes,
		iFrames $iframes,
		Responsive_Embeds $responsive_embeds
	) {
		$this->body_classes      = $body_classes;
		$this->iframes           = $iframes;
		$this->responsive_embeds = $responsive_embeds;
	}

	/**
	 * Go.
	 *
	 * @since		0.1.0
	 */
	public function run() {
		$this->body_classes->run();
		$this->iframes->run();
		$this->responsive_embeds->run();
	}
}
