@extends('layouts.default')
@section('content')
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">Daerah Gejala</div>
			<div class="card-body">
				<div class="row">
					<div class="col-4">
						<button type="button" data-toggle="modal" data-target="#tambahDaerahGejala" class="btn btn-sm btn-primary btn-block">Tambah</button>
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

<div class="modal fade" id="tambahDaerahGejala">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form action="{{ route('daerah_gejala.store') }}" method="POST">
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
					<button type="submit" class="btn btn-sm btn-primary">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="ubahDaerahGejala">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Daerah Gejala</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form action="{{ route('daerah_gejala.store') }}" method="POST">
				{{ csrf_field() }}
				{{ method_field('POST') }}
				<div class="modal-body">
					<div class="form-group">
						<label for="daerah_gejala">Daerah Gejala</label>
						<input type="text" class="form-control" name="daerah_gejala" id="daerah_gejala" placeholder="Masukkan Nama Daerah Gejala" required="required">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-sm btn-primary">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@push('scriptku')
<script type="text/javascript">
    var tb_daerahGejala = $('#tb_daerahGejala').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#tb_daerahGejala').data('url'),
        columns: [
            { data: 'daerah_gejala', name:'daerah_gejala'},
            { data: 'action', name:'action'}
        ]
    });
</script>
@endpush