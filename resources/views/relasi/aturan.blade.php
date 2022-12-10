@extends('layout.app')
@section('title', $title)
@section('content')
{{ show_msg() }}
<div class="card">
	<div class="card-body p-0 table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<th>No</th>
				<th>Rule</th>
			</thead>
			<?php
			$no = 1;
			?>
			@foreach($aturan as $key => $val)
			<tr>
				<td>{{ $no++ }}</td>
				<td>IF
					<?php
					$arr = array();
					foreach ($val as $k => $v) {
						$arr[$k] = '<span class="text-danger">[' . $v . '] ' . $GEJALA[$v]->nama_indikator . '</span>';
					}
					?>
					<?= implode('<br /> &nbsp; &nbsp; &nbsp; AND ', $arr) ?>
					<br />THEN <span class="text-primary">{{ $PENYAKIT[$key]->nama_kompetensi }}</span>
				</td>
			</tr>
			@endforeach
		</table>
	</div>
</div>
@endsection