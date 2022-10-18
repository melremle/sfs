<?php
require_once dirname(__DIR__, 2) . '/models/MediaTypesModel.php';

class MediaTypes
{

    public function insertMediaType()
    {
        if (isset($_POST['ExtensionName']) && isset($_POST['MimeType']) && isset($_POST['MimeDescription']) && isset($_POST['Class']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $mediaType = new MediaTypesModel;
            $mediaType->ExtensionName = $_POST['ExtensionName'];
            $mediaType->MimeType = $_POST['MimeType'];
            $mediaType->MimeDescription = $_POST['MimeDescription'];
            $mediaType->Class = $_POST['Class'];
            if ($mediaType->insertMediaType() === true) {
                echo json_encode(
                    array(
                        'success' => true,
                        'message' => 'Media Type Added'
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'Internal Server Error'
                    )
                );
            }
        } else {
            http_response_code(421);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Invalid request'
                )
            );
        }
    }

    public function getAllowedMediaTypes()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $mediaType = new MediaTypesModel;
            if (is_array($mediaType->getAllowedMediaTypes())) {
                echo json_encode($mediaType->getAllowedMediaTypes());
            } else {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'Internal Server Error'
                    )
                );
            }
        } else {
            http_response_code(421);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Invalid request'
                )
            );
        }
    }
}
