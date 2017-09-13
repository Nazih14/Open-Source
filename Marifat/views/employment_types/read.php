<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var school_level = '<?=get_school_level()?>';
    var _grid = 'OPTIONS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'employees/employment_types',
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
                header: '<i class="fa fa-cog"></i>', 
                renderer:function(row) {
                    return A(_form + '.OnEdit(' + row.id + ')', 'Edit');
                },
                exclude_excel : true,
                sorting: false
            },
    		{ header:'Jenis ' + (school_level == 5 ? 'Staff dan Dosen' : 'Guru Dan Tenaga Kependidikan'), renderer:'option' }
    	]
    });

    var form_fields = [];
    new FormBuilder( _form , {
	    controller:'employees/employment_types',
	    fields: [
            { label:'Jenis ' + (school_level == 5 ? 'Staff dan Dosen' : 'Guru Dan Tenaga Kependidikan'), name:'option' }
	    ]
  	});
    
</script>