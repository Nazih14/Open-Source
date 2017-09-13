<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
	 var _grid = 'OPTIONS', 
		  _form1 = _grid + '_FORM1', // admission_status
		  _form2 = _grid + '_FORM2', // admission_year
		  _form3 = _grid + '_FORM3', // admission_start_date
		  _form4 = _grid + '_FORM4', // admission_end_date
		  _form5 = _grid + '_FORM5', // announcement_start_date
		  _form6 = _grid + '_FORM6'; // announcement_end_date  
	new GridBuilder( _grid , {
		  controller:'settings/admission',
		  fields: [
				{
					 header: '<i class="fa fa-cog"></i>', 
					 renderer:function(row) {
						  if (row.variable == 'admission_status') {
								return A(_form1 + '.OnEdit(' + row.id + ')');
						  }
						  if (row.variable == 'admission_year') {
								return A(_form2 + '.OnEdit(' + row.id + ')');
						  }
						  if (row.variable == 'admission_start_date') {
								return A(_form3 + '.OnEdit(' + row.id + ')');
						  }
						  if (row.variable == 'admission_end_date') {
								return A(_form4 + '.OnEdit(' + row.id + ')');
						  }
						  if (row.variable == 'announcement_start_date') {
								return A(_form5 + '.OnEdit(' + row.id + ')');
						  }
						  if (row.variable == 'announcement_end_date') {
								return A(_form6 + '.OnEdit(' + row.id + ')');
						  }
					 },
                exclude_excel : true,
                sorting: false
				},
				{ header:'Setting Name', renderer: 'description' },
				{ 
					header:'Setting Value', 
					renderer: function(row){
						if (row.variable == 'admission_status') {
							return DS.OpenClose[ row.value ];
						}
						return row.value ? row.value : '';
					},
					sort_field:'value'
				}
		],
		can_add: false,
		can_delete: false,
		can_restore: false,
		resize_column: 2,
		per_page: 50,
		per_page_options: [50, 100]
	 });

	/**
	 * Admission Status
	 */
	new FormBuilder( _form1 , {
		controller:'settings/admission',
		fields: [
			{ label:'Status Penerimaan Peserta Didik Baru', name:'value', type:'select', datasource:DS.OpenClose }
		]
	});

	/**
	 * Admission Year
	 */
	new FormBuilder( _form2 , {
		controller:'settings/admission',
		fields: [
			{ label:'Tahun Penerimaan Peserta Didik Baru', name:'value', type:'number' }
		]
	});

	/**
	 * Admission Start Date
	 */
	new FormBuilder( _form3 , {
		controller:'settings/admission',
		fields: [
			{ label:'Tanggal Mulai PPDB', name:'value', type:'date' }
		]
	});

	/**
	 * Admission End Date
	 */
	new FormBuilder( _form4 , {
		controller:'settings/admission',
		fields: [
			{ label:'Tanggal Selesai PPDB', name:'value', type:'date' }
		]
	});

	/**
	 * Announcement Start Date
	 */
	new FormBuilder( _form5 , {
		controller:'settings/admission',
		fields: [
			{ label:'Tanggal Mulai Pengumuman PPDB', name:'value', type:'date' }
		]
	});

	/**
	 * Announcement End Date
	 */
	new FormBuilder( _form6 , {
		controller:'settings/admission',
		fields: [
			{ label:'Tanggal Selesai Pengumuman PPDB', name:'value', type:'date' }
		]
	});
</script>