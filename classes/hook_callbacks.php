<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace tool_usersuspension;

use core\session\utility\cookie_helper;
use html_writer;

/**
 * Tasks performed by tool usersuspension
 *
 * File         tasks.php
 * Encoding     UTF-8
 *
 * @package     tool_usersuspension
 *
 * @copyright   Sebsoft.nl
 * @author      R.J. van Dongen <rogier@sebsoft.nl>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * */
class hook_callbacks {

    /**
     * Callback to recover $SESSION->wantsurl.
     *
     * @param \core\hook\output\before_http_headers $hook
     */
    public static function before_http_headers(
            \core\hook\output\before_http_headers $hook,
    ): void {
        global $SESSION;

        if (!isloggedin() || isguestuser()) {
            return;
        }

        if (!empty($SESSION->warncheck)) {
            return;
        }

        if (get_user_preferences('tool_usersuspension_warned', false)) {
            unset_user_preference('tool_usersuspension_warned');
        }

        $SESSION->warncheck = true;
    }
}
