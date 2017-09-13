<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="modal modal-form">
   <div class="modal-dialog modal-lg">
      <form class="form-horizontal form-dialog" role="form">
         <div class="modal-content">
            <div class="modal-header">
               <button class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title"><i class="fa fa-edit"></i> EDIT MENU</h4>
            </div>
            <div class="modal-body">                    
               <div class="box-body">
               	<div class="form-group">
               		<label class="col-sm-4 control-label" for="menu_title">Title</label>
               		<div class="col-sm-8">
               			<input type="text" class="form-control input-sm" id="menu_title" name="menu_title">
            			</div>
         			</div>
         			<div class="form-group">
         				<label class="col-sm-4 control-label" for="menu_url">URL</label>
      					<div class="col-sm-8">
      						<input type="text" class="form-control input-sm" id="menu_url" name="menu_url">
   						</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="target">Target</label>
							<div class="col-sm-8">
								<select id="menu_target" class="form-control">
									<option value="_selft">Selft</option>
									<option value="_blank">Blank</option>
									<option value="_top">Top</option>
									<option value="_parent">Parent</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" for="target">Aktif ?</label>
							<div class="col-sm-8">
								<select id="is_deleted" class="form-control">
									<option value="false">Ya</option>
									<option value="true">Tidak</option>
								</select>
							</div>
						</div>
						<input type="hidden" name="record_id" id="record_id">
					</div>
               <div class="form-group" style="margin-top: 10px;padding: 10px 0;">
                  <div class="btn-group col-md-8 col-md-offset-4">
                     <button type="button" class="btn btn-primary btn-sm" onclick="SubmitForm(); return false;"><i class="fa fa-save"></i> UPDATE</button>
                     <button class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-mail-forward"></i> CANCEL</button>
                     <img style="display: none;" class="pull-right" id="form-loading" src="<?=base_url('assets/img/facebook.gif')?>">
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/jquery-nestable/jquery.nestable.css');?>"/>
<script src="<?=base_url('assets/plugins/jquery-nestable/jquery.nestable.js');?>"></script>
<script type="text/javascript">

	/**
	 * Edit Menu
	 */
	function OnEdit( id ) {
		$('.modal-form').modal('show');
		$('#record_id').val(id);
		$.post(_BASE_URL + 'appearance/menus/find_id', {'id':id}, function( response ) {
			var res = H.stringToJSON(response);
			console.log(res);
			$('#menu_title').val(res.menu_title);
			$('#menu_url').val(res.menu_url);
			$('#menu_target option[value="' + res.menu_target + '"]').attr('selected','selected');
			$('#is_deleted option[value="' + res.is_deleted + '"]').attr('selected','selected');
		});
	}

	/**
	 * Update Menu
	 */
	function SubmitForm() {
		var values = {
			'menu_title': $('#menu_title').val(),
			'menu_url': $('#menu_url').val(),
			'menu_target': $('#menu_target').val(),
			'is_deleted': $('#is_deleted').val(),
			'id': $('#record_id').val()
		}
		$.post(_BASE_URL + 'appearance/menus/save', values, function( response ) {
			var res = H.stringToJSON(response);
			if (res.type == 'success') {
				toastr.success(H.message(res.message));
				$('.modal-form').modal('hide');
				get_menus();
			} else {
				toastr.error(H.message(res.message));	
			}
		});
	}

	/**
	 * Save Custom Links
	 */
	function save_links() {
		var values = {
			menu_url: $('#c_menu_url').val(),
			menu_title: $('#c_menu_title').val(),
			menu_target: $('#c_menu_target').val()
		}
		$.post(_BASE_URL + 'appearance/menus/save_links', values, function(response) {
			var res = H.stringToJSON(response);
			H.growl(res.type, H.message(res.message));
			$('#c_menu_url, #c_menu_title').val('');
			nested_list();
		});
	}

	/**
	 * Save Menu From Pages
	 */
	function save_pages() {
		var el = $('#list-pages').find('input[type="checkbox"]:checked');
		var ids = [];
		el.each(function() {
			var value = $(this).val();
			ids.push(value);
		});
		var values = {
			'ids': ids.join(',')
		};

		if (ids.length) {
			$.post(_BASE_URL + 'appearance/menus/save_pages', values, function(response) {
				var res = H.stringToJSON(response);
				H.growl(res.type, H.message(res.message));
				nested_list();
				get_menus();
			});
		} else {
			H.growl('warning', 'Tidak ada item yang dipilih.');
		}
	}

	/**
	 * Save Menu From Posts Categories
	 */
	function save_post_categories() {
		var el = $('#list-post-categories').find('input[type="checkbox"]:checked');
		var ids = [];
		el.each(function() {
			var value = $(this).val();
			ids.push(value);
		});
		var values = {
			'ids': ids.join(',')
		};

		if (ids.length) {
			$.post(_BASE_URL + 'appearance/menus/save_post_categories', values, function(response) {
				var res = H.stringToJSON(response);
				H.growl(res.type, H.message(res.message));
				nested_list();
				get_menus();
			});
		} else {
			H.growl('warning', 'Tidak ada item yang dipilih.');
		}
	}

	/**
	 * Save Menu From File Categories
	 */
	function save_file_categories() {
		var el = $('#list-file-categories').find('input[type="checkbox"]:checked');
		var ids = [];
		el.each(function() {
			var value = $(this).val();
			ids.push(value);
		});
		var values = {
			'ids': ids.join(',')
		};

		if (ids.length) {
			$.post(_BASE_URL + 'appearance/menus/save_file_categories', values, function(response) {
				var res = H.stringToJSON(response);
				H.growl(res.type, H.message(res.message));
				nested_list();
				get_menus();
			});
		} else {
			H.growl('warning', 'Tidak ada item yang dipilih.');
		}
	}

	/**
	 * Save List Modules
	 */
	function save_modules() {
		var el = $('#modules').find('input[type="checkbox"]:checked');
		var modules = [];
		el.each(function() {
			var value = $(this).val();
			modules.push(value);
		});
		var values = {
			'modules': modules.join(',')
		};

		if (modules.length) {
			$.post(_BASE_URL + 'appearance/menus/save_modules', values, function(response) {
				var res = H.stringToJSON(response);
				H.growl(res.type, H.message(res.message));
				nested_list();
				get_menus();
			});
		} else {
			H.growl('warning', 'Tidak ada item yang dipilih.');
		}
	}

	/**
	 * Get Pages
	 */
	function get_pages() {
		$('.overlay-pages').show();
		$.get(_BASE_URL + 'appearance/menus/get_pages', function(response) {
			var res = H.stringToJSON(response);
			var str = '';
			for(var z in res) {
				str += '<div class="checkbox">'
					+ '<label>'
					+ '<input type="checkbox" class="list-pages" value="' + res[ z ].id +'">' + res[ z ].post_title
					+ '</label>'
					+ '</div>';
			}
			$('#list-pages').html(str);
			$('.overlay-pages').hide();
		});
	}

	/**
	 * Get Post Categories
	 */
	function get_post_categories() {
		$('.overlay-post-categories').show();
		$.get(_BASE_URL + 'appearance/menus/get_post_categories', function(response) {
			var res = H.stringToJSON(response);
			var str = '';
			for(var z in res) {
				str += '<div class="checkbox">'
					+ '<label>'
					+ '<input type="checkbox" class="list-post-categories" value="' + res[ z ].id +'">' + res[ z ].category
					+ '</label>'
					+ '</div>';
			}
			$('#list-post-categories').html(str);
			$('.overlay-post-categories').hide();
		});
	}

	/**
	 * Get File Categories
	 */
	function get_file_categories() {
		$('.overlay-file-categories').show();
		$.get(_BASE_URL + 'appearance/menus/get_file_categories', function(response) {
			var res = H.stringToJSON(response);
			var str = '';
			for(var z in res) {
				str += '<div class="checkbox">'
					+ '<label>'
					+ '<input type="checkbox" class="list-file-categories" value="' + res[ z ].id +'">' + res[ z ].category
					+ '</label>'
					+ '</div>';
			}
			$('#list-file-categories').html(str);
			$('.overlay-file-categories').hide();
		});
	}

	/**
	 * Get All Menus
	 */
	function get_menus() {
		$.get(_BASE_URL + 'appearance/menus/get_menus', function(response) {
			var res = H.stringToJSON(response);
			var str = '<table class="table table-hover table-striped table-condensed">'
				+ '<thead>'
				+ '<tr>'
				+ '<th width="10px">No.</th>'
				+ '<th>Menu</th>'
				+ '<th>URL</th>'
				+ '<th>Type</th>'
				+ '<th>Aktif</th>'
				+ '<th width="10px"></th>'
				+ '<th width="10px"></th>'
				+ '</tr>'
				+ '</thead>'
				+ '<tbody>';
			var i = 1;	
			for (var z in res) {
				str += '<tr>'
				+ '<td>' + i + '.</td>'
				+ '<td>' + res[ z ].menu_title + '</td>'
				+ '<td>' + res[ z ].menu_url + '</td>'
				+ '<td>' + res[ z ].menu_type.replace('_', ' ').ucwords() + '</td>'
				+ '<td>' + (res[ z ].is_deleted == 'true' ? '<i class="fa fa-warning text-green"></i>':'<i class="fa fa-check text-green"></i>') + '</td>'
				+ '<td><a class="text-info" href="javascript:void(0)" onclick="OnEdit(' + res[ z ].id + ')"><i class="fa fa-edit"></i></a></td>'
				+ '<td><a class="text-danger" href="javascript:void(0)" onclick="trash(' + res[ z ].id + ')"><i class="fa fa-trash"></i></a></td>'
				+ '</tr>';
				i++;
			}
			str += '</tbody>'
				+ '</table>';
			$('#list-menus').html(str);
		});
	}

	/**
	 * Delete Menus
	 */
	function trash(id) {
		eModal.confirm('Apakah anda yakin akan menghapus menu ?', 'Konfirmasi').then(function() {
			$.get(_BASE_URL + 'appearance/menus/delete/' + id, function(response) {
				var res = H.stringToJSON(response);
				H.growl(res.type, H.message(res.message));
				get_menus();
				nested_list();
			});
		});
	}

	/**
	 * Delete All Menus
	 */
	function trash_all() {
		eModal.confirm('Apakah anda yakin akan menghapus semua menu ?', 'Konfirmasi').then(function() {
			$.get(_BASE_URL + 'appearance/menus/delete_all', function(response) {
				var res = H.stringToJSON(response);
				console.log(res);
				H.growl(res.type, H.message(res.message));
				get_menus();
				nested_list();
			});
		});
	}

	/**
	 * generate Menus
	 */
	function nested_list() {
		$.get(_BASE_URL + 'appearance/menus/nested_list', function(response) {
			var result = H.stringToJSON(response);
			var menus = '';
			for (var z in result) {
				menus += '<li class="dd-item" data-id="' + result[ z ].id + '">';
				menus += '<div class="dd-handle">'+ result[ z ].menu_title.toUpperCase() +'</div>';
				var sub_menus = H.nested_list(result[ z ].child);
				if (sub_menus) {
					menus += '<ol class="dd-list">';
					menus += H.nested_list(result[ z ].child);
					menus += '</ol>';
				}
				menus += '</li>';
			}
			$('.dd-list').html(menus);
		});
	}

	$(document).ready(function() {
		get_pages();
		get_post_categories();
		get_file_categories();
		nested_list();
		get_menus();

		$('.checkall-pages').on('click', function() {
			$('input[type="checkbox"].list-pages').not(this).prop('checked', this.checked);
		});

		$('.checkall-post-categories').on('click', function() {
			$('input[type="checkbox"].list-post-categories').not(this).prop('checked', this.checked);
		});

		$('.checkall-file-categories').on('click', function() {
			$('input[type="checkbox"].list-file-categories').not(this).prop('checked', this.checked);
		});

		$('.checkall-modules').on('click', function() {
			$('input[type="checkbox"].modules').not(this).prop('checked', this.checked);
		});

		var serialize_menus;
		var updateOutput = function(e) {
			var list = e.length ? e : $(e.target),
				output = list.data('output');
			if (window.JSON) {
				serialize_menus = window.JSON.stringify(list.nestable('serialize'));
			}
		};
		$('#nestable').nestable().on('change', updateOutput);
		$('#save-menus').on('click', function() {
			$.post(_BASE_URL + 'appearance/menus/save_position', {"menus":serialize_menus}, function(response) {
				var res = H.stringToJSON(response);
				H.growl(res.growl, res.message);
			});
		});
	});
