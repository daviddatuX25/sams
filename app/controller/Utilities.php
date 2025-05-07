<?php
class controller_Utilities {

    public function handleProfileUpload($file) {
        $uploadDir = 'public/uploads/'; // or outside public and served via route
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        $tmpName = $file['tmp_name'];
        $name = basename($file['name']);
        $mime = mime_content_type($tmpName);

        if (!in_array($mime, $allowedTypes)) {
            return ['success' => false, 'error' => 'Invalid file type'];
        }

        $newName = uniqid('profile_', true) . '.' . pathinfo($name, PATHINFO_EXTENSION);
        $destination = $uploadDir . $newName;

        if (move_uploaded_file($tmpName, $destination)) {
            return ['success' => true, 'path' => $destination];
        }

        return ['success' => false, 'error' => 'Upload failed'];
    }

    protected function formatDate($date) { // date formatter
        return date("F j, Y, g:i a", strtotime($date));
    }

    protected function sanitizeInput($data) { // Sanitize data
        if (is_array($data)) {
            $sanitizedData = array();
            foreach ($data as $key => $value) {
                $value = trim($value);
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $sanitizedData[$key] = $value;
            }
            return $sanitizedData; // Assign sanitized result back to $data if needed
        } else {
            $data = trim($data);
            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
            return $data;
        }
    }

    public function checkEmptyInput($userDataGroup, $nullableFields){ // Check for empty input fields
        $emptyFields = [];
        foreach ($userDataGroup as $dataKey => $userData) {
            if (!in_array($dataKey, $nullableFields)) {
                if (empty($userData)){$emptyFields[] = $dataKey;}
            }
        }
        return empty($emptyFields) ? false : $emptyFields;
    }

    protected function reflectController($controllerInstance) {
        $path = (new ReflectionClass($controllerInstance))->getFileName();
        $path = str_replace('\\', '/', $path); // normalize slashes
    
        if (strpos($path, '/controller/student/') !== false) {
            return 'student';
        } elseif (strpos($path, '/controller/admin/') !== false) {
            return 'admin';
        } elseif (strpos($path, '/controller/teacher/') !== false) {
            return 'teacher';
        } else if (strpos($path, '/controller/home/') !== false) {
            return 'home';
        }
        return null;
    }

    protected function isAjaxRequest() {
        return (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        );
    }
    
    protected function log($message) { // Logging.
        file_put_contents('logs/app.log', $message . PHP_EOL, FILE_APPEND);
    }

}

?>