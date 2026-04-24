<?php

/**
 * Force SQLite for the mock API.
 * This overrides any .env DB_CONNECTION value AND clears DATABASE_URL
 * which Laravel uses to override individual DB_* settings.
 * Remove this file when deploying with MySQL/RDS.
 */

$dbPath = dirname(__DIR__) . '/database/database.sqlite';

// Clear DATABASE_URL first — it overrides everything else in Laravel
putenv('DATABASE_URL=');
$_ENV['DATABASE_URL'] = '';
$_SERVER['DATABASE_URL'] = '';

putenv('DB_CONNECTION=sqlite');
$_ENV['DB_CONNECTION'] = 'sqlite';
$_SERVER['DB_CONNECTION'] = 'sqlite';

putenv("DB_DATABASE={$dbPath}");
$_ENV['DB_DATABASE'] = $dbPath;
$_SERVER['DB_DATABASE'] = $dbPath;
