<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.AchievementTypes = {
        '1': 'Sains',
        '2': 'Seni',
        '3': 'Olahraga',
        '4': 'Lain-lain'
    };

    DS.AchievementLevels = {
        '1': 'Sekolah',
        '2': 'Kecamatan',
        '3': 'Kabupaten',
        '4': 'Propinsi',
        '5': 'Nasional',
        '6': 'Internasional'
    };

    var _grid = 'ACHIEVEMENTS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'achievements',
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
            { header:'Nama Prestasi', renderer:'description' },
            {
                header:'Jenis', 
                renderer: function( row ) {
                    return DS.AchievementTypes[row.type];
                },
                sort_field: 'type'
            },
            {
                header:'Tingkat',
                renderer: function( row ) {
                    return DS.AchievementLevels[row.level];
                },
                sort_field: 'level'
            },
    		{ header:'Tahun', renderer:'year' },
            { header:'Penyelenggara', renderer:'organizer' }
    	]
    });

    new FormBuilder( _form , {
	    controller:'achievements',
	    fields: [
            { label:'Jenis', name:'type', type:'select', datasource:DS.AchievementTypes },
            { label:'Tingkat', name:'level', type:'select', datasource:DS.AchievementLevels },
            { label:'Tahun', name:'year' },
            { label:'Penyelenggara', name:'organizer' },
            { label:'Nama Prestasi', name:'description', type:'textarea' }
	    ]
  	});
</script>