</script>
<section class="content-header">
	<h1><i class="fa fa-mouse-pointer text-green"></i> <?=$title;?></h1>
 </section>
<section class="content">
	<div class="row">
		<div class="col-md-4">
			<div class="box box-success box-solid collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-sign-out"></i> Custom Links</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
             	 </div>
				</div>
				<form role="form">
					<div class="box-body">
						<div class="form-group">
							<label for="menu_url">URL</label>
							<input type="text" class="form-control" id="c_menu_url">
						</div>
						<div class="form-group">
							<label for="menu_title">Link Text</label>
							<input type="text" class="form-control" id="c_menu_title">
						</div>
						<div class="form-group">
							<label for="menu_target">Target</label>
							<select class="form-control" id="c_menu_target">
								<option value="_blank">Blank</option>
								<option value="_self">Self</option>
								<option value="_parent">Parent</option>
								<option value="_top">Top</option>
							</select>
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" onclick="save_links(); return false;" class="btn btn-sm btn-primary pull-right"><i class="fa fa-send"></i> Add to Menu</button>
					</div>
				</form>
			</div>
			<div class="box box-success box-solid collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-sign-out"></i> Halaman</h3>
					<div class="box-tools pull-right">
						<button onclick="get_pages()" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Reload" class="btn btn-box-tool"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					</div>
				</div>
				<div class="box-body" id="list-pages"></div>
				<div class="overlay overlay-pages" style="display: none">
           		<i class="fa fa-refresh fa-spin"></i>
         	</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-md-6">
							<div class="checkbox">
								<label>
									<input type="checkbox" class="checkall-pages"> Pilih Semua
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="btn-group pull-right">
								<button onclick="save_pages()" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-send"></i> SIMPAN</button>
								<a href="<?=site_url('blog/pages')?>" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box box-success box-solid collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-sign-out"></i> Kategori Tulisan</h3>
					<div class="box-tools pull-right">
						<button onclick="get_post_categories()" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Reload" class="btn btn-box-tool"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					</div>
				</div>
				<div class="box-body" id="list-post-categories"></div>
				<div class="overlay overlay-post-categories" style="display: none">
           		<i class="fa fa-refresh fa-spin"></i>
         	</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-md-6">
							<div class="checkbox">
								<label>
									<input type="checkbox" class="checkall-post-categories"> Pilih Semua
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="btn-group pull-right">
								<button onclick="save_post_categories()" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-send"></i> SIMPAN</button>
								<a href="<?=site_url('blog/post_categories')?>" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box box-success box-solid collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-sign-out"></i> Kategori File</h3>
					<div class="box-tools pull-right">
						<button onclick="get_file_categories()" type="button" data-toggle="tooltip" data-placement="top" data-original-title="Reload" class="btn btn-box-tool"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					</div>
				</div>
				<div class="box-body" id="list-file-categories"></div>
				<div class="overlay overlay-file-categories" style="display: none">
           		<i class="fa fa-refresh fa-spin"></i>
         	</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-md-6">
							<div class="checkbox">
								<label>
									<input type="checkbox" class="checkall-file-categories"> Pilih Semua
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="btn-group pull-right">
								<button onclick="save_file_categories()" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-send"></i> SIMPAN</button>
								<a href="<?=site_url('media/file_categories')?>" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box box-success box-solid collapsed-box">
				<div class="box-header with-border">
					<h3 class="box-title"><i class="fa fa-sign-out"></i> Modul</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
					</div>
				</div>
				<div class="box-body" id="modules">
					<?php
					foreach(modules() as $key => $value) {
						echo '<div class="checkbox">';
						echo '<label>';
						echo '<input type="checkbox" class="modules" value="'.$key.'">'.$value;
						echo '</label>';
						echo '</div>';
					}
					?>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-md-6">
							<div class="checkbox">
								<label>
									<input type="checkbox" class="checkall-modules"> Pilih Semua
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<button onclick="save_modules()" type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-send"></i> Add to Menu</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#menu_structure" data-toggle="tab" aria-expanded="true"><i class="fa fa-sort-alpha-asc"></i> STRUKTUR MENU</a></li>
              <li><a href="#menu_manager" data-toggle="tab" aria-expanded="false"><i class="fa fa-trash"></i> KELOLA MENU</a></li>
            </ul>
				<div class="tab-content">
					<div class="tab-pane active" id="menu_structure">
						<div class="nestable-lists">
						   <div class="dd" id="nestable">
						       <ol class="dd-list"></ol>
						   </div>
						</div>
						<button id="save-menus" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> SIMPAN STRUKTUR MENU</button>
					</div>
					<div class="tab-pane" id="menu_manager">
						<div id="list-menus"></div>
						<button onclick="trash_all(); return false;" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> HAPUS SEMUA MENU</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>