<?php

namespace Drupal\firstmodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadController extends ControllerBase {

  /**
   * Downloads a file.
   *
   * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
   *   The file response.
   *
   * Defining the download file method
   */
  public function page(): BinaryFileResponse {
    // File paths are relative to the document root (web.)
    $file_path = 'modules/custom/firstmodule/dummy.pdf';

    /** @var \Drupal\Core\File\MimeType\MimeTypeGuesser $guesser */
    $guesser = \Drupal::service('file.mime_type.guesser');
    $mimetype = $guesser->guessMimeType($file_path);

    $response = new BinaryFileResponse($file_path);
    $response->headers->set('Content-Type', $mimetype);
    $response->setContentDisposition('attachment', basename($file_path));
    return $response;
  }

}
