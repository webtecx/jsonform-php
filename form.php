<?php
// Files form script with given data in json file

if(isset($argv[1])) {
  $files = json_decode(file_get_contents($argv[1]));
} else {
  echo "No files to process.";
  exit;
}

foreach($files->data as $file) {

  @unlink($file->docofile);

  $data = file_get_contents($file->docafile);
  $json = json_decode(file_get_contents($file->jsonfile), TRUE);

  foreach($json as $key => $item) {
    $data = str_replace("[[$key]]", "$item", $data);
  }

  file_put_contents($file->docofile, $data);

}
