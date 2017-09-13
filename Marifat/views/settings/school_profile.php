<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.SchoolLevel = <?=datasource('school_level')?>;
    DS.OwnershipStatus = <?=datasource('institutions_lifter')?>;
    var _grid = 'OPTIONS', 
        _form1 = _grid + '_FORM1', // npsn
        _form2 = _grid + '_FORM2', // School Name
        _form3 = _grid + '_FORM3', // school_level
        _form4 = _grid + '_FORM4', // school_status
        _form5 = _grid + '_FORM5', // ownership_status
        _form6 = _grid + '_FORM6', // decree_operating_permit
        _form7 = _grid + '_FORM7', // decree_operating_permit_date        
        _form8 = _grid + '_FORM8', // tagline
        _form9 = _grid + '_FORM9', // Logo
        _form10 = _grid + '_FORM10', // RT
        _form11 = _grid + '_FORM11', // RW
        _form12 = _grid + '_FORM12', // sub_village
        _form13 = _grid + '_FORM13', // village
        _form14 = _grid + '_FORM14', // sub_district
        _form15 = _grid + '_FORM15', // district
        _form16 = _grid + '_FORM16', // postal_code
        _form17 = _grid + '_FORM17', // street_address
        _form18 = _grid + '_FORM18', // latitude
        _form19 = _grid + '_FORM19', // longitude
        _form20 = _grid + '_FORM20', // phone
        _form21 = _grid + '_FORM21', // fax
        _form22 = _grid + '_FORM22', // email
        _form23 = _grid + '_FORM23', // website       
        _form24 = _grid + '_FORM24', // Nama Kepala Sekolah
        _form25 = _grid + '_FORM25'; // Photo Kepala Sekolah
	new GridBuilder( _grid , {
        controller:'settings/school_profile',
        fields: [
            {
                header: '<i class="fa fa-cog"></i>', 
                renderer:function(row) {
                    if (row.variable == 'npsn') {
                        return A(_form1 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'school_name') {
                        return A(_form2 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'school_level') {
                        return A(_form3 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'school_status') {
                        return A(_form4 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'ownership_status') {
                        return A(_form5 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'decree_operating_permit') {
                        return A(_form6 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'decree_operating_permit_date') {
                        return A(_form7 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'tagline') {
                        return A(_form8 + '.OnEdit(' + row.id + ')');
                    }                    
                    if (row.variable == 'logo') {
                        return UPLOAD(_form9 + '.OnUpload(' + row.id + ')', 'image', 'Upload Logo');
                    }
                    if (row.variable == 'rt') {
                        return A(_form10 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'rw') {
                        return A(_form11 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'sub_village') {
                        return A(_form12 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'village') {
                        return A(_form13 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'sub_district') {
                        return A(_form14 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'district') {
                        return A(_form15 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'postal_code') {
                        return A(_form16 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'street_address') {
                        return A(_form17 + '.OnEdit(' + row.id + ')');
                    } 
                    if (row.variable == 'latitude') {
                        return A(_form18 + '.OnEdit(' + row.id + ')');
                    } 
                    if (row.variable == 'longitude') {
                        return A(_form19 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'phone') {
                        return A(_form20 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'fax') {
                        return A(_form21 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'email') {
                        return A(_form22 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'website') {
                        return A(_form23 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'headmaster') {
                        return A(_form24 + '.OnEdit(' + row.id + ')');
                    }
                    if (row.variable == 'headmaster_photo') {
                        return UPLOAD(_form25 + '.OnUpload(' + row.id + ')', 'image', 'Upload Photo Kepala Sekolah');
                    }
                },
                exclude_excel : true,
                sorting: false
            },
            { 
                header: '<i class="fa fa-search-plus"></i>', 
                renderer:function(row) {
                    if (row.variable == 'logo' || row.variable == 'headmaster_photo') {
                        var image = "'" + row.value + "'";
                        return row.value ? 
                            '<a title="Preview" onclick="preview(' + image + ')"  href="#"><i class="fa fa-search-plus"></i></a>' : '';
                    }
                },
                sorting: false
            },
    		{ header:'Setting Name', renderer: 'description' },
            { 
                header:'Setting Value', 
                renderer: function(row){
                    if (row.variable == 'school_level') {
                        return row.value ? DS.SchoolLevel[ row.value ] : '';
                    }
                    if (row.variable == 'school_status') {
                        return row.value ? DS.SchoolStatus[ row.value ] : '';
                    }
                    if (row.variable == 'ownership_status') {
                        return row.value ? DS.OwnershipStatus[ row.value ] : '';
                    }
                    return row.value ? row.value : '';
                },
                sort_field:'value'
            }
    	],
        can_add: false,
        can_delete: false,
        can_restore: false,
        resize_column: 3,
        per_page: 50,
        per_page_options: [50, 100]
    });

    /**
     * NPSN
     */
    new FormBuilder( _form1 , {
        controller:'settings/school_profile',
        fields: [
            { label:'NPSN', name:'value', placeholder:'Nomor Pokok Sekolah Nasional' }
        ]
    });

    /**
     * School Name
     */
    new FormBuilder( _form2 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Nama Sekolah', name:'value' }
        ]
    });

    /**
     * School Level
     */
    new FormBuilder( _form3 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Bentuk Pendidikan', name:'value', type:'select', datasource:DS.SchoolLevel }
        ]
    });

    /**
     * School Status
     */
    new FormBuilder( _form4 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Status Sekolah', name:'value', type:'select', datasource:DS.SchoolStatus }
        ]
    });

    /**
     * meta_keywords
     */
    new FormBuilder( _form5 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Status Kepemilikan', name:'value', type:'select', datasource:DS.OwnershipStatus }
        ]
    });

    /**
     * Decree Operating Permit
     */
    new FormBuilder( _form6 , {
        controller:'settings/school_profile',
        fields: [
            { label:'SK Izin Operasional', name:'value' }
        ]
    });

    /**
     * Decree Operating Permit Date
     */
    new FormBuilder( _form7 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Tanggal SK Izin Operasional', name:'value', type:'date' }
        ]
    });

    /**
     * Tagline
     */
    new FormBuilder( _form8 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Slogan', name:'value', placeholder:'Slogan' }
        ]
    });

    /**
     * Logo
     */
    new FormBuilder( _form9 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Logo', name:'value' }
        ]
    });

    /**
     * RT
     */
    new FormBuilder( _form10 , {
        controller:'settings/school_profile',
        fields: [
            { label:'RT', name:'value', placeholder:'Rukun Tetangga' }
        ]
    });

    /**
     * RW
     */
    new FormBuilder( _form11 , {
        controller:'settings/school_profile',
        fields: [
            { label:'RW', name:'value', placeholder:'Rukun Warga' }
        ]
    });

    /**
     * sub_village
     */
    new FormBuilder( _form12 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Nama Dusun', name:'value' }
        ]
    });

    /**
     * village
     */
    new FormBuilder( _form13 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Kelurahan / Desa', name:'value' }
        ]
    });

    /**
     * sub_district
     */
    new FormBuilder( _form14 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Kecamatan', name:'value' }
        ]
    });

    /**
     * district
     */
    new FormBuilder( _form15 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Kabupaten', name:'value' }
        ]
    });

    /**
     * postal_code
     */
    new FormBuilder( _form16 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Kode Pos', name:'value' }
        ]
    });
    
    /**
     * street_address
     */
    new FormBuilder( _form17 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Alamat Jalan', name:'value' }
        ]
    });

    /**
     * latitude
     */
    new FormBuilder( _form18 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Latitude', name:'value' }
        ]
    });

    /**
     * longitude
     */
    new FormBuilder( _form19 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Longitude', name:'value' }
        ]
    });

    /**
     * phone
     */
    new FormBuilder( _form20 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Telepon', name:'value' }
        ]
    });

    /**
     * Fax
     */
    new FormBuilder( _form21 , {
        controller:'settings/school_profile',
        fields: [
            { label:'Fax', name:'value' }
        ]
    });

    /**
     * email
     */
    new FormBuilder( _form22, {
        controller:'settings/school_profile',
        fields: [
            { label:'Email', name:'value' }
        ]
    });

    /**
     * website
     */
    new FormBuilder( _form23, {
        controller:'settings/school_profile',
        fields: [
            { label:'Website', name:'value' }
        ]
    });

    /**
     * Kepala Sekolah
     */
    new FormBuilder( _form24, {
        controller:'settings/school_profile',
        fields: [
            { label:'Nama Kepala Sekolah', name:'value' }
        ]
    });

    /**
     * Photo Kepala Sekolah
     */
    new FormBuilder( _form25, {
        controller:'settings/school_profile',
        fields: [
            { label:'Photo Kepala Sekolah', name:'value' }
        ]
    });

    /**
     * Preview Image
     */
    function preview(image) {
        $.magnificPopup.open({
          items: {
            src: '<?=base_url()?>media_library/images/' + image
          },
          type: 'image'
        });
    }
</script>