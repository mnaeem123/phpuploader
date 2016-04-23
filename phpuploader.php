<?php

/*
#############################################
###SETTINGS
############################################
*/
$__ALLOWED_IMAGE_FORMATS = array('jpg' , 'jpeg' , 'png' , 'gif' );
$__ALLOWED_VIDEO_FORMATS = array('mp4' );
$__MAX_IMAGE_FILE_SIZE = 2048000; // 2 MB
$__MAX_VIDEO_FILE_SIZE = 8192000; // 8 MB
$__UPLOAD_PATH = 'uploads/';
$__VALID_FILE = true;
/*############################################*/

if($_FILES['file']['name'])
{
	//if no errors...
	if(!$_FILES['file']['error'])
	{
		//now is the time to modify the future file name and validate the file

		if(in_array($_FILES['file']['type'], $__ALLOWED_IMAGE_FORMATS))
		{
			$new_file_name = strtolower($_FILES['file']['tmp_name']); //rename file
			if($_FILES['file']['size'] > ($__MAX_IMAGE_FILE_SIZE))
			{
				$__VALID_FILE = false;
				$message = 'Oops!  Your file\'s size is to large.';
			}
		}
		else if(in_array($_FILES['file']['type'], $__ALLOWED_VIDEO_FORMATS)
		{
			$new_file_name = strtolower($_FILES['file']['tmp_name']); //rename file
			if($_FILES['file']['size'] > ($__MAX_VIDEO_FILE_SIZE))
			{
				$__VALID_FILE = false;
				$message = 'Oops!  Your file\'s size is to large.';
			}
		}
		else
		{
			$__VALID_FILE = false;
			$message = 'Invalid format : format not allowed';
		}
		
		//if the file has passed the test
		if($__VALID_FILE)
		{
			$__FILE_PATH = $__UPLOAD_PATH.time().'_'.$new_file_name
			//move it to where we want it to be
			if(move_uploaded_file($_FILES['file']['tmp_name'], $__FILE_PATH))
				$message = 'Congratulations!  Your file was accepted.';
			else
				$message = 'Error occured while uploading';
		}
	}
	//if there is an error...
	else
	{
		//set that to be the returned message
		$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
	}
}
else
{
	$message = 'No file selected!';
}
