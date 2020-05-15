@extends('layouts.default')
@section('content')
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">Tanaman</div>
			<div class="card-body">
				<div class="row">
					<div class="col-4">
						<button type="button" data-toggle="modal" data-target="#createTanamanModal" class="btn btn-sm btn-primary btn-block">Tambah</button>
					</div>
					<div class="col-12 mt-3">
						<table id="tb_tanaman" data-url="{{ route('tanaman.list') }}" data-token="{{ csrf_token() }}">
							<thead>
								<tr>
									<th>Tanaman</th>
									<th>Aksi</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="modal fade" id="createTanamanModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form id="createTanamanForm" action="{{ route('tanaman.store') }}" method="POST">
				{{ csrf_field() }}
				{{ method_field('POST') }}
				<div class="modal-body">
					<div class="form-group">
						<label for="nama">Tanaman</label>
						<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Tanaman" required="required">
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

<div class="modal fade" id="ubahTanamanModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Tanaman</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form id="ubahTanamanForm" method="PATCH">
				{{ csrf_field() }}
				{{ method_field('PATCH') }}
				<div class="modal-body">
					<div class="form-group">
						<label for="nama">Tanaman</label>
						<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Tanaman" required="required">
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
		const baseurl = '{{ url('admin/tanaman') }}';
		const toast = swal.mixin({
		    toast: true,
		    position: 'top-end',
		    showConfirmButton: false,
		    timer: 3000
		});

    var tb_tanaman = $('#tb_tanaman').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#tb_tanaman').data('url'),
        columns: [
            { data: 'nama', name:'nama'},
            { data: 'action', name:'action'}
        ]
    });

		$(document).on('click', '#doCreateItem', function(e) {
		    $('#createTanamanModal').modal('hide');
		    $('.overlay').css('display','block');
		    var form_action = $('#createTanamanForm').attr('action');
		    var token = $('#createTanamanForm').find("input[name=_token]").val();
		    var formdata = $('#createTanamanForm').serialize();
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
		            tb_tanaman.ajax.reload();
		            $('#createTanamanForm')[0].reset();
		        },
		        error : function(){
		            toast({
		                type: 'error',
		                title: 'Perubahan Tidak Disimpan!'
		            });
		            tb_tanaman.ajax.reload();
		        }
		    });
		});

		function hapusTanaman(id){
		    token = $('#tb_tanaman').data('token');
		    swal({
		        title: 'Apa anda yakin ?',
		        text: "Ingin menghapus tanaman yang dipilih?",
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
		                tb_tanaman.ajax.reload();
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
					$('#ubahTanamanModal').modal('show');
					$('#ubahTanamanForm').attr('action', `${baseurl}/${id}`);
					$('#ubahTanamanForm').find('[name="nama"]').val(data.nama);
			});
		}

		$(document).on('click', '#doUpdateitem', function(e) {
		    $('#ubahTanamanModal').modal('hide');
		    $('.overlay').css('display','block');
		    var form_action = $('#ubahTanamanForm').attr('action');
		    var token = $('#ubahTanamanForm').find("input[name=_token]").val();
		    var formdata = $('#ubahTanamanForm').serialize();
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
		            tb_tanaman.ajax.reload();
		            $('#createTanamanForm')[0].reset();
		        },
		        error : function(){
		            toast({
		                type: 'error',
		                title: 'Perubahan Tidak Disimpan!'
		            });
		            tb_tanaman.ajax.reload();
		        }
		    });
		});
</script>
@endpush
