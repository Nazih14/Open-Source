<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.UserGroups = <?=$user_group_dropdown;?>;
    DS.Modules = <?=$module_dropdown;?>;
    var _grid = 'USER_PRIVILEGES', _form = _grid + '_FORM';
    new GridBuilder( _grid , {
        controller:'acl/user_privileges',
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
            { header:'Grup', renderer:'group', sorting: false },
            { header:'Modul', renderer:'module_name' },
            { header:'Keterangan', renderer:'module_description' },
            { 
                header:'URL', 
                renderer: function(row) {
                    return _BASE_URL + row.module_url;
                },
                sort_field: 'module_url'
            },
        ]
    });

    new FormBuilder( _form , {
        controller:'acl/user_privileges',
        fields: [
          { label:'Grup', name:'user_group_id', type:'select', datasource:DS.UserGroups },
          { label:'Modul', name:'module_id', type:'select', datasource:DS.Modules }
        ]
    });
</script>