<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'OPTIONS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'students/student_status',
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
    		{ header:'Status Peserta Didik', renderer:'option' }
    	]
    });

    new FormBuilder( _form , {
	    controller:'students/student_status',
	    fields: [
            { label:'Status Peserta Didik', name:'option' }
	    ]
  	});
</script>