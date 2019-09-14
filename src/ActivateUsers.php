<?php
/**
 * ActivateUsers plugin for Craft CMS 3.x
 *
 * Craft CMS plugin to allow non-admin users permission to activate user accounts in the users page of the dashboard
 *
 * @link      https://github.com/sunscreem
 * @copyright Copyright (c) 2019 Robert Cooper
 */

namespace sunscreem\activateusers;

use sunscreem\activateusers\services\ActivateUsersService as ActivateUsersServiceService;
use sunscreem\activateusers\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\elements\User;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\services\Elements;
use yii\base\Event;

/**
 * Class ActivateUsers
 *
 * @author    Robert Cooper
 * @package   ActivateUsers
 * @since     0.0.1
 *
 * @property  ActivateUsersServiceService $activateUsersService
 */
class ActivateUsers extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var ActivateUsers
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // public $hasCpSettings = false;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );


        Event::on(
            Elements::class,
            Elements::EVENT_BEFORE_SAVE_ELEMENT,
            function(Event $event){
                if ($event->element instanceof User) {

                    $user=$event->element;
                    $isNewuser = $event->isNew;

                    dd($this->isAllowedDomain($user->email));
                    // if ($isNewUser && !$this->isAllowedDomain($user->email))



                    // dd('about to save a user');
                }
            }
        );



        // craft()->on('users.onBeforeSaveUser', function (Event $event)
        // {
        //     $settings  = $this->getSettings();
        //     $user      = $event->params['user'];
        //     $isNewUser = $event->params['isNewUser'];

        //     if ($isNewUser && !$this->isAllowedDomain($user->email))
        //     {
        //         $user->pending = true;
        //         // send the signup email to new customers only
        //         if (!craft()->userSession->getUser() || !craft()->userSession->getUser()->isInGroup('tradeCustomers'))
        //         {
        //             craft()->pendingUser_email->signup($user);
        //         }
        //     }
        // });

        Craft::info(
            Craft::t(
                'activate-users',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'activate-users/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }

    private function isAllowedDomain($domain)
    {
        $settings       = $this->getSettings();
        dd($this->settings);
        $allowedDomains = array_filter(explode("\r\n", $settings->allowedDomains));
        $emailDomain    = strtolower(substr(strrchr($domain, '@'), 1));

        return in_array($emailDomain, $allowedDomains);
    }
}
