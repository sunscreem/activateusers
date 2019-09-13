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

/**
 * @author    Robert Cooper
 * @package   ActivateUsers
 * @since     0.0.1
 */
class ActivateUsersService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (ActivateUsers::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }
}
