<?php

/**
 * ActivateUsers plugin for Craft CMS 3.x
 *
 * Craft CMS plugin to allow non-admin users permission to activate user accounts in the users page of the dashboard
 *
 * @link      https://github.com/sunscreem
 * @copyright Copyright (c) 2019 Robert Cooper
 */

namespace sunscreem\activateusers\models;

use craft\base\Model;
use craft\helpers\App;

/**
 * @author    Robert Cooper
 * @package   ActivateUsers
 * @since     0.0.1
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */

    public $allowedDomains = null;
    public $signupEmailSubject = 'User Request Received';
    public $signupEmailBody = 'We received your request for a members account and we are currently reviewing it.  You will receive a verification email once the account has been approved.';
    public $activationEmailSubject = 'Account Activated';
    public $activationEmailBody = 'Your account has been activated.';
    public $notifyModerator = false;
    public $moderatorEmailAddress = null;
    public $moderatorEmailSubject = 'A new user has signed up';
    public $moderatorEmailBody = "A new user has signed up.\nClick here to review: {{ user.cpEditUrl }}";

    // Public Methods
    // =========================================================================


    public function init()
    {
        parent::init();

        if ($this->moderatorEmailAddress === null) {
            $this->moderatorEmailAddress = App::mailSettings()->fromEmail;
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['allowedDomains', 'default', 'value' => null],
            ['signupEmailSubject', 'default', 'value' => 'User Request Received'],
            ['signupEmailBody', 'default', 'value' => 'We received your request for a members account and we are currently reviewing it.  You will receive a verification email once the account has been approved.'],
            ['activationEmailSubject', 'default', 'value' => 'Account Activated'],
            ['activationEmailBody', 'default', 'value' => 'Your account has been activated.'],

            ['notifyModerator', 'boolean'],
            ['notifyModerator', 'default', 'value' => false],

            ['moderatorEmailAddress', 'email'],

            ['moderatorEmailSubject', 'default', 'value' => 'A new user has signed up'],
            ['moderatorEmailBody', 'default', 'value' => 'A new user has signed up.\nClick here to review: {{ user.cpEditUrl }}'],
        ];
    }
}
