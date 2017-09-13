<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'PHASES', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'admission/phases',
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
    		{ header:'Tahun', renderer:'year' },
    		{ header:'Gelombang', renderer:'phase' },
            { 
                header:'Tanggal Mulai', 
                renderer: function( row ) {
                    return row.start_date ? H.indo_date(row.start_date) : '';
                },
                sort_field: 'start_date'
            },
            { 
                header:'Tanggal Selesai', 
                renderer: function( row ) {
                    return row.end_date ? H.indo_date(row.end_date) : '';
                },
                sort_field: 'end_date'
            }
    	]
    });

    new FormBuilder( _form , {
	    controller:'admission/phases',
	    fields: [
            { label:'Tahun', name:'year' },
            { label:'Gelombang', name:'phase' },
            { label:'Tanggal Mulai', name:'start_date', type:'date' },
            { label:'Tanggal Selesai', name:'end_date', type:'date' }
	    ]
  	});
</script>