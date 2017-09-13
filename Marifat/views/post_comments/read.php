<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'COMMENTS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'blog/post_comments',
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
    		{ header:'Penulis', renderer:'comment_author' },
            { header:'Komentar', renderer:'comment_content' },
            { 
                header:'Komentar Untuk', 
                renderer: function( row ) {
                    if ( row.post_title ) {
                        return '<a target="_blank" href="' + _BASE_URL + 'read/' + row.post_id + '/' + row.post_slug + '">' + row.post_title + '</a>';    
                    }
                    return '';
                },
                sort_field: 'post_title'
            },
            { header:'Tanggal Kirim', renderer:'created_at' },
            { 
                header:'Status', 
                renderer: function( row ) {
                    return DS.CommentStatus[ row.comment_status ];
                },
                sort_field: 'comment_status'
            },
    	],
        resize_column: 2,
        can_add: false
    });

    new FormBuilder( _form , {
	    controller:'blog/post_comments',
	    fields: [
	      { label:'Komentar', name:'comment_content', type:'textarea' },
          { label:'Status', name:'comment_status', type:'select', datasource:DS.CommentStatus },
	    ]
  	});
</script>