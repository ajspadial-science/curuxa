<?php
import('lib.pkp.classes.plugins.GenericPlugin');
class TwitterBotPlugin extends GenericPlugin {

  public function register($category, $path, $mainContextId = NULL) {

    // register the plugin even when it is not enabled
    $success = parent::register($category, $path);

    if ($success && $this->getEnabled()) {
      // TODO
    }

    return $success;
  }

  /**
   * Provide a name to the plugin
   */
  public function getDisplayName() {
    return "Twitter Bot";
  }

  /**
   * Provide a description to the plugin
   */
  public function getDescription() {
    return "The electronic community manager for your scholar journal";
  }

}
   