<?php echo 'task 1' ;
/*
      /$$$$$$$$                  /$$               /$$
     |__  $$__/                 | $$             /$$$$
        | $$  /$$$$$$   /$$$$$$$| $$   /$$      |_  $$
        | $$ |____  $$ /$$_____/| $$  /$$/        | $$
        | $$  /$$$$$$$|  $$$$$$ | $$$$$$/         | $$
        | $$ /$$__  $$ \____  $$| $$_  $$         | $$
        | $$|  $$$$$$$ /$$$$$$$/| $$ \  $$       /$$$$$$
        |__/ \_______/|_______/ |__/  \__/      |______/

ASCII art stolen here from here: https://patorjk.com/software/taag/#p=display&f=Big%20Money-ne&t=Task%201
*/


/**
 * While this method is meant for a last name, it will still work with any names or words.
 * Therefore, the method and variable names could be more generic as the code can be reused.
 * But I will not do this here as it is specific to the task
 * It is also bad practice to do both multiple things in a function,
 * but im making an exception here, as its only counting and making the first char upper case
 * @param $lastName
 * @return array of last name and the length
 */
function capitalizeLastNameAndCount($lastName): array
{
    // Here we have function call as a parameter.
    // As you see we start by calling "ucfirst" which is going to capitalize the first letter (read the docs)
    // It has a parameter of a function "strtolower" which will take a string as a parameter
    // and make all characters of said string to lowercase
    // The last function to be called has to be the first one to finish because otherwise there would be
    // no value in the parameter to the "ucfirst()" function
    $formattedLastName = ucfirst(strtolower($lastName));
    $length = $formattedLastName;

    return [
        'lastName' => $formattedLastName,
        'length' => $length
    ];
}
include 'index.php';