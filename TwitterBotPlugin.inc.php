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

  /**
   * Provide additional setting action
   */
  function getActions($request, $verb) {
    $router = $request->getRouter();
    import('lib.pkp.classes.linkAction.request.AjaxModal');
    return array_merge(
      $this->getEnabled()?array(
        new LinkAction(
          'settings',
          new AjaxModal(
            $router->url($request,
                        null,
                        null,
                        'manage',
                        null,
                        array(
                          'verb' => 'settings',
                          'plugin' => $this->getName(),
                          'category' => 'generic')),
            $this->getDisplayName()
          ),
          'Bot settings',
          null
        ),
      ):array(),
      parent::getActions($request, $verb)
    );
  }

}
   