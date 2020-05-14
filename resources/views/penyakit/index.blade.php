@extends('layouts.default')
@section('content')
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">Penyakit</div>
			<div class="card-body">
				<div class="row">
					<div class="col-4">
						<button type="button" data-toggle="modal" data-target="#createPenyakitModal" class="btn btn-sm btn-primary btn-block">Tambah</button>
					</div>
					<div class="col-12 mt-3">
						<table id="tb_penyakit" data-url="{{ route('penyakit.list') }}" data-token="{{ csrf_token() }}">
							<thead>
								<tr>
									<th>Nama Penyakit</th>
									<th>Tanaman</th>
									<th>Kultur Teknis</th>
									<th>Fisik Mekanis</th>
									<th>Kimiawi</th>
									<th>Hayati</th>
									<th>Aksi</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="modal fade" id="createPenyakitModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form id="createPenyakitForm" action="{{ route('penyakit.store') }}" method="POST">
				{{ csrf_field() }}
				{{ method_field('POST') }}
				<div class="modal-body">
					<div class="form-group">
						<label for="tanaman">Tanaman</label>
						{{ Form::select('tanaman', $tanaman, null, ['class' => 'form-control']) }}
					</div>
					<div class="form-group">
						<label for="nama_penyakit">Nama Penyakit</label>
						<input type="text" name="nama_penyakit" class="form-control" placeholder="Masukkan Nama Penyakit" required="required">
					</div>
					<div class="form-group">
						<label for="kulturteknis">Kultur Teknis</label>
						<textarea class="form-control" name="kulturteknis"></textarea>
					</div>
					<div class="form-group">
						<label for="fisikmekanis">Fisik Mekanis</label>
						<textarea class="form-control" name="fisikmekanis"></textarea>
					</div>
					<div class="form-group">
						<label for="kimiawi">Kimiawi</label>
						<textarea class="form-control" name="kimiawi"></textarea>
					</div>
					<div class="form-group">
						<label for="hayati">Hayati</label>
						<textarea class="form-control" name="hayati"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-sm btn-primary" id="doCreateItem">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="ubahPenyakitModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Penyakit</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form id="ubahPenyakitForm" method="PATCH">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				<div class="modal-body">
					<div class="form-group">
						<label for="tanaman">Tanaman</label>
						{{ Form::select('tanaman', $tanaman, null, ['class' => 'form-control']) }}
					</div>
					<div class="form-group">
						<label for="nama_penyakit">Nama Penyakit</label>
						<input type="text" name="nama_penyakit" class="form-control" placeholder="Masukkan Nama Penyakit" required="required">
					</div>
					<div class="form-group">
						<label for="kulturteknis">Kultur Teknis</label>
						<textarea class="form-control" name="kulturteknis"></textarea>
					</div>
					<div class="form-group">
						<label for="fisikmekanis">Fisik Mekanis</label>
						<textarea class="form-control" name="fisikmekanis"></textarea>
					</div>
					<div class="form-group">
						<label for="kimiawi">Kimiawi</label>
						<textarea class="form-control" name="kimiawi"></textarea>
					</div>
					<div class="form-group">
						<label for="hayati">Hayati</label>
						<textarea class="form-control" name="hayati"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-sm btn-primary" id="doUpdateitem">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@push('scriptku')
