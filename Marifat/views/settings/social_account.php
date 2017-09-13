<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'OPTIONS', 
        _form1 = _grid + '_FORM1', // facebook
        _form2 = _grid + '_FORM2', // google_plus
        _form3 = _grid + '_FORM3', // linked_in
        _form4 = _grid + '_FORM4', // instagram
        _form5 = _grid + '_FORM5', // twitter
        _form6 = _grid + '_FORM6'; // youtube
	new GridBuilder( _grid , {
        controller:'settings/social_account',
        fields: [
            {
                header: '<i class="fa fa-cog"></i>', 
                renderer:function(row) {
                    if (row.variable == 'facebook') {
                        return A(_form1 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'google_plus') {
                        return A(_form2 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'linked_in') {
                        return A(_form3 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'instagram') {
                        return A(_form4 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'twitter') {
                        return A(_form5 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'youtube') {
                        return A(_form6 + '.OnEdit(' + row.id + ')');
                    }
                },
                exclude_excel : true,
                sorting: false
            },
    		{ header:'Setting Name', renderer: 'description' },
            { header:'Setting Value', renderer: 'value' },
    	],
        can_add: false,
        can_delete: false,
        can_restore: false,
        resize_column: 2,
        per_page: 50,
        per_page_options: [50, 100]
    });

    /**
     * facebook
     */
    new FormBuilder( _form1 , {
        controller:'settings/social_account',
        fields: [
            { label:'Facebook', name:'value' }
        ]
    });

    /**
     * google_plus
     */
    new FormBuilder( _form2 , {
        controller:'settings/social_account',
        fields: [
            { label:'Google Plus', name:'value' }
        ]
    });

    /**
     * linked_in
     */
    new FormBuilder( _form3 , {
        controller:'settings/social_account',
        fields: [
            { label:'Linked In', name:'value' }
        ]
    });

    /**
     * instagram
     */
    new FormBuilder( _form4 , {
        controller:'settings/social_account',
        fields: [
            { label:'Instagram', name:'value' }
        ]
    });

    /**
     * twitter
     */
    new FormBuilder( _form5 , {
        controller:'settings/social_account',
        fields: [
            { label:'Twitter', name:'value' }
        ]
    });

    /**
     * youtube
     */
    new FormBuilder( _form6 , {
        controller:'settings/social_account',
        fields: [
            { label:'Youtube', name:'value' }
        ]
    });
</script>