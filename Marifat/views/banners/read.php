<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'BANNERS', _form = _grid + '_FORM';
    DS.LinkTarget = {
        '_blank':'Blank',
        '_self':'Self',
        '_parent':'Parent',
        '_top':'Top'
    };
    new GridBuilder( _grid , {
        controller:'plugins/banners',
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
                header: '<i class="fa fa-file-image-o"></i>', 
                renderer:function(row) {
                    return UPLOAD(_form + '.OnUpload(' + row.id + ')', 'image', 'Upload Banner');
                },
                exclude_excel : true,
                sorting: false
            },
            { 
                header: '<i class="fa fa-search-plus"></i>', 
                renderer:function(row) {
                    var image = "'" + row.image + "'";
                    return row.image ? 
                        '<a title="Preview" onclick="preview(' + image + ')"  href="#"><i class="fa fa-search-plus"></i></a>' : '';
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
        ],
        resize_column: 5
    });

    new FormBuilder( _form , {
        controller:'plugins/banners',
        fields: [
            { label:'URL', name:'url', placeholder:'Add prefix http://' },
            { label:'Keterangan', name:'title' },
            { label:'Target', name:'target', type:'select', datasource:DS.LinkTarget },
        ]
    });

    function preview(image) {
        $.magnificPopup.open({
          items: {
            src: _BASE_URL + 'media_library/banners/' + image
          },
          type: 'image'
        });
    }
</script>