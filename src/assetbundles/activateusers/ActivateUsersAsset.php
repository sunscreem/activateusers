<?php
/**
 * ActivateUsers plugin for Craft CMS 3.x
 *
 * Craft CMS plugin to allow non-admin users permission to activate user accounts in the users page of the dashboard
 *
 * @link      https://github.com/sunscreem
 * @copyright Copyright (c) 2019 Robert Cooper
 */

namespace sunscreem\activateusers\assetbundles\activateusers;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Robert Cooper
 * @package   ActivateUsers
 * @since     0.0.1
 */
class ActivateUsersAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@sunscreem/activateusers/assetbundles/activateusers/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/ActivateUsers.js',
        ];

        $this->css = [
            'css/ActivateUsers.css',
        ];

        parent::init();
    }
}
