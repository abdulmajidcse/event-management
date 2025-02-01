<?php

namespace App\FormRequest;

abstract class FormRequest
{
    /**
     * Class contrustor
     */
    public function __construct()
    {
        // Verify csrf token
        if (!validateCsrfToken(request()->input('_token'))) {
            if (request()->isAjax()) {
                echo response()->json(['message' => 'Page expired! Please, try again.'], 422);
            } else {
                // set csrf token error message
                setStatusMessage('Page expired! Please, try again.', 'error');
                redirect(oldUri());
            }
            exit(1);
        }
    }

    /**
     * Set invalid data in session
     * 
     * @param array $oldData
     * @param array $errors
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
     * Sanitize request data
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
            if (in_array($key, $emailFields)) {
                // email filter
                $newData[$key] = $value ? filter_var($value, FILTER_SANITIZE_EMAIL) : $value;
            } else {
                // sanitize special characters and trim
                $newData[$key] = $value ? filter_var(trim($value), FILTER_SANITIZE_SPECIAL_CHARS) : $value;
            }
        }

        return $newData;
    }
}
