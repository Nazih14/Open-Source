<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.Semester = {
        'odd': 'Ganjil',
        'even': 'Genap'
    };

    var _grid = 'MAJORS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'reference/academic_years',
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
    		{ header:'Tahun Akademik', renderer:'academic_year' },
    		{ 
                header:'Semester', 
                renderer: function( row ) {
                    return row.semester == 'odd' ? 'Ganjil' : 'Genap';
                },
                sort_field: 'semester'
            },
            { 
                header:'Aktif ?', 
                renderer: function(row) {
                    return row.is_active == 'true' ? '<i class="fa fa-check-square-o"></i>' : '';
                },
                sort_field: 'is_active'
            }
    	]
    });

    new FormBuilder( _form , {
	    controller:'reference/academic_years',
	    fields: [
            { label:'Tahun Akademik', name:'academic_year', placeholder:'Separated by (-). Example: 2016-2017' },
            { label:'Semester', name:'semester', type:'select', datasource:DS.Semester },
            { label:'Aktif ?', name:'is_active', type:'select', datasource:DS.TrueFalse }
	    ]
  	});
</script>