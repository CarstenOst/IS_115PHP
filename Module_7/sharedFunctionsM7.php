<?php

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: index.php');
    exit;
}

class sharedFunctionsM7
{
    /**
     * Returns the base URL of any folder, in this case only used for modules
     * @param string $folder
     * @return string
     */
    private static function getBaseURL(string $folder): string
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
    private static function getDirectoriesWithController(string $currentDir = __DIR__): array
    {
        $directories = scandir($currentDir, SCANDIR_SORT_NONE);
        return array_filter($directories, function ($dir) use ($currentDir) {
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
     * @return void Echos the HTML buttons to the output.
     *
     * Usage:
     *
     * <?php
     * sharedFunctions::generateNavigationButtons();
     * ?>
     */
    public static function generateNavigationButtons(): void
    {
        $moduleFolder = self::getCurrentModuleFolderName();


        $baseURL = self::getBaseURL($moduleFolder);
        $directories = self::getDirectoriesWithController();

        // Sort the array alphabetically
        sort($directories);

        foreach ($directories as $dir) {
            $url = htmlspecialchars($baseURL . "$dir/Controller.php", ENT_QUOTES, 'UTF-8');
            $dir = htmlspecialchars($dir, ENT_QUOTES, 'UTF-8');
            echo <<<HTML
                <a href="$url">
                    <button id="$dir">$dir</button>
                </a>
                HTML;
        }

    }

    /**
     *
     * @return String the name of the parent folder of the current script's directory.
     */
    public static function generateParentFolderName(): string
    {
        $currentScriptPath = $_SERVER['SCRIPT_FILENAME'];
        $parentFolder = dirname($currentScriptPath);
        return basename($parentFolder);
    }

    /**
     * WARNING: IF GRAND PARENT FOLDER DOES NOT CONTAIN '_', this will return an empty string
     * @return string The module folder name (if any), else an empty string
     */
    public static function getCurrentModuleFolderName(): string
    {
        $folderName = basename(dirname($_SERVER['SCRIPT_FILENAME'], 2));
        return (self::containsString($folderName, '_')) ? $folderName : '';
    }

    /**
     * Checks a string to see if it contains the string
     * @param string $stringToSearch The string to search
     * @param string $stringToSearchFor The string to search for
     * @return bool true if string contains the stringToSearchFor, else false
     */
    private static function containsString(string $stringToSearch, string $stringToSearchFor): bool
    {
        return (bool)stripos($stringToSearch, $stringToSearchFor);
    }

}
