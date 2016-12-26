<?php
return array(
    'colors' => true,
    'databases' => array(
        'migration' => array(
            // PDO Connection settings.
            'database_dsn'       => isset($_SERVER['SLIM_DNS']) ? $_SERVER['SLIM_DNS'] : 'mysql:dbname=candy;host=localhost',
            'database_user'      => isset($_SERVER['SLIM_USER']) ? $_SERVER['SLIM_USER'] : 'root',
            'database_password'  => isset($_SERVER['SLIM_PASS']) ? $_SERVER['SLIM_PASS'] : '123',

            // or
            // mysql client command settings.
            // 'mysql_command_enable'    => true,
            // 'mysql_command_cli'       => "/usr/bin/mysql",
            // 'mysql_command_tmpsqldir' => "/tmp",
            // 'mysql_command_host'      => "localhost",
            // 'mysql_command_user'      => "user",
            // 'mysql_command_password'  => "password",
            // 'mysql_command_database'  => "yourdatabase",
            // 'mysql_command_options'   => "--default-character-set=utf8",

            // schema version table
            'schema_version_table' => 'schema_version',

            // directory contains migration task files.
            'migration_dir' => './migration'
        ),
    ),
);
