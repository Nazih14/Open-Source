<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'OPTIONS',
        _form1 = _grid + '_FORM1', // post_per_page
        _form2 = _grid + '_FORM2', // post_rss_count
        _form3 = _grid + '_FORM3', // post_related_count
        _form4 = _grid + '_FORM4'; // comment_per_page
	new GridBuilder( _grid , {
        controller:'settings/reading',
        fields: [
            {
                header: '<i class="fa fa-cog"></i>', 
                renderer:function(row) {
                    if (row.variable == 'post_per_page') {
                        return A(_form1 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'post_rss_count') {
                        return A(_form2 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'post_related_count') {
                        return A(_form3 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'comment_per_page') {
                        return A(_form4 + '.OnEdit(' + row.id + ')');
                    }
                },
                exclude_excel : true,
                sorting: false
            },
    		{ header:'Setting Name', renderer: 'description' },
            { 
                header:'Setting Value', 
                renderer: function(row){
                    return row.value ? row.value : '';
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
     * post_per_page
     */
    new FormBuilder( _form1 , {
        controller:'settings/reading',
        fields: [
            { label:'Tulisan per halaman', name:'value', type:'number' }
        ]
    });

    /**
     * post_rss_count
     */
    new FormBuilder( _form2 , {
        controller:'settings/reading',
        fields: [
            { label:'Jumlah RSS', name:'value', type:'number' }
        ]
    });

    /**
     * post_related_count
     */
    new FormBuilder( _form3 , {
        controller:'settings/reading',
        fields: [
            { label:'Jumlah Tulisan Terkait', name:'value', type:'number' }
        ]
    });

    /**
     * comment_per_page
     */
    new FormBuilder( _form4 , {
        controller:'settings/reading',
        fields: [
            { label:'Komentar per halaman', name:'value', type:'number' }
        ]
    });
</script>