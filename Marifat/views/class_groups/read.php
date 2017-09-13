<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.Majors = <?=$majors_dropdown;?>;
    var school_level = '<?=get_school_level()?>';
    var _grid = 'CLASS_GROUPS', _form = _grid + '_FORM';
	new GridBuilder( _grid , {
        controller:'students/class_groups',
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
    		{ header:'Kelas', renderer:'class_group' }
    	]
    });

    var fields = [
        { label:'Kelas', name:'class' },
        { label:'Sub Kelas', name:'sub_class' }
    ];
    if (parseInt(school_level) == 3 || parseInt(school_level) == 4 || parseInt(school_level) == 5) {
        fields.push(
            { label:'Program Keahlian', name:'major_id', type:'select', datasource:DS.Majors }
        );
    }
    new FormBuilder( _form , {
	    controller:'students/class_groups',
	    fields: fields
  	});
</script>