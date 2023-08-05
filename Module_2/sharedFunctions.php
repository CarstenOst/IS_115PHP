<?php

class sharedFunctions
{
    private static function getBaseURL(): string
    {
        $requestURI = $_SERVER['REQUEST_URI'] ?? '/';
        $httpHost = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $modulePos = strpos($requestURI, 'Module_2');
        return 'http://' . $httpHost . substr($requestURI, 0, $modulePos) . 'Module_2/';
    }

    private static function getDirectoriesWithController(string $currentDir): array
    {
        $directories = scandir($currentDir);
        return array_filter($directories, function($dir) use ($currentDir) {
            return $dir != '.' && $dir != '..' && is_dir($currentDir . '/' . $dir) && file_exists($currentDir . '/' . $dir . '/Controller.php');
        });
    }

    public static function generateButtons(): void
    {
        $currentDir = __DIR__;
        $baseURL = self::getBaseURL();
        $directories = self::getDirectoriesWithController($currentDir);

        foreach ($directories as $dir) {
            $url = htmlspecialchars($baseURL . "$dir/Controller.php", ENT_QUOTES, 'UTF-8');
            $dir = htmlspecialchars($dir, ENT_QUOTES, 'UTF-8');
            echo "<a href=\"$url\"><button id=\"$dir\">$dir</button></a>";
        }
    }
}