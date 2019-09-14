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

use sunscreem\activateusers\ActivateUsers;

use Craft;
use craft\base\Model;

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
    public $someAttribute = 'Some Default2';

    public $allowedDomains = null;
    public $signupEmailSubject = 'User Request Received';
    public $signupEmailBody = 'We received your request for a members account and we are currently reviewing it.  You will receive a verification email once the account has been approved.';
    public $activationEmailSubject = 'Account Activated';
    public $activationEmailBody = 'Your account has been activated.';
    public $notifyModerator = false;
    public $moderatorEmailAddress = '';
    public $moderatorEmailSubject = 'A new user has signed up';
    public $moderatorEmailBody = "A new user has signed up.\nClick here to review: {{ user.cpEditUrl }}";


    // 'allowedDomains'         => array(AttributeType::Mixed, 'default' => null),
    // 'signupEmailSubject'     => array(AttributeType::Mixed, 'default' => 'User Request Received'),
    // 'signupEmailBody'        => array(AttributeType::Mixed, 'default' => 'We received your request for a members account and we are currently reviewing it.  You will receive a verification email once the account has been approved.'),
    // 'activationEmailSubject' => array(AttributeType::Mixed, 'default' => 'Account Activated'),
    // 'activationEmailBody'    => array(AttributeType::Mixed, 'default' => 'Your account has been activated.'),
    // 'notifyModerator'        => array(AttributeType::Bool, 'default' => false),
    // 'moderatorEmailAddress'  => array(AttributeType::Email, 'default' => craft()->systemSettings->getSetting('email', 'emailAddress')),
    // 'moderatorEmailSubject'  => array(AttributeType::Mixed, 'default' => 'A new user has signed up'),
    // 'moderatorEmailBody'     => array(AttributeType::Mixed, 'default' => "A new user has signed up.\nClick here to review: {{ user.cpEditUrl }}"),






    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['someAttribute', 'string'],
            ['someAttribute', 'default', 'value' => 'Some Default1'],
        ];
    }
}
