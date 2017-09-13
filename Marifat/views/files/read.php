<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.FileCategory = <?=$file_category_dropdown;?>;
    var _grid = 'FILES', _form = _grid + '_FORM';
    new GridBuilder( _grid , {
        controller:'media/files',
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
                header: '<i class="fa fa-edit"></i>', 
                renderer:function(row) {
                    return A(_form + '.OnEdit(' + row.id + ')', 'Edit');
                },
                exclude_excel : true,
                sorting: false
            },
            { 
                header: '<i class="fa fa-file-o"></i>', 
                renderer:function(row) {
                    return UPLOAD(_form + '.OnUpload(' + row.id + ')', 'file', 'Upload File');
                },
                exclude_excel : true,
                sorting: false
            },
            { 
                header: '<i class="fa fa-download"></i>', 
                renderer:function(row) {
                    return row.file_name ? 
                        Ahref(_BASE_URL + 'media_library/files/' + row.file_name, 'Download', '<i class="fa fa-download"></i>') : '';
                },
                exclude_excel : true,
                sorting: false
            },
            { header:'Nama File', renderer:'file_title' },
            { header:'Kategori', renderer:'category' },
            { 
                header:'Ukuran', 
                renderer: function(row) {
                    return H.FormatBytes(row.file_size * 1024);
                },
                sort_field: 'file_size'
            },
            { 
                header:'Visibility', 
                renderer: function(row) {
                    return DS.Visibility[ row.file_visibility ] || '';
                },
                sort_field: 'file_visibility'
            },
            { 
                header:'Tipe', 
                renderer: function(row) {
                    return row.file_type || '';
                },
                sort_field: 'file_type'
            },
            { header:'Di Unduh (X)', renderer:'file_counter' },
    	],
        resize_column: 4
    });

    new FormBuilder( _form , {
	    controller:'media/files',
	    fields: [
	      { label:'File Name', name:'file_title', type:'textarea' },
          { label:'Category', name:'file_category_id', type:'select', datasource:DS.FileCategory },
          { label:'Visibility', name:'file_visibility', type:'select', datasource:DS.Visibility }
	    ]
  	});
</script>