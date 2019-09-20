<script>
    $(function() {ldelim}
        // Attach the form handler
        $('#tbSettingsForm').pkpHandler('$.pkp.controllers.form.AjaxFormHandler');
    {rdelim});
</script>

<form class="pkp_form" id="tbSettingsForm" method="post" action="{url router=$smarty.const.ROUTE_COMPONENT op="manage" category="generic" plugin=$pluginName verb="settings" save=true}">
    {csrf}
    {include file="controllers/notification/inPlaceNotification.tpl" notificationId="tbSettingsFormNotification"}

    <div id="description">
    <p>With this plugin enabled a Twitter account may be used to publish periodical notifications about changes and news in your journal. Please note that this plugin requires that you have already setup a Twitter account. Please see <a href="http://twitter.com">Twitter</a> for further information.
    </p>
    
    </div>

    {fbvFormArea id="webFeddSettingsFormArea"}
        {fbvElement type="text" id="oauth_access_token" value=$oauth_access_token label="OAuth Access Token"}
        {fbvElement type="text" id="oauth_access_token_secret" value=$oauth_access_token_secret label="OAuth Access Token Secret"}
        {fbvElement type="text" id="consumer_key" value=$consumer_key label="Consumer Key"}
        {fbvElement type="text" id="consumer_secret" value=$consumer_secret label="Consumer Secret"}
    {/fbvFormArea}

    {fbvFormButtons}

    <p><span class="FormRequired">Required field</span></p>
</form>