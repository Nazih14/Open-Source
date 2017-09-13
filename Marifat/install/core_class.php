<?php
class Core {

	/**
	 * @param 	Array
	 * @return 	Boolean
	 */
	public function validate_post($data) {
		/* Validating the hostname, the database name and the username. The password is optional. */
		return !empty($data['database_hostname']) && !empty($data['database_username']) && !empty($data['database_name']);
	}

	/**
	 * Write File
	 * @param 	array
	 * @return 	Boolean
	 */
	public function write_config($data) {
		// Config path
		$template_path = 'template/database.php';
		$output_path = '../application/config/database.php';

		// Open the file
		$database_file = file_get_contents($template_path);
		$new  = str_replace("%DATABASE_HOSTNAME%",$data['database_hostname'],$database_file);
		$new  = str_replace("%DATABASE_USERNAME%",$data['database_username'],$new);
		$new  = str_replace("%DATABASE_PASSWORD%",$data['database_password'],$new);
		$new  = str_replace("%DATABASE_NAME%",$data['database_name'],$new);

		// Write the new database.php file
		$handle = fopen($output_path,'w+');

		// Chmod the file, in case the user forgot
		@chmod($output_path,0777);

		// Verify file permissions
		if(is_writable($output_path)) {
			return fwrite($handle,$new);
		} else {
			return false;
		}
	}
}