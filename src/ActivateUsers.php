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
use craft\services\Plugins;
use craft\events\PluginEvent;

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
    public $schemaVersion = '0.0.1';

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
}
