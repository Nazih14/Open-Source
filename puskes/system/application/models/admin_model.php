<?php
class Admin_model extends Model
	{
		function Admin_model()
		{
			parent::Model();
		}
        //-----------------------------Query Data Obat
        function Tampil_Ska($id_kategori)
		{
		$t=$this->db->query("select * from tbl_obat  where id_kategori='$id_kategori'");
		return $t;
		}
        function Tampil_Detail($id_kategori,$limit,$offset)
		{
		$t=$this->db->query("select * from tbl_obat where id_kategori='$id_kategori' order by id_obat DESC LIMIT $offset,$limit");
		return $t;
		}
		function Total_Detail($id_kategori)
		{
		$ta=$this->db->query("select * from tbl_obat  where id_kategori='$id_kategori'");
		return $ta;
		}
        function Tampil($limit,$offset)
		{
		$t=$this->db->query("select * from tbl_transaksi left join (tbl_kategori,tbl_obat) on tbl_transaksi.id_obat=tbl_obat.id_obat and tbl_transaksi.id_kategori=tbl_kategori.id_kategori order by id_transaksi DESC LIMIT $offset,$limit");
		return $t;
		}
		function Total_Transaksi()
		{
		$ta=$this->db->query("select * from tbl_transaksi");
		return $ta;
		}
		 function Tampil_Sub($limit,$offset)
		{
			$t=$this->db->query("select * from tbl_sub left join tbl_kategori
			on tbl_sub.id_kategori=tbl_kategori.id_kategori order by id_sub DESC LIMIT $offset,$limit");
			return $t;
		}
        function Tampil_Obat($limit,$offset)
		{
			$t=$this->db->query("select * from tbl_obat left join(tbl_kategori)on tbl_obat.id_kategori=tbl_kategori.id_kategori order by id_obat DESC LIMIT $offset,$limit");
			return $t;
		}
		function Tampil_Rekap($kategori,$limit,$offset)
		{
			$t=$this->db->query("select * from tbl_obat left join(tbl_kategori)on tbl_obat.id_kategori=tbl_kategori.id_kategori where tbl_obat.id_kategori=$kategori order by id_obat DESC LIMIT $offset,$limit");
			return $t;
		}
		function Total_Rekap($kategori)
		{
			$ta=$this->db->query("select * from tbl_obat where tbl_obat.id_kategori=$kategori");
			return $ta;
		}
		function Tampil_Stok($limit,$offset)
		{
			$stok=0;  
			$stok15=15;
			$t=$this->db->query("select * from tbl_obat left join(tbl_kategori)on tbl_obat.id_kategori=tbl_kategori.id_kategori where tbl_obat.stok between '$stok' and '$stok15' order by id_obat DESC LIMIT $offset,$limit");
			return $t;
		}
		function Get_Provinsi()	{
		
		$query = $this->db->get('tbl_kategori');
		return $query->result();
		
		}
		function Get_Kota()	{
		
		$query = $this->db->get('tbl_sub');
		return $query->result();
		
		}
		function Total_Sub()
		{
			$ta=$this->db->query("select * from tbl_sub");
			return $ta;
		}
		function Total_Obat()
		{
			$ta=$this->db->query("select * from tbl_obat");
			return $ta;
		}
		function Total_Stok()
		{
			$ta=$this->db->query("select * from tbl_obat");
			return $ta;
		}
		function Simpan_Obat($in)
		{
			$kat=$this->db->insert('tbl_obat',$in);
			return $kat;
		}
		function Edit_Obat($id)
		{
			$t=$this->db->query("select * from tbl_obat left join (tbl_kategori)on tbl_obat.id_kategori=tbl_kategori.id_kategori where id_obat='$id'");
			return $t;
		}
		function Detail($id)
		{
			$t=$this->db->query("select * from tbl_obat  where id_kategori='$id'");
			return $t;
		}
		function Update_Obat($in)
		{
			$this->db->where('id_obat',$in['id_obat']);
			$this->db->update('tbl_obat',$in);
		}
		function Delete_Obat($id)
		{
			$this->db->where('id_obat',$id);
			$this->db->delete('tbl_obat');
		}
        function Total_Artikel($tabel)
		{
			$q=$this->db->query("select * from $tabel");
			return $q;
		}
        //=====================TRANSAKSI OBAT==================
        	function Add_Transaksi($id_obat)
		{
			$t=$this->db->query("select * from tbl_obat  where id_obat='$id_obat'");
			return $t;
		}
        	function Update_Counter($id_obat)
		{
			$query_update=$this->db->query("update tbl_obat set counter=counter+1 where id_obat='$id_obat'");
			return $query_update;
		}
		function Simpan_Artikel($tabel,$data)
		{
			$s=$this->db->insert($tabel,$data);
			return $s;
		}
        	function Update($in,$stok)
		{
			$query_update=$this->db->query("update tbl_obat set stok=stok-'$stok' where id_obat=".$in['id_obat']."");
			return $query_update;
		}
        	function Simpan_Aksi($in)
		{
			$kat=$this->db->insert('tbl_transaksi',$in);
			return $kat;
		}
        	function Detail_Transaksi($id_obat)
		{
			$query_detail_obat=$this->db->query("SELECT * from tbl_obat left join (tbl_kategori)on tbl_obat.id_kategori=tbl_kategori.id_kategori where id_obat='$id_obat'");
			return $query_detail_obat;
		}
        //=====================================================
		function Tampil_Katobat($limit,$ofset)
		{
			$t=$this->db->query("select * from tbl_kategori order by id_kategori DESC LIMIT $ofset,$limit");
			return $t;
		}
		function Total_Katobat()
		{
			$t=$this->db->query("select * from tbl_kategori");
			return $t;
		}
	   	function Edit_Kat_Obat($id)
		{
			$t=$this->db->query("select * from tbl_kategori where id_kategori='$id'");
			return $t;
		}
			function Edit_Sub($id)
		{
			$t=$this->db->query("select * from tbl_sub where id_sub='$id'");
			return $t;
		}
		function Kat_Obat()
		{
			$kat=$this->db->query("select * from tbl_kategori order by id_kategori DESC");
			return $kat;
		}
        function Kategori($id_kategori)
		{
			$kat=$this->db->query("select * from tbl_kategori where id_kategori='$id_kategori' order by id_kategori DESC");
			return $kat;
		}
        function Kat_Rekap()
		{
			$kat=$this->db->query("select * from tbl_kategori order by id_kategori DESC");
			return $kat;
		}
		function Update_Kat_obat($in)
		{
			$this->db->where('id_kategori',$in['id_kategori']);
			$this->db->update('tbl_kategori',$in);
		}
		function Update_Sub($in)
		{
			$this->db->where('id_sub',$in['id_sub']);
			$this->db->update('tbl_sub',$in);
		}
		function Simpan_Kat_obat($in)
		{
			$kat=$this->db->insert('tbl_kategori',$in);
			return $kat;
		}
		function Simpan_Sub($in)
		{
			$kat=$this->db->insert('tbl_sub',$in);
			return $kat;
		}
		function Hapus_Kat_obat($id)
		{
			$this->db->where('id_kategori',$id);
			$this->db->delete('tbl_kategori');
		}
		function Edit_Content($tabel,$seleksi)
		{
			$query=$this->db->query("select * from $tabel where $seleksi");
			return $query;
		}
		function Update_Content($tabel,$isi,$seleksi)
		{
			$this->db->where($seleksi,$isi[$seleksi]);
			$this->db->update($tabel,$isi);
		}
		function Delete_Content($id,$seleksi,$tabel)
		{
			$this->db->where($seleksi,$id);
			$this->db->delete($tabel);
		}
		function Tampil_Data($tabel,$id)
		{
			$q=$this->db->query("select * from ".$tabel." order by ".$id." DESC");
			return $q;
		}
		function Tampil_Data_Terbatas($tabel,$id,$join,$offset,$limit)
		{
			$q=$this->db->query("select * from ".$tabel." ".$join." order by ".$id." DESC LIMIT ".$offset.",".$limit."");
			return $q;
		}
		function Tampil_Data_Terseleksi($tabel,$id,$id_seleksi)
		{
			$q=$this->db->query("select * from ".$tabel." where ".$id." = ".$id_seleksi."");
			return $q;
		}
		function Daftar_Akses($offset,$limit)
		{
			$q=$this->db->query("select * from tbl_akses order by tbl_akses.id_user ASC LIMIT $offset,$limit");
			return $q;
		}
		function Simpan_Akses($in)
		{
			$this->db->trans_start();
			$this->db->query("INSERT INTO tbl_akses (nip, nama_user, jabatan, jenis_kelamin, status, username, password) VALUES ('".$in['nip']."',
			'".$in['nama_user']."', '".$in['jabatan']."','".$in['jenis_kelamin']."', '".$in['status']."', '".$in['username']."',
			md5( '".$in['password']."'))");
			$this->db->trans_complete();
			$sukses = TRUE;
			if ($this->db->trans_status() === FALSE)
			{
				$sukses = FALSE;
			} 
			return $sukses;
		}
		function Update_Password($in,$id)
		{
			$q=$this->db->query("update tbl_akses set password=md5('".$in."') where id_user='".$id."'");
			return $q;
		}
		

		function Simpan_Data($query)
		{
			$this->db->query($query);
		}
	function Total_Data($tabel)
		{
			$q=$this->db->query("select * from $tabel");
			return $q;
		}
       function Rekap_Jamkesmas($tanggal,$tanggal_awal)
   		{
      	$query_tampil=$this->db->query("SELECT * from tbl_obat left join (tbl_kategori)on tbl_obat.id_kategori=tbl_kategori.id_kategori where  tgl_masuk between '$tanggal' and '$tanggal_awal'");
        return $query_tampil;
        }
         function Rekap_Transaksi($tanggal_awal,$tanggal_akhir)
   		{
      	$query_tampil=$this->db->query("SELECT * from tbl_transaksi left join (tbl_obat,tbl_kategori)on tbl_transaksi.id_obat=tbl_obat.id_obat and tbl_transaksi.id_kategori=tbl_kategori.id_kategori where tanggal between '$tanggal_awal' and '$tanggal_akhir'");
        return $query_tampil;
        }
        function Rekap_Obat()
		{
			$kat=$this->db->query("select * from tbl_transaksi left join (tbl_kategori,tbl_obat)on tbl_transaksi.id_kategori=tbl_kategori.id_kategori and tbl_transaksi.id_obat=tbl_obat.id_obat order by id_obat DESC");
			return $kat;
		}
         function Ambildata_Jam($id_kategori)
    {
        $sql="select * from tbl_kategori where id_kategori='$id_kategori'";
        $q=$this->db->query($sql);
        if($q->num_rows()>0)
        {
            foreach($q->result_array()as $row)
            {
                $data[]=$row;
            }
        }
        $q->free_result();
        return $data;
    }
         function Ambildata($id_kategori)
    {
        $sql="select * from tbl_kategori where id_kategori='$id_kategori'";
        $q=$this->db->query($sql);
        if($q->num_rows()>0)
        {
            foreach($q->result_array()as $row)
            {
                $data[]=$row;
            }
        }
        $q->free_result();
        return $data;
    }
}