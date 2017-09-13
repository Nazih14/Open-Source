<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.OptionsCategories = <?=$options_categories;?>;
    DS.OptionsCategories[0] = 'No Parent';
    var _grid = 'CATEGORIES', _form = _grid + '_FORM';
    new GridBuilder( _grid , {
        controller:'blog/post_categories',
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
            { header:'Kategori Tulisan', renderer:'category' },
            { header:'Keterangan', renderer:'description' },
            { header:'Slug', renderer:'slug' }
        ]
    });

    new FormBuilder( _form , {
        controller:'blog/post_categories',
        fields: [
          { label:'Kategori Tulisan', name:'category' },
          { label:'Keterangan', name:'description' }
        ]
    });
</script>