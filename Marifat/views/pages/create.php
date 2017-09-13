<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript" src="<?=base_url('assets/plugins/tinymce/tinymce.min.js');?>"></script>
<script type="text/javascript">
   /** @namespace tinymce */
   tinymce.init({
      selector: "#post_content",
      theme: 'modern',
      paste_data_images:true,
      relative_urls: false,
      remove_script_host: false,
      toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
      toolbar2: "print preview forecolor backcolor emoticons",
      image_advtab: true,
      plugins: [
         "advlist autolink lists link image charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars code fullscreen",
         "insertdatetime nonbreaking save table contextmenu directionality",
         "emoticons template paste textcolor colorpicker textpattern"
      ],
      automatic_uploads: true,
      images_upload_url: _BASE_URL + 'blog/posts/tinymce_upload_handler',
      file_picker_types: 'image', 
      file_picker_callback: function(cb, value, meta) {
         var input = document.createElement('input');
         input.setAttribute('type', 'file');
         input.setAttribute('accept', 'image/*');
         input.onchange = function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
               var id = 'page-image-' + (new Date()).getTime();
               var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
               var blobInfo = blobCache.create(id, file, reader.result);
               blobCache.add(blobInfo);
               cb(blobInfo.blobUri(), { title: file.name });
            };
         };
         input.click();
      }
   });

   /** @namespace posts */
   $( document ).ready( function() {
      $( '#submit' ).on('click', function(event) {
         event.preventDefault();
         var field_data = {
            post_title: $('#post_title').val(),
            post_content: tinyMCE.get('post_content').getContent(),
            post_status: $('#post_status').val(),
            post_visibility: $('#post_visibility').val(),
            post_comment_status: $('#post_comment_status').val()
         };
         // send data
         $.post('<?=$action;?>', field_data, function(response) {
            var res = H.stringToJSON(response);
            H.growl(res.type, H.message(res.message));
            if (res.action == 'save') {
               $('input[type="text"]').val('');
               $('#post_status').val('publish');
               $('#post_visibility').val('public');
               $('#post_comment_status').val('open');
               tinyMCE.get('post_content').setContent('');
               $('#post_title').focus();
            }
         }).fail( function( xhr, textStatus, errorThrown ) {
            xhr.textStatus = textStatus;
            xhr.errorThrown = errorThrown;
            if( !errorThrown ) errorThrown = 'Unable to load resource, network connection or server is down?';
            H.growl('error', textStatus + ' ' + errorThrown + '<br/>' + xhr.responseText );
         });    
      });  
   });
</script>
<section class="content-header">
   <h1><i class="fa fa-edit"></i> <?=$title;?></h1>
 </section>
<section class="content">
   <form>
   <div class="row">
      <div class="col-lg-8">
         <div class="panel panel-default">
            <div class="panel-body">
               <div class="form-group" style="margin-bottom: 10px;">
                  <input id="post_title" name="post_title" value="<?=($query ? $query->post_title : '');?>" autofocus required="true" type="text" class="form-control input-lg" placeholder="Enter title here..." style="font-size: 16px">
               </div>
               <div class="form-group">
                  <textarea rows="25" id="post_content" name="post_content" class="form-control ckeditor"><?=($query ? $query->post_content : '');?></textarea>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="box box-default">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-edit"></i> Publikasi</h3>
            </div>
            <div class="box-body">
               <div class="form-group">
                  <div class="row">
                     <div class="col-lg-6">
                        <label class="control-label" for="post_status">Status</label>
                        <?=form_dropdown('post_status', ['publish' => 'Diterbitkan', 'draft' => 'Konsep'], ($query ? $query->post_status : ''), 'class="form-control input-sm" id="post_status"');?>
                     </div>
                     <div class="col-lg-6">
                        <label class="control-label" for="post_visibility">Akses</label>
                        <?=form_dropdown('post_visibility', ['public' => 'Publik', 'private' => 'Private'], ($query ? $query->post_visibility : ''), 'class="form-control input-sm" id="post_visibility"');?>        
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label" for="post_comment_status">Komentar</label>
                  <?=form_dropdown('post_comment_status', ['open' => 'Diizinkan', 'close' => 'Tidak Diizinkan'], ($query ? $query->post_comment_status : ''), 'class="form-control input-sm" id="post_comment_status"');?>
               </div>
            </div>
            <div class="box-footer">
               <div class="btn-group pull-right">
                  <button type="reset" class="btn btn-info btn-sm"><i class="fa fa-retweet"></i> ATUR ULANG</button>
                  <button type="submit" id="submit" class="btn btn-primary btn-sm"><i class="fa fa-send-o"></i> SIMPAN</button> 
               </div>
            </div>
         </div>
      </div>
   </div>
   </form>
</section>