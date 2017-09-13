<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                       <?php echo menu_title($this->uri->segment(1),$this->uri->segment(2));?>
                        <?php //echo anchor($this->uri->segment(1).'/add', '<i class="fa fa-pencil-square-o"></i> Tambah Data', array('class' => 'btn btn-danger btn-sm')); ?>
                    </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="mytable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th width='100'>WAKTU</th>
                                <th>PENGIRIMN</th>
                                <th  width='100'>PESAN</th>
                                <th width="104"></th>
                            </tr>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<script src="<?php echo base_url('tutor/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('tutor/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('tutor/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        var t = $('#mytable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": '<?php echo site_url($this->uri->segment(1).'/inbox_data'); ?>',
            "columns": [
                {
                    "data": null,
                    'width': 20,
                    "class": "text-center",
                    "orderable": false
                },
                {"data": "ReceivingDateTime", width: 90},
                {"data": "SenderNumber",width: 60},
                {"data": "TextDecoded"},
                {
                    "class": "text-center",
                    "data": "aksi",
                    'width': 50
                }
            ],
            "order": [[3, 'desc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>
