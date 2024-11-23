<?php

/**
 * Format a date in a human-readable format.
 * @param mixed $date
 * @return string
 */
function format_date($date) {
    return date('D, d M Y H:i A', strtotime($date));
}

?>