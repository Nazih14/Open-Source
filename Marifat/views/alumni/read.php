<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'ALUMNI', _form = _grid + '_FORM';
    new GridBuilder( _grid , {
        controller:'students/alumni',
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
                    var image = "'" + row.photo + "'";
                    return row.photo ? 
                        '<a title="Preview" onclick="preview(' + image + ')"  href="#"><i class="fa fa-search-plus"></i></a>' : '';
                },
                exclude_excel : true,
                sorting: false
            },
            { header:'NIS', renderer:'nis' },
            { header:'Nama Lengkap', renderer:'full_name' },
            { 
                header:'L/P', 
                renderer: function( row ) {
                    return row.gender == 'M' ? 'L' : 'P';
                },
                sort_field: 'gender'
            },
            { header:'Tanggal Masuk', renderer:'start_date' },
            { header:'Tanggal Keluar', renderer:'end_date' },
            { header:'Alamat Jalan', renderer:'street_address' }            
        ],
        resize_column: 5,
        to_excel: true,
        can_add: false
    });

    new FormBuilder( _form , {
        controller:'students/alumni',
        fields: [
            { label:'Alumni ?', name:'is_alumni', type:'select', datasource:DS.TrueFalse },
            { label:'Tahun Keluar', name:'end_date', placeholder:'Tanggal Keluar', type:'date' },
            { label:'Alasan Keluar', name:'reason', placeholder:'Alasan', type:'textarea' },
            { label:'Nama Lengkap', name:'full_name', placeholder:'Nama Lengkap' },
            { label:'Alamat Jalan', name:'street_address', placeholder:'Alamat Jalan' },
            { label:'RT', name:'rt', placeholder:'Rukun Tetangga' },
            { label:'RW', name:'rw', placeholder:'Rukun warga' },
            { label:'Nama Dusun', name:'sub_village', placeholder:'Nama Dusun' },
            { label:'Nama Kelurahan / Desa', name:'village', placeholder:'Nama Desa' },
            { label:'Nama Kecamatan', name:'sub_district', placeholder:'Kecamatan' },
            { label:'Nama Kabupaten', name:'district', placeholder:'Kabupaten' },
            { label:'Kode Pos', name:'postal_code', placeholder:'Kode POS' },
            { label:'No. Telepon', name:'phone', placeholder:'Nomor Telepon' },
            { label:'No. Handphone', name:'mobile_phone', placeholder:'Nomor Hand Phone' },
            { label:'Email', name:'email', placeholder:'Alamat Email' }
        ]
    });

    function preview(image) {
        $.magnificPopup.open({
          items: {
            src: '<?=base_url()?>media_library/students/' + image
          },
          type: 'image'
        });
    }
</script>