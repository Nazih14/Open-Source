<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'MAJORS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'students/majors',
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
    		{ header:'Program Keahlian', renderer:'major' },
    		{ header:'Nama Singkat', renderer:'short_name' }
    	]
    });

    new FormBuilder( _form , {
	    controller:'students/majors',
	    fields: [
            { label:'Program Keahlian', name:'major' },
            { label:'Nama Singkat', name:'short_name' }
	    ]
  	});
</script>