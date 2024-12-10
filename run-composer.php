<?php
$command = 'php composer.phar ' . implode(' ', array_slice($argv, 1));
echo "Executing: $command\n";
system($command);
?>

