<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.LinkTarget = {
        '_blank':'Blank',
        '_self':'Self',
        '_parent':'Parent',
        '_top':'Top'
    };
    var _grid = 'LINKS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'blog/links',
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
    		{ header:'URL', renderer:'url' },
    		{ header:'Keterangan', renderer:'title' },
            { 
                header:'Target', 
                renderer: function(row) {
                    return DS.LinkTarget[row.target];
                },
                sort_field: 'target'
            }
    	]
    });

    new FormBuilder( _form , {
	    controller:'blog/links',
	    fields: [
            { label:'URL', name:'url', placeholder:'Add prefix http://' },
            { label:'Keterangan', name:'title' },
            { label:'Target', name:'target', type:'select', datasource:DS.LinkTarget }
	    ]
  	});
</script>