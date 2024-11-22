<?php

/**
 * Sanitize a string to prevent XSS attacks.
 *
 * @param string $data
 * @return string
 */
function sanitizeString($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Sanitize an email to ensure it’s a valid email format.
 *
 * @param string $email
 * @return string|false
 */
function sanitizeEmail($email) {
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);

    return filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : false;
}

/**
 * Sanitize an integer input.
 *
 * @param string $data
 * @return int
 */
function sanitizeInt($data) {
    return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
}

/**
 * Sanitize a URL.
 *
 * @param string $url
 * @return string|false
 */
function sanitizeUrl($url) {
    return filter_var(trim($url), FILTER_SANITIZE_URL);
}

/**
 * Sanitize and validate password strength.
 *
 * @param string $password
 * @return string|false
 */
function sanitizePassword($password) {
    if (strlen($password) < 8) {
        return false; 
    }

    return htmlspecialchars(trim($password));
}

/**
 * Filter input based on expected data type.
 *
 * @param string $type  Type of data (email, int, string, etc.)
 * @param string $data  The input data to filter
 * @return mixed
 */
function filterInput($type, $data) {
    switch ($type) {
        case 'email':
            return sanitizeEmail($data);
        case 'string':
            return sanitizeString($data);
        case 'int':
            return sanitizeInt($data);
        case 'url':
            return sanitizeUrl($data);
        case 'password':
            return sanitizePassword($data);
        default:
            return sanitizeString($data);
    }
}
