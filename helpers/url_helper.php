<?php

/**
 * Generate a URL for the specified page.
 *
 * @param string $page The page name (e.g., 'login', 'reports').
 * @param array $params Optional query parameters as key-value pairs.
 * @return string Full URL for the page.
 */
function url($page, $params = []) {
    $baseUrl = "http://localhost/e-report/public"; // Change this to your app's base URL
    $queryString = http_build_query($params);
    return $baseUrl . "/?page=" . $page . ($queryString ? "&" . $queryString : "");
}

/**
 * Redirect to a specified page.
 *
 * @param string $page The page name to redirect to.
 * @param array $params Optional query parameters as key-value pairs.
 */
function redirect($page, $params = []) {
    $url = url($page, $params);
    header("Location: $url");
    exit;
}
