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

defined('MOODLE_INTERNAL') || die();

function local_timespend3v_before_footer()
{
    global $PAGE;
    global $COURSE;
    global $SESSION;
    global $CFG;

    // Jika tidak membuka activity, maka dianggap membuka modul dasbor
    if (method_exists($PAGE->cm, 'get_module_type_name')) {
        $nama_modul = $PAGE->cm->__get('name');
        $jenis_modul = strval($PAGE->cm->get_module_type_name());
    } else {
        $nama_modul = 'Non modul';
        $jenis_modul = 'Umum';
    }

    $SESSION->timespend3v = [
        'nama_course' => $COURSE->fullname,
        'nama_course_singkat' => $COURSE->shortname,
        'nama_modul' => $nama_modul,
        'jenis_modul' => $jenis_modul,
        'url' => $PAGE->url->__toString(),
        'title' => $PAGE->title,
        'token' => md5($PAGE->title . time()),
    ];

    $url_reload = $CFG->wwwroot . '/local/timespend3v/reload.php?token=' .
        $SESSION->timespend3v['token'];
    $PAGE->requires->js('/local/timespend3v/js/reload.js');
    $PAGE->requires->js_init_code("
            setInterval(function() {reload('" . $url_reload . "');}, 5000);
        ");
}
