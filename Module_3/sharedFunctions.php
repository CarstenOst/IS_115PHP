<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: index.php');
    exit;
}

class sharedFunctions
{
    /**
     * Returns the base URL of any folder, in this case only used for modules
     * @param string $folder
     * @return string
     */
    public static function getBaseURL(string $folder): string
    {
        // You can call this the current server script filepath, if URI is greek for you
        $requestURI = $_SERVER['REQUEST_URI'] ?? '/';
        $httpHost = $_SERVER['HTTP_HOST'] ?? 'localhost';
        // Here I build the base url.
        // Perhaps the most exciting part is the strstr() which finds the needle in the haystack,
        // where the first parameter is the haystack, second is the needle to find, and the last bool
        // decides whether to return the part of the haystack before the needle, which I want in this instance.
        // I do this because the file structure will change when delivering, and that I use phpStorm for quick and easy local hosting of the website.
        // See the code on GitHub for info about the structure; https://github.com/CarstenOst/IS_115PHP
        return 'http://' . $httpHost . strstr($requestURI, $folder, true) . $folder . '/';
    }


    /**
     * Gets all directories with a controller from current dir
     * @param string $currentDir The current directory or the root folder you want to search
     * @return array Returns all directories that has a controller based on root folder
     */
    private static function getDirectoriesWithController(string $currentDir): array
    {
        $directories = scandir($currentDir, SCANDIR_SORT_NONE);
        return array_filter($directories, function($dir) use ($currentDir) {
            return is_dir($currentDir . '/' . $dir) && file_exists($currentDir . '/' . $dir . '/Controller.php');
        });
    }

    /**
     * Generates navigation buttons for directories that have a 'Controller.php' file.
     *
     * This function retrieves all directories in the current directory that contain a 'Controller.php' file.
     * It then generates HTML buttons for each of these directories, using the directory name as the button label.
     * These buttons, when clicked, will navigate to the 'Controller.php' file in the corresponding directory.
     *
     * @param string $folder The name of the folder that will be appended to the base URL for generating the button links.
     * @return void Echos the HTML buttons to the output.
     *
     * Usage:
     *
     * <?php
     * sharedFunctions::generateNavigationButtons('MyFolder');
     * ?>
     */
    public static function generateNavigationButtons(string $folder): void
    {
        $parentFolder = dirname(__DIR__); // Get the parent directory of the current script's directory
        $absolutePath = realpath($parentFolder . '/' . $folder);

        if (!$absolutePath || !is_dir($absolutePath)) {
            $folder = '';
        }
        $currentDir = __DIR__;
        $baseURL = self::getBaseURL($folder);
        $directories = self::getDirectoriesWithController($currentDir);

        // Sort the array alphabetically
        sort($directories);

        foreach ($directories as $dir) {
            $url = htmlspecialchars($baseURL . "$dir/Controller.php", ENT_QUOTES, 'UTF-8');
            $dir = htmlspecialchars($dir, ENT_QUOTES, 'UTF-8');
            echo <<<HTML
                <a href="$url"><button id="$dir">$dir</button></a>
                HTML;
        }
    }
}