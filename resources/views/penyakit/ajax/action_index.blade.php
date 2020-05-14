<a href="{{ route('penyakit.show', $data->id) }}" class="btn btn-sm btn-primary">Lihat </a>
<button type="button" class="btn btn-sm btn-danger" onclick="hapusPenyakit({{ $data->id }})">Hapus</button>