<?php

function addImage($file, $offerCategory, $offerPrice, $offerId, $notification) {
    $response = array(
        'status' => 0,
        'message' => '',
        'data' => '',
    );
    $countSentFiles = count($file['name']);
    $countInsertedFiles = 0;
    $directory = "public/sources/images/" . $offerCategory . "/";
    $extension = array("jpeg", "jpg", "png", "gif");
    foreach ($file["tmp_name"] as $key => $tmp_name) {
        $file_name = $file["name"][$key];
        $file_tmp = $file["tmp_name"][$key];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if (in_array($ext, $extension)) {
            if (!file_exists($directory)) mkdir($directory, 0777);
            $dir = $target_file = $directory . $offerCategory . "_" . date("Y-m-d") . time() . "_" . strtolower($file_name);
            if (!file_exists($target_file)) {
                if (move_uploaded_file($file_tmp = $file["tmp_name"][$key], $dir)) {
                    $imageId = insertImageToDatabase($offerPrice, $dir);
                    if ($imageId > 0) {
                        linkOfferWithPhotos($imageId, $offerId);
                        ++$countInsertedFiles;
                        if ($countSentFiles == $countInsertedFiles) {
                            $response['status'] = 1;
                            $response['data'] = getOfferById($offerId);
                            $response['message'] = $notification;
                        }
                    } else {
                        $response['message'] = ALERT_OFFER_CREATE_INSERT_IMAGE_TO_DATABASE_ERROR;
                    }
                } else {
                    $response['message'] = ALERT_OFFER_CREATE_UPLOAD_FILE_ERROR;
                }
            } else {
                $response['message'] = ALERT_OFFER_CREATE_FILE_EXIST_ERROR;
            }
        } else {
            $response['message'] = ALERT_OFFER_CREATE_FILE_EXTENSION_ERROR;
        }
    }
    echo json_encode($response);
}


