<?php
declare(strict_types=1); // Type safety

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
    header('Location: ../index.php');
    exit;
}

/**
 * InputHandler Class
 * This class provides functionalities to sanitize and validate input data based on dynamically configured rules.
 */
class InputHandler
{
    private array $inputConfig = [];  // Configuration storage for input processing

    /**
     * Constructor: Initializes configuration storage with the given array or an empty array.
     *
     * @param array $config Initial input processing configuration
     */
    public function __construct(array $config = [])
    {
        $this->inputConfig = $config;
    }

    /**
     * Adds a new configuration for input processing.
     *
     * We store both sanitization and validation methods without wrapping. This keeps
     * configuration separate from actual data processing.
     *
     * @param string $key Key identifier for the input
     * @param callable $sanitizeMethod Method/function to sanitize the input
     * @param callable $validationMethod Method/function to validate the input
     */
    public function addConfig(string $key, callable $sanitizeMethod, callable $validationMethod): void
    {
        $this->inputConfig[$key] = [
            'sanitize' => $sanitizeMethod,
            'validate' => $validationMethod
        ];
    }

    /**
     * Processes and validates the provided inputs based on the existing configuration.
     *
     * This method loops through the input configuration, sanitizes the input using the
     * provided sanitize method, and then validates it using the provided validate method.
     *
     * @param array $postData Raw input data
     * @return array Processed data and validation messages
     */
    public function processInputs(array $postData): array
    {
        $processedData = [];
        $notValidResponseMessage = [];

        foreach ($this->inputConfig as $inputKey => $config) {
            // Sanitize using the stored method from configuration
            $value = $this->sanitizeInput($postData[$inputKey], $config['sanitize']);

            // Default validity assumption
            $isValid = true;

            // Check for required input
            if (empty($value)) {
                $notValidResponseMessage[] = "$inputKey is required.";
                $isValid = false;
            } // Validate using the stored method from configuration, if provided
            elseif (isset($config['validate']) && !call_user_func_array($config['validate'], [&$value, &$notValidResponseMessage])) {
                $isValid = false;
            }

            // Store results
            $processedData[$inputKey] = [$value, $isValid];

            // Warning: Storing data directly in the $_SESSION can be unexpected.
            // It is generally better to avoid direct global state manipulation inside this utility class.
            // But I keep my tongue straight in my mouth (until I forget about this)
            $_SESSION[$inputKey] = [$value, $isValid];
        }

        return [$processedData, $notValidResponseMessage];
    }

    /**
     * Sanitizes a given value with the strip_tags function, and then with an additional method if provided.
     *
     * This method is a helper to maintain a base level of sanitization (using strip_tags) and then
     * allows for further sanitization with another provided method.
     *
     * @param string $value Raw input value
     * @param callable|null $additionalSanitization Additional sanitization method
     * @return string Sanitized value
     */
    private function sanitizeInput(string $value, callable $additionalSanitization = null): string
    {
        $sanitized = strip_tags($value);  // Base level of sanitization

        // Apply the additional sanitization, if provided
        if ($additionalSanitization) {
            $sanitized = call_user_func($additionalSanitization, $sanitized);
        }

        return $sanitized;
    }
}

