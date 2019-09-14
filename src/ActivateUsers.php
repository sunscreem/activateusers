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
use craft\helpers\App;
use craft\services\Elements;
use sunscreem\activateusers\services\ActivateUsersService;
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

        $this->setComponents([
            'ActivateUsersService' => ActivateUsersService::class,
        ]);

        Event::on(
            User::class,
            User::EVENT_BEFORE_SAVE,
            function (Event $event) {

                $newuser = $event->sender;
                $currentUser = Craft::$app->getUser()->getIdentity();

                if ($event->isNew && !$this->isAllowedDomain($newuser->email)) {

                    $newuser->pending  = true;

                    if (!$currentUser || !$currentUser->isInGroup('tradeCustomers')) {

                        $this->activateUsersService->signup($newuser);
                    }
                }
            }
        );

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
        $allowedDomains = array_filter(explode("\r\n", $this->settings->allowedDomains));
        $emailDomain    = strtolower(substr(strrchr($domain, '@'), 1));

        return in_array($emailDomain, $allowedDomains);
    }
}
