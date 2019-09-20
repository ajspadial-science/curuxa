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
                          'category' => 'generic')
                        ),
            $this->getDisplayName()
          ),
          'Bot settings',
          null
        ),
      ):array(),
      parent::getActions($request, $verb)
    );
  }

  /**
   * Launch actions
   * 1 .- Bot settings
   */
  function manage($args, $request) {
    switch ($request->getUserVar('verb')) {
      case 'settings':
        $context = $request->getContext();

        $templateMgr = TemplateManager::getManager($request);
        $templateMgr->registerPlugin('function', 'plugin_url', array($this, 'smartyPluginUrl'));

        $this->import('TwitterBotSettingsForm');
        $form = new TwitterBotSettingsForm($this, $context->getId());

        if ($request->getUserVar('save')) {
          $form->readInputData();
          if ($form->validate()) {
            $form->execute();
            return new JSONMessage(true);
          }
        } else {
          $form->initData();
        }
        return new JSONMessage(true, $form->fetch($request));
    }
    return parent::manage($args, $request);
  }

}
   