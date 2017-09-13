<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="content-header">
   <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-6">
         <h3 style="margin:0;"><i class="fa fa-sign-out text-green"></i> <span class="table-header"><?=isset($title) ? ucwords(strtolower($title)) : ''?></span> <?=isset($sub_title) ? '<br><small style="margin-left:29px;">'.$sub_title.'</small>' : ''?></h3>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6">
         <div class="box-tools btn-group pull-right grid-button"></div>
      </div>
   </div>
</section>
 <section class="content">
   <div class="box">
      <div class="box-header" style="margin-bottom: 20px; margin-top: 5px;">
         <div class="box-tools">
            <div class="form-group has-info has-feedback" style="min-width: 330px;">
               <input type="text" class="form-control keyword input-sm" placeholder="Press enter to search, press escape to clear">
               <i class="fa fa-search form-control-feedback" aria-hidden="true"></i>
            </div>
         </div>
      </div>
      <div class="box-body">
         <div class="table-responsive">
            <table class="table table-hover table-striped table-condensed">
               <thead class="thead"></thead>
               <tbody class="tbody"></tbody>
            </table>
         </div>
      </div>
      <div class="box-footer">
         <div class="row">
            <div class="col-md-9">
               <em class="page-info"></em> <em class="search-info"></em>
            </div>
            <div class="col-md-3">
               <div class="btn-group pull-right">
                  <button type="button" class="btn bg-navy btn-sm first" title="First"><i class="fa fa-angle-double-left"></i></button>
                  <button type="button" class="btn bg-navy btn-sm previous" title="Prev"><i class="fa fa-angle-left"></i></button>
                  <button type="button" class="btn bg-navy btn-sm next" title="Next"><i class="fa fa-angle-right"></i></button>
                  <button type="button" class="btn bg-navy btn-sm last" title="Last"><i class="fa fa-angle-double-right"></i></button>
                  <div class="btn-group">
                     <select class="btn bg-navy input-sm per-page" style="padding: 5px 5px"></select>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
 </section>
 <div class="modal modal-form">
   <div class="modal-dialog modal-lg">
      <form class="form-horizontal form-dialog" role="form" method="post">
         <div class="modal-content">
            <div class="modal-header">
               <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title"><i class="fa fa-edit"></i> <?=$title;?></h4>
            </div>
            <div class="modal-body">                    
               <div class="box-body form-fields"></div>
               <div class="form-group" style="margin-top: 10px;padding: 10px 0;">
                  <div class="btn-group col-md-8 col-md-offset-4" id="container_upload">
                     <button class="btn btn-primary btn-sm submit"></button>
                     <button type="reset" class="btn btn-info btn-sm reset"><i class="fa fa-refresh"></i> RESET</button>
                     <button class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-mail-forward"></i> CANCEL</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
<div class="modal modal-preview">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-edit"></i> <?=$title;?></h4>
         </div>
         <div class="modal-body"></div>
      </div>
   </div>
</div>