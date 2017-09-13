<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'VIDEOS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'media/videos',
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
    		{ header:'Judul', renderer:'post_title' },
    		{ header:'Tampilan', renderer:'post_content' }
    	]
    });

    new FormBuilder( _form , {
	    controller:'media/videos',
	    fields: [
            { label:'Judul', name:'post_title' },
            { label:'Embed', name:'post_content', type:'textarea' }
	    ]
  	});
</script>