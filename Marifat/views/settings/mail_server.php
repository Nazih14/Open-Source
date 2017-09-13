<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    var _grid = 'OPTIONS', 
        _form1 = _grid + '_FORM1', // mail_server_hostname
        _form2 = _grid + '_FORM2', // mail_server_password
        _form3 = _grid + '_FORM3', // mail_server_port
        _form4 = _grid + '_FORM4', // mail_server_protocol
        _form5 = _grid + '_FORM5'; // mail_server_username
	new GridBuilder( _grid , {
        controller:'settings/mail_server',
        fields: [
            {
                header: '<i class="fa fa-cog"></i>', 
                renderer:function(row) {
                    if (row.variable == 'mail_server_hostname') {
                        return A(_form1 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'mail_server_password') {
                        return A(_form2 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'mail_server_port') {
                        return A(_form3 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'mail_server_protocol') {
                        return A(_form4 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'mail_server_username') {
                        return A(_form5 + '.OnEdit(' + row.id + ')');
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
     * mail_server_hostname
     */
    new FormBuilder( _form1 , {
        controller:'settings/mail_server',
        fields: [
            { label:'Mail Server Host Name', name:'value' }
        ]
    });

    /**
     * mail_server_password
     */
    new FormBuilder( _form2 , {
        controller:'settings/mail_server',
        fields: [
            { label:'Mail Server Password', name:'value' }
        ]
    });

    /**
     * mail_server_port
     */
    new FormBuilder( _form3 , {
        controller:'settings/mail_server',
        fields: [
            { label:'Mail Server Port', name:'value', type:'number' }
        ]
    });

    /**
     * mail_server_protocol
     */
    new FormBuilder( _form4 , {
        controller:'settings/mail_server',
        fields: [
            { label:'Mail Server Protocol', name:'value', type:'select', datasource: {smpt:'SMPT'} }
        ]
    });

    /**
     * mail_server_username
     */
    new FormBuilder( _form5 , {
        controller:'settings/mail_server',
        fields: [
            { label:'Mail Server Username', name:'value' }
        ]
    });
</script>