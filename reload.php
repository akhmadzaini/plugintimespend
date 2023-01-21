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

class reload
{

    private $urlServer = 'http://192.168.0.253/index.php/timespend';

    public function run()
    {
        global $SESSION;
        global $USER;
        global $COURSE;
        if (!empty($SESSION->timespend3v)) {
            if ($_GET['token'] === $SESSION->timespend3v['token']) {
                $username = ($USER->id != 0) ? $USER->username : 'tamu';
                $send['userid'] = $USER->id;
                $send['username'] = $username;
                $send['coursename'] = $SESSION->timespend3v['nama_course'];
                $send['courseshortname'] = $SESSION->timespend3v['nama_course_singkat'];
                $send['activity'] = $SESSION->timespend3v['nama_modul'];
                $send['activity_type'] = $SESSION->timespend3v['jenis_modul'];
                $now = strtotime(date("Y-m-d h:i:s"));
                $before = $now - 5;
                $send['start'] = date("Y-m-d h:i:s", $before);
                $send['end'] = date("Y-m-d h:i:s", $now);
                $send['url'] = $SESSION->timespend3v['url'];
                $send['title'] = $SESSION->timespend3v['title'];
                $this->post($send);
            } else {
                header("HTTP/1.1 401 Unauthorized");
                echo("401, token tidak dikenali");
                exit;
            }
        } else {
            header('HTTP/1.0 403 Forbidden');
            echo 'reload tak diijinkan';
            exit;
        }
    }

    private function post($data)
    {
        $this->request('POST', $data);
    }

    private function get()
    {
        $this->request('GET');
    }

    private function request($method = 'GET', $data = null)
    {
        $curl = curl_init();
        $opt = array(
            CURLOPT_URL => $this->urlServer,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
        );

        if (($method == 'POST')) {
            $opt[CURLOPT_POSTFIELDS] = $data;
        }
        // echo(json_encode($opt));
        curl_setopt_array($curl, $opt);
        $response = curl_exec($curl);
        echo $response;
        curl_close($curl);
    }
}

$oReload = new reload();
$oReload->run();
