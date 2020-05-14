@extends('layouts.default')
@section('content')
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">Daerah Gejala</div>
			<div class="card-body">
				<div class="row">
					<div class="col-4">
						<button type="button" data-toggle="modal" data-target="#createDaerahGejalaModal" class="btn btn-sm btn-primary btn-block">Tambah</button>
					</div>
					<div class="col-12 mt-3">
						<table id="tb_daerahGejala" data-url="{{ route('daerah_gejala.list') }}" data-token="{{ csrf_token() }}">
							<thead>
								<tr>
									<th>Daerah Penyakit</th>
									<th>Aksi</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="modal fade" id="createDaerahGejalaModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form id="createDaerahGejalaForm" action="{{ route('daerah_gejala.store') }}" method="POST">
				{{ csrf_field() }}
				{{ method_field('POST') }}
				<div class="modal-body">
					<div class="form-group">
						<label for="daerah_gejala">Daerah Gejala</label>
						<input type="text" class="form-control" name="daerah_gejala" placeholder="Masukkan Nama Daerah Gejala" required="required">
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

<div class="modal fade" id="ubahDaerahGejalaModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Daerah Gejala</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form #updateForm id="ubahDaerahGejalaForm" method="PATCH">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				<div class="modal-body">
					<div class="form-group">
						<label for="daerah_gejala">Daerah Gejala</label>
						<input type="text" class="form-control" name="daerah_gejala" placeholder="Masukkan Nama Daerah Gejala" required="required">
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
		const baseurl = '{{ url('admin/daerah_gejala') }}';
		const toast = swal.mixin({
		    toast: true,
		    position: 'top-end',
		    showConfirmButton: false,
		    timer: 3000
		});

    var tb_daerahGejala = $('#tb_daerahGejala').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#tb_daerahGejala').data('url'),
        columns: [
            { data: 'daerah_gejala', name:'daerah_gejala'},
            { data: 'action', name:'action'}
        ]
    });

		$(document).on('click', '#doCreateItem', function(e) {
		    $('#createDaerahGejalaModal').modal('hide');
		    $('.overlay').css('display','block');
		    var form_action = $('#createDaerahGejalaForm').attr('action');
		    var token = $('#createDaerahGejalaForm').find("input[name=_token]").val();
		    var formdata = $('#createDaerahGejalaForm').serialize();
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
		            tb_daerahGejala.ajax.reload();
		            $('#createDaerahGejalaForm')[0].reset();
		        },
		        error : function(){
		            toast({
		                type: 'error',
		                title: 'Perubahan Tidak Disimpan!'
		            });
		            tb_daerahGejala.ajax.reload();
		        }
		    });
		});

		function hapusDaerahGejala(id){
		    token = $('#tb_daerahGejala').data('token');
		    swal({
		        title: 'Apa anda yakin ?',
		        text: "Ingin menghapus daerah gejala yang dipilih?",
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
		                tb_daerahGejala.ajax.reload();
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
					$('#ubahDaerahGejalaModal').modal('show');
					$('#ubahDaerahGejalaForm').attr('action', `${baseurl}/${id}`);
					$('#ubahDaerahGejalaForm').find('[name="daerah_gejala"]').val(data.daerah_gejala);
			});
		}

		$(document).on('click', '#doUpdateitem', function(e) {
		    $('#ubahDaerahGejalaModal').modal('hide');
		    $('.overlay').css('display','block');
		    var form_action = $('#ubahDaerahGejalaForm').attr('action');
		    var token = $('#ubahDaerahGejalaForm').find("input[name=_token]").val();
		    var formdata = $('#ubahDaerahGejalaForm').serialize();
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
		            tb_daerahGejala.ajax.reload();
		            $('#createDaerahGejalaForm')[0].reset();
		        },
		        error : function(){
		            toast({
		                type: 'error',
		                title: 'Perubahan Tidak Disimpan!'
		            });
		            tb_daerahGejala.ajax.reload();
		        }
		    });
		});
</script>
@endpush
