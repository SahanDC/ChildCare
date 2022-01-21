<?php
include('config/db.php');
require_once('models/request.php');

// $connection;

global $requestObj;

$requestObj = new Request($connection);

define('UPLOAD_DIRECTORY', './requests/');
define('MAXSIZE', 10485760);

$ALLOWED_EXTENSIONS = array('pdf');
$ALLOWED_MIMES = array(
    'application/pdf',
);

function validFileType($uploadedTempFile, $destFilePath)
{
    global $ALLOWED_EXTENSIONS, $ALLOWED_MIMES;
    $fileExtension = strtolower(pathinfo($destFilePath, PATHINFO_EXTENSION));
    $fileMime = mime_content_type($uploadedTempFile);
    $validFileExtension = in_array($fileExtension, $ALLOWED_EXTENSIONS);
    $validFileMime = in_array($fileMime, $ALLOWED_MIMES);
    $validFileType = $validFileExtension && $validFileMime;
    return $validFileType;
}

function handleUpload1($connection)
{
    $uploadedTempFile = $_FILES['file1']['tmp_name'];
    $filename = date("Ymd-His-", time()) . $_SESSION['id'] . "-" . basename($_FILES['file1']['name']);
    $destFile = UPLOAD_DIRECTORY . $filename;
    $isUploadedFile = is_uploaded_file($uploadedTempFile);
    $validSize = $_FILES['file1']['size'] <= MAXSIZE && $_FILES['file1']['size'] >= 0;
    if ($isUploadedFile && $validSize && validFileType($uploadedTempFile, $destFile)) {
        $upload = move_uploaded_file($uploadedTempFile, $destFile);
        if ($upload) {
            $requestObj = new Request($connection);
            $success = $requestObj->createRequest1($_SESSION['id'], $filename);

            // $connection->query("INSERT into request (parent_id, birth_certificate, uploaded_on, status) VALUES ('" . $_SESSION['id'] . "', '" . $filename . "', now(), 'New')");

            if ($success) {
                // $response = 'The file was uploaded successfully!';
                $response = '<div class="alert alert-success mt-1">
                                  Documents successfully uploaded!
                                </div>
                           ';
                // header("Location: ./dashboard.php?sucess");
            } else {
                $response = '<div class="alert alert-danger mt-1">
                An unexpected error occurred; the file could not be uploaded.
              </div>
         ';
            }
        }
    } else {
        $response = '<div class="alert alert-danger mt-1">Error: the file you tried to upload is not a valid file. Check file  -
    type and size.</div>';
    }
    return $response;
}

function handleUpload2($connection)
{
    $uploadedTempFile1 = $_FILES['file1']['tmp_name'];
    $filename1 = date("Ymd-His-", time()) . $_SESSION['id'] . "-" . basename($_FILES['file1']['name']);
    $destFile1 = UPLOAD_DIRECTORY . $filename1;
    $isUploadedFile1 = is_uploaded_file($uploadedTempFile1);
    $validSize1 = $_FILES['file1']['size'] <= MAXSIZE && $_FILES['file1']['size'] >= 0;
    if ($isUploadedFile1 && $validSize1 && validFileType($uploadedTempFile1, $destFile1)) {
        $upload1 = move_uploaded_file($uploadedTempFile1, $destFile1);
    } else {
        $response = '<div class="alert alert-danger mt-1">
        Error: the file you tried to upload is not a valid file. Check file  -
        type and size.
        </div>';
    }
    $uploadedTempFile2 = $_FILES['file2']['tmp_name'];
    $filename2 = date("Ymd-His-", time()) . $_SESSION['id'] . "-" . basename($_FILES['file2']['name']);
    $destFile2 = UPLOAD_DIRECTORY . $filename2;
    $isUploadedFile2 = is_uploaded_file($uploadedTempFile2);
    $validSize2 = $_FILES['file2']['size'] <= MAXSIZE && $_FILES['file2']['size'] >= 0;
    if ($isUploadedFile2 && $validSize2 && validFileType($uploadedTempFile2, $destFile2)) {
        $upload2 = move_uploaded_file($uploadedTempFile2, $destFile2);
    } else {
        $response = '<div class="alert alert-danger">
        Error: the file you tried to upload is not a valid file. Check file  -
           type and size.
           </div>';
    }
    if ($upload1 && $upload2) {
        $requestObj = new Request($connection);
        $success = $requestObj->createRequest2($_SESSION['id'], $filename1, $filename2);
        // $connection->query("INSERT into request (parent_id, birth_certificate, clinic_card, uploaded_on, status) VALUES ('" . $_SESSION['id'] . "', '" . $filename1 . "', '" . $filename2 . "', now(), 'New')");

        if ($success) {
            // $response = 'The files were uploaded successfully!';
            $response = '<div class="alert alert-success mt-1">
            Documents successfully uploaded!
          </div>';
            // header("Location: ./dashboard.php");
        } else {
            $response = '<div class="alert alert-danger mt-1">
            An unexpected error occurred; the file could not be uploaded.
            </div>';
        }
    }

    return $response;
}

function validForm($file)
{
    $error = $file['error'];
    switch ($error) {
        case UPLOAD_ERR_OK:
            $response = 'No errors';
            break;
        case UPLOAD_ERR_INI_SIZE:
            $response = '<div class="alert alert-danger">
            Error: file size is bigger than allowed.
            </div>';
            break;
        case UPLOAD_ERR_PARTIAL:
            $response = '<div class="alert alert-danger">
            Error: the file was only partially uploaded.
            </div>';
            break;
        case UPLOAD_ERR_NO_FILE:
            $response = '<div class="alert alert-danger">Error: no file could have been uploaded.
            </div>';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $response = '<div class="alert alert-danger">Error: no temp directory! Contact the administrator.
            </div>';
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $response = '<div class="alert alert-danger">Error: it was not possible to write in the disk. Contact the - administrator.
            </div>';
            break;
        case UPLOAD_ERR_EXTENSION:
            $response = '<div class="alert alert-danger">Error: a PHP extension stopped the upload. Contact the - administrator.
            </div>';
            break;
        default:
            $response = '<div class="alert alert-danger">An unexpected error occurred; the file could not be uploaded.
            </div>';
            break;
    }
    return $response;
}

$validFormSubmission = !empty($_FILES);
if ($validFormSubmission) {
    if (validForm($_FILES['file1']) == 'No errors') {
        if (isset($_POST['clinic_card']) && $_POST['clinic_card'] == 'Yes') {
            if (validForm($_FILES['file2']) == 'No errors') {
                $response = handleUpload2($connection);
            } else {
                $response = '<div class="alert alert-danger mt-1">An unexpected error occurred; the file could not be uploaded.
                </div>';
            }
        } else {
            $response = handleUpload1($connection);
        }
    } else {
        $response = '<div class="alert alert-danger mt-1">An unexpected error occurred; the file could not be uploaded.
        </div>';
    }
} else {
    //     $response = '<div class="alert alert-danger">Error: the form was not submitted correctly - did you try to access the - action url directly?
    //     </div>';
    // $response = '<div class="alert alert-light"></div>';
    $response = '';
}
