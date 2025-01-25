<?php

namespace App\FormRequest;

abstract class FormRequest
{
    /**
     * Set invalid data in session
     * 
     * @return void
     */
    protected function invalid(array $oldData, array $errors): void
    {
        $_SESSION['invalid_request_data'] = [
            'old_data' => $oldData,
            'errors' => $errors,
        ];
    }

    /**
     * sanitize request data
     * 
     * @param array $data
     * @param array $emailFields
     * 
     * @return array
     */
    protected function sanitizeData(array $data, array $emailFields = []): array
    {
        $newData = [];
        foreach ($data as $key => $value) {
            // sanitize special characters and trim
            $newData[$key] = $value ? htmlspecialchars(trim($value)) : null;

            if (in_array($key, $emailFields)) {
                // email filter
                $newData[$key] = $value ? filter_var($value, FILTER_SANITIZE_EMAIL) : null;
            }
        }

        return $newData;
    }
}
