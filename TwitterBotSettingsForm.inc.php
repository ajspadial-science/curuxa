<?php

import('lib.pkp.classes.form.Form');

class TwitterBotSettingsForm extends Form {

    /** @var int */
    var $_journalId;

    /** @var object */
    var $_plugin;

    /**
     * Constructor
     */
    function __construct($plugin, $journalId) {
        $this->_plugin = $plugin;
        $this->_journalId = $journalId;
        parent::__construct($plugin->getTemplateResource('settingsForm.tpl'));

        $this->addCheck(new FormValidator($this, 'oauth_access_token', 'required', 'OAuth Access Token needed'));
        $this->addCheck(new FormValidator($this, 'oauth_access_token_secret', 'required', 'OAuth Access Token Secret needed'));
        $this->addCheck(new FormValidator($this, 'consumer_key', 'required', 'Consumer Key needed'));
        $this->addCheck(new FormValidator($this, 'consumer_secret', 'required', 'Consumer Secret needed'));

        $this->addCheck(new FormValidatorPost($this));
        $this->addCheck(new FormValidatorCSRF($this));
    }

    /**
     * Intialize form data
     */
    function initData() {
        $this->_data = array(
            'oauth_access_token' => $this->_plugin->getSetting($this->_journalId, 'oauth_access_token'),
            'oauth_access_token_secret' => $this->_plugin->getSetting($this->_journalId, 'oauth_access_token_secret'),
            'consumer_key' => $this->_plugin->getSetting($this->_journalId, 'consumer_key'),
            'consumer_secret' => $this->_plugin->getSetting($this->_journalId, 'consumer_secret'),
        );
    }

    /**
     * Assign form data to user-submitted data
     */
    function readInputData() {
        $this->readUserVars(
            array(
                'oauth_access_token',
                'oauth_access_token_secret',
                'consumer_key',
                'consumer_secret',
            )
        );
    }

    /** 
     * fetch 
     */
    function fetch($request, $template = null, $display = false) {
        $templateMgr = TemplateManager::getManager($request);
        $templateMgr->assign('pluginName', $this->_plugin->getName());
        return parent::fetch($request, $template, $display);
    }

    /**
     * save settings
     */
    function execute() {
        $this->_plugin->updateSetting(
            $this->_journalId, 
            'oauth_access_token',
            trim($this->getData('oauth_access_token'), "\"\';"),
            'string');
        $this->_plugin->updateSetting(
            $this->_journalId, 
            'oauth_access_token_secret',
            trim($this->getData('oauth_access_token_secret'), "\"\';"),
           'string');
        $this->_plugin->updateSetting(
            $this->_journalId, 
            'consumer_key',
            trim($this->getData('consumer_key'), "\"\';"),
            'string');
        $this->_plugin->updateSetting(
            $this->_journalId, 
            'consumer_secret',
            trim($this->getData('consumer_secret'), "\"\';"),
            'string');
    }
}