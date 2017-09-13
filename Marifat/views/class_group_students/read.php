<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
	 DS.ClassGroups = <?=$ds_class_groups?>;
	 var _grid = 'STUDENTS', _form = _grid + '_FORM';
	 new GridBuilder( _grid , {
		  controller:'students/class_group_students',
		  fields: [
				{ 
					 header: '<input type="checkbox" class="check-all">', 
					 renderer:function(row) {
						return CHECKBOX(row.id, 'id');
					},
					exclude_excel : true,
					sorting: false
				},
				{ 
					 header: '<i class="fa fa-edit"></i>', 
					 renderer:function(row) {
						  return A(_form + '.OnEdit(' + row.id + ')', 'Edit');
					},
					exclude_excel : true,
					sorting: false
				},
				{ header:'Tahun Akademik', renderer:'academic_year', sorting: false },
				{ header:'Kelas', renderer:'class_group', sorting: false },
				{ header:'NIS', renderer:'nis', sorting: false },
				{ header:'NISN', renderer:'nisn', sorting: false },
				{ header:'Nama Lengkap', renderer:'full_name', sorting: false },
				{ header:'Tempat Lahir', renderer:'birth_place', sorting: false },
				{ 
					header:'Tanggal Lahir', 
					renderer: function(row) {
						return row.birth_date && row.birth_date !== '0000-00-00' ? H.indo_date(row.birth_date) : '';
					},
					sort_field: 'birth_date'
				},
				{ 
					header:'Jenis Kelamin', 
					renderer: function( row ) {
						return DS.Gender[ row.gender ];
					} ,
					sort_field: 'gender'
				}
		  ],
		  resize_column: 3,
		  to_excel: true,
		  can_add: false
	 });

	 new FormBuilder( _form , {
		  controller:'students/class_group_students',
		  fields: [
				{ label:'Kelas', name:'class_group_id', type:'select', datasource:DS.ClassGroups }
		  ]
	 });
</script>