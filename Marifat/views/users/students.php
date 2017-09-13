<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'USERS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'acl/students',
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
                header: '<i class="fa fa-key"></i>', 
                renderer:function(row) {
                    return A(_form + '.OnEdit(' + row.id + ')', 'Edit', '<i class="fa fa-key"></i>');
                },
                exclude_excel : true,
                sorting: false
            },
    		{ header:'Nama Pengguna', renderer:'user_name' },
            { header:'Nama Lengkap', renderer:'full_name' },
            { header:'Email', renderer:'email' }
    	],
        can_add: false
    });

    new FormBuilder( _form , {
	    controller:'acl/students',
	    fields: [
            { label:'Kata Sandi', name:'user_password', type:'password' },
            { label:'Ulangi Kata Sandi', name:'retype_user_password', type:'password' }
	    ]
  	});
</script>