<script type="text/javascript">
		const baseurl = '{{ url('admin/penyakit') }}';
		const toast = swal.mixin({
		    toast: true,
		    position: 'top-end',
		    showConfirmButton: false,
		    timer: 3000
		});

    var tb_penyakit = $('#tb_penyakit').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#tb_penyakit').data('url'),
        columns: [
					{ data: 'nama_penyakit', name:'nama_penyakit'},
					{ data: 'tanaman.nama', name: 'tanaman' },
					{ data: 'kulturteknis', name:'kulturteknis'},
					{ data: 'fisikmekanis', name:'fisikmekanis'},
					{ data: 'kimiawi', name:'kimiawi'},
					{ data: 'hayati', name:'hayati'},
					{ data: 'action', name:'action'}
        ]
    });

		$(document).on('click', '#doCreateItem', function(e) {
		    $('#createPenyakitModal').modal('hide');
		    $('.overlay').css('display','block');
		    var form_action = $('#createPenyakitForm').attr('action');
		    var token = $('#createPenyakitForm').find("input[name=_token]").val();
		    var formdata = $('#createPenyakitForm').serialize();
		    e.preventDefault();
		    $.ajax({
		        header: {
		            'X-CSRF-TOKEN': token
		        },
		        method: "POST",
		        url : form_action,
		        data : formdata,
		        datatype : 'json',
		        success : function(){
		            toast({
		                type: 'success',
		                title: 'Data berhasil disimpan!'
		            });
		            tb_penyakit.ajax.reload();
		            $('#createPenyakitForm')[0].reset();
		        },
		        error : function(){
		            toast({
		                type: 'error',
		                title: 'Perubahan Tidak Disimpan!'
		            });
		            tb_penyakit.ajax.reload();
		        }
		    });
		});

		function hapusPenyakit(id){
		    token = $('#tb_penyakit').data('token');
		    swal({
		        title: 'Apa anda yakin ?',
		        text: "Ingin menghapus penyakit yang dipilih?",
		        type: 'warning',
		        showCancelButton: true,
		        confirmButtonColor: '#3085d6',
		        cancelButtonColor: '#d33',
		        confirmButtonText: 'Hapus Data'
		    }).then((result) => {
		        if (result.value) {
								url = baseurl + '/' + id;
		            $.ajax({
		                header: {
		                    'X-CSRF-TOKEN': token
		                },
		                method: "DELETE",
		                url: url,
		                data: {
		                    _token : token
		                },
		                datatype: 'json',
		            }).done(function(){
		                toast({
		                    type: 'success',
		                    title: 'Data berhasil dihapus!'
		                });
		                tb_penyakit.ajax.reload();
		            }).fail(function(){
		                toast({
		                    type: 'error',
		                    title: 'Perubahan Tidak Disimpan!'
		                });
		            });
		        } else {
		            toast({
		                type: 'error',
		                title: 'Aksi dibatalkan!'
		            });
		        }
		    })
		}

		function showEditModal(id) {
			var url = baseurl + '/' + id + '/detail';
			$.get(url, function(data){
					$('#ubahPenyakitModal').modal('show');
					$('#ubahPenyakitForm').attr('action', `${baseurl}/${id}`);
					$('#ubahPenyakitForm').find('[name="nama_penyakit"]').val(data.nama_penyakit);
					$('#ubahPenyakitForm').find('[name="kulturteknis"]').val(data.kulturteknis);
					$('#ubahPenyakitForm').find('[name="fisikmekanis"]').val(data.fisikmekanis);
					$('#ubahPenyakitForm').find('[name="kimiawi"]').val(data.kimiawi);
					$('#ubahPenyakitForm').find('[name="hayati"]').val(data.hayati);
					$('#ubahPenyakitForm').find('[name="tanaman"]').val(data.tanaman);
			});
		}

		$(document).on('click', '#doUpdateitem', function(e) {
		    $('#ubahPenyakitModal').modal('hide');
		    $('.overlay').css('display','block');
		    var form_action = $('#ubahPenyakitForm').attr('action');
		    var token = $('#ubahPenyakitForm').find("input[name=_token]").val();
		    var formdata = $('#ubahPenyakitForm').serialize();
		    e.preventDefault();
		    $.ajax({
		        header: {
		            'X-CSRF-TOKEN': token
		        },
		        method: "PATCH",
		        url : form_action,
		        data : formdata,
		        datatype : 'json',
		        success : function(){
		            toast({
		                type: 'success',
		                title: 'Data berhasil disimpan!'
		            });
		            tb_penyakit.ajax.reload();
		            $('#createPenyakitForm')[0].reset();
		        },
		        error : function(){
		            toast({
		                type: 'error',
		                title: 'Perubahan Tidak Disimpan!'
		            });
		            tb_penyakit.ajax.reload();
		        }
		    });
		});
</script>
@endpush
