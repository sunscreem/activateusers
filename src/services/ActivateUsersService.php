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

class ActivateUsersService extends Component
{
    public $pluginSettings;

    public function __construct()
    {
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

    public function notifyModerator(User $user)
    {
        return Craft::$app
            ->getMailer()
            ->compose()
            ->setTo($this->pluginSettings->moderatorEmailAddress)
            ->setSubject($this->pluginSettings->moderatorEmailSubject)
            ->setHtmlBody(Craft::$app->view->renderString($this->pluginSettings->moderatorEmailBody, ['user' => $user]))
            ->send();
    }

    public function activate(User $user)
    {

        return Craft::$app
            ->getMailer()
            ->compose()
            ->setTo($user->email)
            ->setSubject($this->pluginSettings->activationEmailSubject)
            ->setHtmlBody(Craft::$app->view->renderString($this->pluginSettings->activationEmailBody, ['user' => $user]))
            ->send();
    }
}
