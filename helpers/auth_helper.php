<?php

session_start();

/**
 * Check if a user is authenticated.
 *
 * @return bool
 */
function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

/**
 * Restrict access to authenticated users.
 */
function requireAuth() {
    if (!isAuthenticated()) {
        redirect('login');
    }
}

/**
 * Restrict access to non-authenticated users.
 */
function requireGuest() {
    if (isAuthenticated()) {
        redirect('home');
    }
}

/**
 * Check if authenticated user is an admin.
 * @return bool
 */
function isAdmin() {
    return isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin';
}

/**
 * Restrict access to non-admin users.
 */
function requireAdmin() {
    if (!isAdmin()) {
        redirect('home');
    }
}

/**
 * Get the current authenticated user's ID.
 *
 * @return int|null
 */
function currentUserId() {
    return $_SESSION['user_id'] ?? null;
}
