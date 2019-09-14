<?php

/**
 * ActivateUsers plugin for Craft CMS 3.x
 *
 * Craft CMS plugin to allow non-admin users permission to activate user accounts in the users page of the dashboard
 *
 * @link      https://github.com/sunscreem
 * @copyright Copyright (c) 2019 Robert Cooper
 */

namespace sunscreem\activateusers\services;

use sunscreem\activateusers\ActivateUsers;

use Craft;
use craft\base\Component;
use craft\elements\User;

/**
 * @author    Robert Cooper
 * @package   ActivateUsers
 * @since     0.0.1
 */
class ActivateUsersService extends Component
{
    // public $email;
    // public $emailSettings;
    public $pluginSettings;

    // Public Methods
    // =========================================================================

    public function __construct()
    {
        // $this->email = new EmailModel();
        // $this->emailSettings = craft()->email->getSettings();

        // $this->email->fromEmail = $this->emailSettings['emailAddress'];
        // $this->email->sender = $this->emailSettings['emailAddress'];
        // $this->email->fromName = $this->emailSettings['senderName'];

        $this->pluginSettings = ActivateUsers::getInstance()->settings;
    }

    public function signup(User $user)
    {
        return Craft::$app
            ->getMailer()
            ->compose()
            ->setTo($user->email)
            ->setSubject($this->pluginSettings->signupEmailSubject)
            ->setHtmlBody(Craft::$app->view->renderString($this->pluginSettings->signupEmailBody, ['user' => $user]))
            ->send();
    }
}
