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

/**
 * Block definition class for the block_header plugin.
 *
 * @package   block_header
 * @copyright 2026 Utdanningsdirektoratet https://udir.no
 * @author    Sindre Kjelsrud
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_header extends block_base {

    /**
     * Initialises the block.
     *
     * @return void
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_header');
    }

    /**
     * Hides the block header
     *
     * @return bool
     */
    public function hide_header() {
        return true;
    }

    /**
     * Gets the block contents.
     *
     * @return string The block HTML.
     */
    public function get_content() {
        global $OUTPUT, $PAGE;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->footer = '';

        $data = [
            'title' => format_string($PAGE->category->name) ?? 'default title',
            'description' => !empty($this->config->description) ? $this->config->description : 'Default Header Description',
        ];

        $this->content->text = $OUTPUT->render_from_template('block_header/content', $data);

        $this->content->text .= '<script>
            document.addEventListener("DOMContentLoaded", function() {
                var header = document.getElementById("page-header");
                if (header) { header.style.display = "none"; }
            });
        </script>';

        return $this->content;
    }

    /**
     * Defines in which pages this block can be added.
     *
     * @return array of the pages where the block can be added.
     */
    public function applicable_formats() {
        return [
            'all' => true
        ];
    }
}

