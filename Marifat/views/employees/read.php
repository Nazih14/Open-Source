<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
    DS.Employment = <?=datasource('employment')?>;
    DS.EmploymentStatus = <?=datasource('employment_status')?>;
    DS.EmploymentType = <?=datasource('employment_type')?>;
    DS.InstitutionsLifter = <?=datasource('institutions_lifter')?>;
    DS.Rank = <?=datasource('rank')?>;
    DS.SalarySource = <?=datasource('salary_source')?>;
    DS.SkillsLaboratory = <?=datasource('skills_laboratory')?>;
    DS.SpecialNeeds = <?=datasource('special_needs')?>;
    DS.Religion = <?=datasource('religion')?>;
    DS.MaritalStatus = <?=datasource('marital_status')?>;
    var _grid = 'EMPLOYEES', _form = _grid + '_FORM';
    new GridBuilder( _grid , {
        controller:'employees/employees',
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
                    return UPLOAD(_form + '.OnUpload(' + row.id + ')', 'image', 'Upload Photo');
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
            { 
                 header: '<i class="fa fa-lock"></i>', 
                 renderer:function(row) {
                      return A('create_account(' + row.nik + ', ' + row.id +')', 'Aktivasi Akun', '<i class="fa fa-lock"></i>');
                },
                exclude_excel : true,
                sorting: false
            },
            { header:'NIK', renderer:'nik' },
            { header:'Nama Lengkap', renderer:'full_name' },
            { 
                header:'Jenis GTK', 
                renderer: function( row ) {
                    return row.employment_type ? row.employment_type : '';
                },
                sort_field: 'employment_type'
            },
            { header:'Tempat Lahir', renderer:'birth_place' },
            { 
                header:'Tanggal Lahir', 
                renderer: function(row) {
                    return row.birth_date && row.birth_date !== '0000-00-00' ? H.indo_date(row.birth_date) : '';
                },
                sort_field: 'birth_date'
            },
            { 
                header:'L/P', 
                renderer: function( row ) {
                    return row.gender == 'M' ? 'L' : 'P';
                },
                sort_field: 'gender'
            }
        ],
        resize_column: 5,
        to_excel: true
    });

    new FormBuilder( _form , {
        controller:'employees/employees',
        fields: [
            { label:'Nomor Surat Tugas', name:'assignment_letter_number' },
            { label:'Tanggal Surat Tugas', name:'assignment_letter_date', type:'date' },
            { label:'TMT Tugas', name:'assignment_start_date', type:'date' },
            { label:'Status Sekolah Induk', name:'parent_School_status', type:'select', datasource:DS.TrueFalse },
            { label:'Nama Lengkap', name:'full_name', },
            { label:'Jenis Kelamin', name:'gender', type:'select', datasource:DS.Gender },
            { label:'NIK', name:'nik' },
            { label:'Tempat Lahir', name:'birth_place' },
            { label:'Tanggal Lahir', name:'birth_date', type:'date' },
            { label:'Nama Ibu Kandung', name:'mother_name' },
            { label:'Alamat Jalan', name:'street_address' },
            { label:'RT', name:'rt' },
            { label:'RW', name:'rw' },
            { label:'Nama Dusun', name:'sub_village' },
            { label:'Nama Kelurahan / Desa', name:'village' },
            { label:'Nama Kecamatan', name:'sub_district' },
            { label:'Nama Kabupaten', name:'district' },
            { label:'Kode Pos', name:'postal_code' },
            { label:'Agama', name:'religion', type:'select', datasource:DS.Religion },
            { label:'Status Perkawinan', name:'marital_status', type:'select', datasource:DS.MaritalStatus },
            { label:'Nama Suami / Istri', name:'spouse_name' },
            { label:'Pekerjaan Suami/Istri', name:'spouse_employment', type:'select', datasource:DS.Employment },
            { label:'Kewarganegaraan', name:'citizenship', type:'select', datasource:DS.Citizenship },
            { label:'Nama Negara', name:'country' },
            { label:'NPWP', name:'npwp' },
            { label:'Status Kepegawaian', name:'employment_status', type:'select', datasource:DS.EmploymentStatus },
            { label:'NIP', name:'nip' },
            { label:'NIY/NIGK', name:'niy' },
            { label:'NUPTK', name:'nuptk' },
            { label:'Jenis GTK', name:'employment_type', type:'select', datasource:DS.EmploymentType },
            { label:'SK Pengangkatan', name:'decree_appointment' },
            { label:'TMT Pengangkatan', name:'appointment_start_date', type:'date' },
            { label:'Lembaga Pengangkat', name:'institutions_lifter', type:'select', datasource:DS.InstitutionsLifter },
            { label:'SK CPNS', name:'decree_cpns' },
            { label:'TMT PNS', name:'pns_start_date', type:'date' },
            { label:'Pangkat / Golongan', name:'rank', type:'select', datasource:DS.Rank },
            { label:'Sumber Gaji', name:'salary_source', type:'select', datasource:DS.SalarySource },
            { label:'Punya Lisensi Kepala Sekolah', name:'headmaster_license', type:'select', datasource:DS.TrueFalse },
            { label:'Keahlian Laboratorium', name:'skills_laboratory', type:'select', datasource:DS.SkillsLaboratory },
            { label:'Mampu Menangani Kebutuhan Khusus', name:'handle_special_needs', type:'select', datasource:DS.SpecialNeeds },
            { label:'Keahlian Braile', name:'braille_skills', type:'select', datasource:DS.TrueFalse },
            { label:'Keahlian Bahasa Isyarat', name:'sign_language_skills', type:'select', datasource:DS.TrueFalse },
            { label:'No. Telepon', name:'phone' },
            { label:'No. Handphone', name:'mobile_phone' },
            { label:'Email', name:'email' }
        ]
    });

    function create_account( nik, id ) {
        eModal.confirm('Apakah anda yakin akan mengaktifkan akun dengan NIK ' + nik + ' ?', 'Konfirmasi').then(function() {
            $.post(_BASE_URL + 'employees/employees/create_employee_account', {'id':id}, function(response) {
                var res = H.stringToJSON(response);
                H.growl(res.type, H.message(res.message));
            });
        });
    }

    function preview( image ) {
        $.magnificPopup.open({
          items: {
            src: '<?=base_url()?>media_library/employees/' + image
          },
          type: 'image'
        });
    }
</script>