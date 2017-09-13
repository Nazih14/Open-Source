<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.UserGroups = <?=$user_groups_dropdown;?>;
    var _grid = 'USERS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'acl/administrator',
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
    		{ header:'Nama Pengguna', renderer:'user_name' },
            { header:'Nama Lengkap', renderer:'user_full_name' },
            { header:'Email', renderer:'user_email' },
            { header:'URL', renderer:'user_url' },
            { header:'Grup', renderer:'group' }
    	]
    });

    new FormBuilder( _form , {
	    controller:'acl/administrator',
	    fields: [
            { label:'Nama Pengguna', name:'user_name' },
            { label:'Kata Sandi', name:'user_password', type:'password' },
            { label:'Nama Lengkap', name:'user_full_name' },
            { label:'Email', name:'user_email' },
            { label:'URL', name:'user_url' },
            { label:'Grup', name:'user_group_id', type:'select', datasource:DS.UserGroups },
            { label:'Biography', name:'biography', type:'textarea' }
	    ]
  	});
</script>