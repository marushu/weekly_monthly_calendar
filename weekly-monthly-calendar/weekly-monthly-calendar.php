<?php
/**
 * Plugin Name: Weekly Monthly Calendar
 * Plugin URI:  http://private.hibou-web.com
 * Description: Event calendar for weekly and monthly anywhere.
 * Version:     0.1.0
 * Author:      Hibou
 * Author URI:  http://hibou-web.com
 * License:     GPLv2
 * Text Domain: weekly_monthly_calendar
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2014 Hibou ( http://hibou-web.com )
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */



define( 'WEEKLY_MONTHLY_CALENDAR_URL',  plugins_url( '', __FILE__ ) );
define( 'WEEKLY_MONTHLY_CALENDAR_PATH', dirname( __FILE__ ) );

$weekly_monthly_calendar = new Weekly_Monthly_Calendar();
$weekly_monthly_calendar->register();

class Weekly_Monthly_Calendar {

private $version = '';
private $langs   = '';

function __construct()
{
    $data = get_file_data(
        __FILE__,
        array( 'ver' => 'Version', 'langs' => 'Domain Path' )
    );
    $this->version = $data['ver'];
    $this->langs   = $data['langs'];
}

public function register()
{
    add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
}

public function plugins_loaded()
{
    load_plugin_textdomain(
        'weekly_monthly_calendar',
        false,
        dirname( plugin_basename( __FILE__ ) ).$this->langs
    );

    add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );

}

public function wp_enqueue_scripts()
{
    wp_enqueue_style(
        'weekly-monthly-calendar-style',
        plugins_url( 'css/weekly-monthly-calendar.min.css', __FILE__ ),
        array(),
        $this->version,
        'all'
    );

    wp_enqueue_script(
        'weekly-monthly-calendar-script',
        plugins_url( 'js/weekly-monthly-calendar.min.js', __FILE__ ),
        array( 'jquery' ),
        $this->version,
        true
    );
}

} // end class Weekly_Monthly_Calendar

// EOF
