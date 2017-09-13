<?php
class Web_model extends Model
	{
		function Web_model()
		{
			parent::Model();
		}
		function Data_Login($user,$pass)
		{
			$user_bersih=mysql_real_escape_string($user);
			$pass_bersih=mysql_real_escape_string($pass);
			$query=$this->db->query("select * from tbl_akses where username='$user_bersih' and password=md5('$pass_bersih')");
			return $query;
		}
		function Update_Password($nim,$pwd)
		{
			$this->db->query("update tblkepegawaian set password=md5('$pwd') where username='$nim'");
		}
	}
?>
