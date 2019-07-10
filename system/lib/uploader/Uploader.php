<?php

namespace App\Lib;


class Uploader
{


	public $upload_dir;
	public $upload_dir_url;
	public $encrypt_filename = false;
	public $allowed_mime = [];
	public $remove_spaces = true;
	public $overide_existing = false;
	public $max_upload_size = 128; //MB
    public $thumbnails;



	function upload()
	{




        $files = $this->rearrange_file_array($_FILES['userfile']);


		$result = array();

		foreach ($files as $file) {


			$errors = array();

			$thumbs = array();

			$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));




			$file_name = $file['name'];

			if(!file_exists($this->upload_dir)){
			    mkdir($this->upload_dir, 0755, true);
            }

			if ($this->remove_spaces) {

				$file_name = str_replace(' ', '-', $file['name']);
			}

			if ($this->encrypt_filename) {

				$file_name = md5(time() . $file['name']) . "." . $ext;

			}
			if (file_exists($this->upload_dir . $file_name) && !$this->overide_existing) {

                $without_ext = str_replace(".".$ext, '', $file['name']);

				$file_name = $without_ext . "-".time()."." . $ext;
			}

			if (!in_array($ext, $this->allowed_mime)) {

				$errors[] = $file_name." - File type is not allowed";

			}

			if ($file['size'] >= ($this->max_upload_size * 1048576) ) {
				$errors[] = $file_name." - File size exceeded " . $this->max_upload_size  . " MB";

			}


			if(empty($errors)) {



                if (move_uploaded_file($file['tmp_name'], $this->upload_dir . $file_name)) {



                    if(!empty($this->thumbnails) && in_array($ext, array('png', 'gif', 'jpeg', 'jpg'))){


                        foreach($this->thumbnails as $thumb){

                            $without_ext = str_replace(".".$ext, '', $file_name);


                            $thumb_filename = $without_ext."-".$thumb['width']."x".$thumb['height'].".".$ext;




                            if($this->make_thumb_alt($this->upload_dir . $file_name, $this->upload_dir.$thumb_filename, $thumb['width'], $thumb['height'], $thumb['option'])){

                                $thumbs[] = array('path' => $this->upload_dir.$thumb_filename, 'url' => $this->upload_dir_url.$thumb_filename, 'filename' => $thumb_filename, 'dimensions' => $thumb['width'].'x'.$thumb['height'], 'name' => $thumb['name']);

                            }


                        }
                    }


                    $response = array(
                        'result' => 'success',
                        'file_name' => $file_name,
                        'original_name' => $file['name'],
                        'file_size' => $file['size'],
                        'file_type' => $file['type'],
                        'extension' => $ext,
                        'upload_location' => $this->upload_dir . $file_name,
                        'upload_url' => $this->upload_dir_url . $file_name,
                        'message' => $file_name . " - Uploaded successfully",
                        "thumbs" => $thumbs

                    );


                } else {

                    $response = array(
                        'result' => 'error',
                        'file_name' => $file_name,
                        'original_name' => $file['name'],
                        'file_size' => $file['size'],
                        'file_type' => $file['type'],
                        'extension' => $ext,
                        'message' => 'Could not upload file, an unknown error has occurred.',

                    );

                }

            }else{

                $response = array(
                    'result' => 'error',
                    'file_name' => $file_name,
                    'original_name' => $file['name'],
                    'file_size' => $file['size'],
                    'file_type' => $file['type'],
                    'extension' => $ext,
                    'message' => $errors,

                );

            }

			array_push($result, $response);
		}


		return $result;


	}


	private function rearrange_file_array(&$file_post)
	{

		$file_ary = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);

		for ($i = 0; $i < $file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_ary[$i][$key] = $file_post[$key][$i];
			}
		}

		return $file_ary;
	}




    function make_thumb_alt($src, $dest, $targetWidth, $targetHeight, $option="auto") {

        $resizeObj = new Thumbs($src);
        $resizeObj -> resizeImage($targetWidth, $targetHeight, $option);

        return $resizeObj->saveImage($dest, 100);
    }

}