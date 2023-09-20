<?php

class ChangeHandler
{


    /**
     * Detect if there are any changes based on two arrays
     *
     * @param array $newData Input new data array
     * @param array $oldData Input old data array
     * @return array associative with 'old' and 'new' data.
     */
    public static function detectChanges(array $newData, array $oldData): array
    {
        $changes = [];

        foreach ($newData as $field => $data) {
            if (isset($oldData[$field]) && $oldData[$field][0] !== $data[0]) {
                $changes[$field] = [
                    'old' => $oldData[$field][0],
                    'new' => $data[0]
                ];
            }
        }

        return $changes;
    }


    /**
     * Display the message of changes
     *
     * @param array $changes Input an array with 'old' and 'new' keys
     * @return string Ready html code (eh)
     */
    public static function changeMsg(array $changes): string
    {
        if (empty($changes)) return '<p>No changes were made.</p>';

        $messages = array_map(function ($field, $data) {
            return "$field: {$data['old']} -> {$data['new']}";
        }, array_keys($changes), $changes);

        return '<p>Changes where made to: <br>' . implode("<br>", $messages) . '.</p>';
    }
}
