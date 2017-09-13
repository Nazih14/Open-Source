<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.ScholarshipTypes = {
        '1': 'Anak Berprestasi',
        '2': 'Anak Miskin',
        '3': 'Pendidikan',
        '4': 'Unggulan',
        '5': 'Lain-lain'
    };

    var _grid = 'SCHOLARSHIPS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'scholarships',
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
            { header:'Nama Beasiswa', renderer:'description' },
            {
                header:'Jenis Beasiswa', 
                renderer: function( row ) {
                    return DS.ScholarshipTypes[row.type];
                },
                sort_field: 'type'
            },
    		{ header:'Tahun Mulai', renderer:'start_year' },
            { header:'Tahun Selesai', renderer:'end_year' }
    	]
    });

    new FormBuilder( _form , {
	    controller:'scholarships',
	    fields: [
            { label:'Jenis Beasiswa', name:'type', type:'select', datasource:DS.ScholarshipTypes },
            { label:'Nama Beasiswa', name:'description', type:'textarea' },
            { label:'Tahun Mulai', name:'start_year' },
            { label:'Tahun Selesai', name:'end_year' }
	    ]
  	});
</script>