<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'OPTIONS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'students/residence',
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
    		{ header:'Tempat Tinggal', renderer:'option' }
    	]
    });

    new FormBuilder( _form , {
	    controller:'students/residence',
	    fields: [
            { label:'Tempat Tinggal', name:'option' }
	    ]
  	});
</script>