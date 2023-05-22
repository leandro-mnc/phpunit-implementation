<?php

require_once 'vendor/autoload.php';

$env = 'testing';
$_ENV['DB_NAME'] = $env;

/*
$phinxApp = new \Phinx\Console\PhinxApplication();
$phinxApp->setCatchExceptions(false);
$phinxTextWrapper = new \Phinx\Wrapper\TextWrapper($phinxApp);

$phinxTextWrapper->setOption('configuration', 'phinx.php');
$phinxTextWrapper->setOption('parse', 'php');
$phinxTextWrapper->setOption('environment', $env);

// Rollback
$phinxTextWrapper->getRollback($env);
$inputRollback = new \Symfony\Component\Console\Input\ArrayInput([
    'command' => 'rollback',
    '-e' => $env
]);
try {
    $phinxTextWrapper->getApp()->run($inputRollback);
} catch (Exception $e) {

}
*/

shell_exec('vendor/bin/phinx rollback -e ' . $env);
shell_exec('vendor/bin/phinx migrate -e ' . $env);