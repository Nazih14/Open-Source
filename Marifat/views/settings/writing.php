<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.OptionsCategories = <?=$options_categories;?>;
    var _grid = 'OPTIONS',
        _form1 = _grid + '_FORM1', // default_post_category
        _form2 = _grid + '_FORM2', // default_post_status
        _form3 = _grid + '_FORM3', // default_post_visibility
        _form4 = _grid + '_FORM4', // default_post_discussion
        _form5 = _grid + '_FORM5', // post_image_thumbnail_height
        _form6 = _grid + '_FORM6', // post_image_thumbnail_width
        _form7 = _grid + '_FORM7', // post_image_medium_height
        _form8 = _grid + '_FORM8', // post_image_medium_width
        _form9 = _grid + '_FORM9', // post_image_large_height
        _form10 = _grid + '_FORM10'; // post_image_large_width
	new GridBuilder( _grid , {
        controller:'settings/writing',
        fields: [
            {
                header: '<i class="fa fa-cog"></i>', 
                renderer:function(row) {
                    if (row.variable == 'default_post_category') {
                        return A(_form1 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'default_post_status') {
                        return A(_form2 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'default_post_visibility') {
                        return A(_form3 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'default_post_discussion') {
                        return A(_form4 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'post_image_thumbnail_height') {
                        return A(_form5 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'post_image_thumbnail_width') {
                        return A(_form6 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'post_image_medium_height') {
                        return A(_form7 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'post_image_medium_width') {
                        return A(_form8 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'post_image_large_height') {
                        return A(_form9 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'post_image_large_width') {
                        return A(_form10 + '.OnEdit(' + row.id + ')');
                    }
                },
                exclude_excel : true,
                sorting: false
            },
    		{ header:'Setting Name', renderer: 'description' },
            { 
                header:'Setting Value', 
                renderer: function(row){
                    if (row.variable == 'default_post_category') {
                        return row.value ? DS.OptionsCategories[row.value] : '';
                    }
                    if (row.variable == 'default_post_status') {
                        return row.value ? DS.PublishDraft[row.value] : '';
                    }
                    if (row.variable == 'default_post_visibility') {
                        return row.value ? DS.Visibility[row.value] : '';
                    }
                    if (row.variable == 'default_post_discussion') {
                        return row.value ? DS.OpenClose[row.value] : '';
                    }
                    return row.value;
                },
                sort_field:'value'
            }
    	],
        can_add: false,
        can_delete: false,
        can_restore: false,
        resize_column: 2,
        per_page: 50,
        per_page_options: [50, 100]
    });

    /**
     * default_post_category
     */
    new FormBuilder( _form1 , {
        controller:'settings/writing',
        fields: [
            { label:'Default Kategori Tulisan', name:'value', type:'select', datasource:DS.OptionsCategories }
        ]
    });
    
    /**
     * default_post_status
     */
    new FormBuilder( _form2 , {
        controller:'settings/writing',
        fields: [
            { label:'Default Status Tulisan', name:'value', type:'select', datasource:DS.PublishDraft }
        ]
    });

    /**
     * default_post_visibility
     */
    new FormBuilder( _form3 , {
        controller:'settings/writing',
        fields: [
            { label:'Default Akses Tulisan', name:'value', type:'select', datasource:DS.Visibility }
        ]
    });

    /**
     * default_post_discussion
     */
    new FormBuilder( _form4 , {
        controller:'settings/writing',
        fields: [
            { label:'Default Komentar Tulisan', name:'value', type:'select', datasource:DS.OpenClose }
        ]
    });

    /**
     * post_image_thumbnail_height
     */
    new FormBuilder( _form5 , {
        controller:'settings/writing',
        fields: [
            { label:'Tinggi Gambar Kecil', name:'value', type:'number' }
        ]
    });

    /**
     * post_image_thumbnail_width
     */
    new FormBuilder( _form6 , {
        controller:'settings/writing',
        fields: [
            { label:'Lebar Gambar Kecil', name:'value', type:'number' }
        ]
    });

    /**
     * post_image_medium_height
     */
    new FormBuilder( _form7 , {
        controller:'settings/writing',
        fields: [
            { label:'Tinggi Gambar Sedang', name:'value', type:'number' }
        ]
    });

    /**
     * post_image_medium_width
     */
    new FormBuilder( _form8 , {
        controller:'settings/writing',
        fields: [
            { label:'Lebar Gambar Sedang', name:'value', type:'number' }
        ]
    });

    /**
     * post_image_large_height
     */
    new FormBuilder( _form9 , {
        controller:'settings/writing',
        fields: [
            { label:'Tinggi Gambar Besar', name:'value', type:'number' }
        ]
    });

    /**
     * post_image_large_width
     */
    new FormBuilder( _form10 , {
        controller:'settings/writing',
        fields: [
            { label:'Lebar Gambar Besar', name:'value', type:'number' }
        ]
    });
</script>