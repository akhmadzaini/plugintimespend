<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package     local_timespend3v
 * @category    string
 * @copyright   2022 Akhmad Zaini <zaini1983@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
$context = context_system::instance();
$PAGE->set_context($context);

$PAGE->set_url(new moodle_url('/local/timespend3v/index.php'));

$PAGE->set_pagelayout('standard');

$PAGE->set_title(get_string('pluginname', 'local_timespend3v'));
$PAGE->set_heading(get_string('pluginname', 'local_timespend3v'));

echo $OUTPUT->header();
echo $OUTPUT->box_start('card-columns');
echo "Halaman depan untuk plugin timespend";
echo $OUTPUT->box_end();
echo $OUTPUT->footer();