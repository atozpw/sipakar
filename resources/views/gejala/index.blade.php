@extends('layouts.default')
@section('content')
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">Gejala</div>
			<div class="card-body">
				<div class="row">
					<div class="col-4">
						<button type="button" data-toggle="modal" data-target="#createGejalaModal" class="btn btn-sm btn-primary btn-block">Tambah</button>
					</div>
					<div class="col-12 mt-3">
						<table id="tb_gejala" data-url="{{ route('gejala.list') }}" data-token="{{ csrf_token() }}">
							<thead>
								<tr>
									<th class="col-4">Nama Gejala</th>
									<th class="col-2">Tanaman</th>
									<th class="col-2">Daerah Gejala</th>
									<th class="col-4">Aksi</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="modal fade" id="createGejalaModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form id="createGejalaForm" action="{{ route('gejala.store') }}" method="POST">
				{{ csrf_field() }}
				{{ method_field('POST') }}
				<div class="modal-body">
					<div class="form-group">
						<label for="tanaman">Tanaman</label>
						{{ Form::select('tanaman', $tanaman,null, ['class' => 'form-control']) }}
					</div>
					<div class="form-group">
						<label for="nama_gejala">Nama Gejala</label>
						<input type="text" name="nama_gejala" class="form-control" placeholder="Masukkan Nama Gejala" required="required">
					</div>
					<div class="form-group">
						<label for="daerah_gejala">Daerah Gejala</label>
						{{ Form::select('daerah_gejala', $daerahGejala, null, ['class' => 'form-control']) }}
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

<div class="modal fade" id="ubahGejalaModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Gejala</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form id="ubahGejalaForm" method="PATCH">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				<div class="modal-body">
					<div class="form-group">
						<label for="tanaman">Tanaman</label>
						{{ Form::select('tanaman', $tanaman,null, ['class' => 'form-control']) }}
					</div>
					<div class="form-group">
						<label for="nama_gejala">Nama Gejala</label>
						<input type="text" name="nama_gejala" class="form-control" placeholder="Masukkan Nama Gejala" required="required">
					</div>
					<div class="form-group">
						<label for="daerah_gejala">Daerah Gejala</label>
						{{ Form::select('daerah_gejala', $daerahGejala, null, ['class' => 'form-control']) }}
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
		const baseurl = '{{ url('admin/gejala') }}';
		const toast = swal.mixin({
		    toast: true,
		    position: 'top-end',
		    showConfirmButton: false,
		    timer: 3000
		});

    var tb_gejala = $('#tb_gejala').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#tb_gejala').data('url'),
        columns: [
					{ data: 'nama_gejala', name:'nama_gejala'},
					{ data: 'tanaman.nama', name: 'tanaman.nama' },
					{ data: 'daerah_gejala.daerah_gejala', name: 'daerah_gejala.daerah_gejala' },
					{ data: 'action', name:'action'}
        ]
    });

		$(document).on('click', '#doCreateItem', function(e) {
		    $('#createGejalaModal').modal('hide');
		    $('.overlay').css('display','block');
		    var form_action = $('#createGejalaForm').attr('action');
		    var token = $('#createGejalaForm').find("input[name=_token]").val();
		    var formdata = $('#createGejalaForm').serialize();
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
		            tb_gejala.ajax.reload();
		            $('#createGejalaForm')[0].reset();
		        },
		        error : function(){
		            toast({
		                type: 'error',
		                title: 'Perubahan Tidak Disimpan!'
		            });
		            tb_gejala.ajax.reload();
		        }
		    });
		});

		function hapusGejala(id){
		    token = $('#tb_gejala').data('token');
		    swal({
		        title: 'Apa anda yakin ?',
		        text: "Ingin menghapus gejala yang dipilih?",
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
		                tb_gejala.ajax.reload();
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
			var url = baseurl + '/' + id;
			$.get(url, function(data){
					$('#ubahGejalaModal').modal('show');
					$('#ubahGejalaForm').attr('action', `${baseurl}/${id}`);
					$('#ubahGejalaForm').find('[name="nama_gejala"]').val(data.nama_gejala);
					$('#ubahGejalaForm').find('[name="tanaman"]').val(data.tanaman.id);
					$('#ubahGejalaForm').find('[name="daerah_gejala"]').val(data.daerah_gejala.id);
			});
		}

		$(document).on('click', '#doUpdateitem', function(e) {
		    $('#ubahGejalaModal').modal('hide');
		    $('.overlay').css('display','block');
		    var form_action = $('#ubahGejalaForm').attr('action');
		    var token = $('#ubahGejalaForm').find("input[name=_token]").val();
		    var formdata = $('#ubahGejalaForm').serialize();
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
		            tb_gejala.ajax.reload();
		            $('#createGejalaForm')[0].reset();
		        },
		        error : function(){
		            toast({
		                type: 'error',
		                title: 'Perubahan Tidak Disimpan!'
		            });
		            tb_gejala.ajax.reload();
		        }
		    });
		});
</script>
@endpush
