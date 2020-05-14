@extends('layouts.default')
@section('content')
<div class="card">
	<div class="card-header">Tanaman</div>
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<button type="button" data-toggle="modal" data-target="#tambahTanaman" class="btn btn-sm btn-primary btn-block">Tambah</button>
			</div>
			<div class="col-12 mt-3">
				<table data-url="{{ route('tanaman.list') }}" id="tanamanTable" data-token="{{ csrf_token() }}">
					<thead>
						<tr>
							<th>Nama Tanaman</th>
							<th>Aksi</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="tambahTanaman">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form action="{{ route('tanaman.store') }}" method="POST">
				{!! csrf_field() !!}
				{!! method_field('POST') !!}
				<div class="modal-body">
					<div class="form-group">
						<label for="nama">Nama Tanaman :</label>
						<input name="nama" type="text" class="form-control" placeholder="Masukkan Nama Tanaman" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-sm btn-primary">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="ubahTanaman">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Ubah Tanaman</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<form action="{{ route('tanaman.store') }}" method="POST">
				{!! csrf_field() !!}
				{!! method_field('PUT') !!}
				<div class="modal-body">
					<div class="form-group">
						<label for="nama">Nama Tanaman :</label>
						<input name="nama" type="text" id="tanaman" class="form-control" placeholder="Masukkan Nama Tanaman" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-sm btn-primary">Save changes</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
@endsection

@push('scriptku')
<script type="text/javascript">
    var penyakitTable = $('#tanamanTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: $('#tanamanTable').data('url'),
        columns: [
            { data: 'nama', name:'nama'},
            { data: 'action', name:'action'}
        ]
    });
</script>
@endpush