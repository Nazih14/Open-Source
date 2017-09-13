<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
   // Change Input Type
   function change_type(elem_id) {
      var input_type = $('#' + elem_id).attr('type');
      var change_type = input_type === 'password' ? 'text' : 'password';
      $('#' + elem_id).attr('type', change_type);
   }

   // Save Changes
   function save_changes() {
      var values = {
         current_password: $('#current_password').val(),
         new_password: $('#new_password').val(),
         retype_new_password: $('#retype_new_password').val()
      };
      $.post(_BASE_URL + 'change_password/save', values, function(response) {
         var res = H.stringToJSON(response);
         H.growl(res.type, H.message(res.message));
      });
   }
</script>
<section class="content">
   <div class="panel panel-primary">
      <div class="panel-heading"><i class="fa fa-sign-out"></i> UBAH KATA SANDI</div>
      <div class="panel-body">
         <form class="form-horizontal">
            <div class="box-body">
               <div class="form-group">
                  <label for="current_password" class="col-sm-3 control-label">Kata Sandi Saat Ini</label>
                  <div class="col-sm-9">
                     <div class="input-group input-group-sm">
                        <input type="password" class="form-control" id="current_password">
                        <span class="input-group-btn">
                           <button type="submit" onclick="change_type('current_password'); return false;" class="btn btn-warning btn-flat"><i class="fa fa-eye"></i></button>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="new_password" class="col-sm-3 control-label">Kata Sandi Baru</label>
                  <div class="col-sm-9">
                     <div class="input-group input-group-sm">
                        <input type="password" class="form-control" id="new_password">
                        <span class="input-group-btn">
                           <button type="submit" onclick="change_type('new_password'); return false;" class="btn btn-warning btn-flat"><i class="fa fa-eye"></i></button>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label for="retype_new_password" class="col-sm-3 control-label">Ulangi Kata Sandi Baru</label>
                  <div class="col-sm-9">
                     <div class="input-group input-group-sm">
                        <input type="password" class="form-control" id="retype_new_password">
                        <span class="input-group-btn">
                           <button type="submit" onclick="change_type('retype_new_password'); return false;" class="btn btn-warning btn-flat"><i class="fa fa-eye"></i></button>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="btn-group col-sm-9 col-sm-offset-3">
                  <button type="submit" onclick="save_changes(); return false;" class="btn btn-primary submit"><i class="fa fa-save"></i> SIMPAN PERUBAHAN</button>
               </div>
            </div>
         </form>
      </div>
   </div>
 </section>