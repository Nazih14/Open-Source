<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
	var _grid = 'OPTIONS', 
		_form1 = _grid + '_FORM1', // comment_moderation
		_form2 = _grid + '_FORM2', // comment_registration
		_form3 = _grid + '_FORM3', // comment_order
		_form4 = _grid + '_FORM4'; // comment_blacklist
	new GridBuilder( _grid , {
		controller:'settings/discussion',
		fields: [
			{
				header: '<i class="fa fa-cog"></i>', 
				renderer:function(row) {
					console.log(row.variable);
					if (row.variable == 'comment_moderation') {
						return A(_form1 + '.OnEdit(' + row.id + ')');
					}
					if (row.variable == 'comment_registration') {
						return A(_form2 + '.OnEdit(' + row.id + ')');
					}
					if (row.variable == 'comment_order') {
						return A(_form3 + '.OnEdit(' + row.id + ')');
					}
					return A(_form4 + '.OnEdit(' + row.id + ')');				
				},
				exclude_excel : true,
				sorting: false	
			},
			{ header:'Setting Name', renderer: 'description' },
			{ 
				header:'Setting Value', 
				renderer: function(row){
					if (row.variable == 'comment_moderation') {
						return DS.TrueFalse[ row.value ];
					}
					if (row.variable == 'comment_registration') {
						return DS.TrueFalse[ row.value ];
					}
					if (row.variable == 'comment_order') {
						return DS.AscDesc[ row.value ];
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
	 * comment_moderation
	 */
	new FormBuilder( _form1 , {
		controller:'settings/discussion',
		fields: [
			{ label:'Komentar harus disetujui secara manual', name:'value', type:'select', datasource:DS.TrueFalse }
		]
	});

	/**
	 * comment_moderation
	 */
	new FormBuilder( _form2 , {
		controller:'settings/discussion',
		fields: [
			{ label:'Pengguna harus terdaftar dan login untuk komentar', name:'value', type:'select', datasource:DS.TrueFalse }
		]
	});

	/**
	 * comment_order
	 */
	new FormBuilder( _form3 , {
		controller:'settings/discussion',
		fields: [
			{ label:'Urutan Komentar', name:'value', type:'select', datasource:DS.AscDesc }
		]
	});

	/**
	 * Comment Blacklist
	 */
	new FormBuilder( _form4 , {
		controller:'settings/admission',
		fields: [
			{ label:'Komentar disaring', name:'value', type:'textarea', placeholder:'separated by commas (,)' }
		]
	});
</script>