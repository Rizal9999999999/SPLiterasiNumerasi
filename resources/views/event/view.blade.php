@extends('layout.app')
@section('title', $title)
@section('content')

<div class="mb-3">
	@for($i = $y-5; $i <= $y + 5; $i++) <a class="btn btn-info" href="{{ route('event.view', ['m' => $m, 'y' => $i]) }}">{{ $i }}</a>
		@endfor
</div>

<?php
$m_array = array('1' => 'Jan', '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
$days_array = array('1' => 'Mon', '2' => 'Tue', '3' => 'Wed', '4' => 'Thu', '5' => 'Fri', '6' => 'Sat', '7' => 'Sun');

$d_array = array('1' => 31, '2' => 28, '3' => 31, '4' => 30, '5' => 31, '6' => 30, '7' => 31, '8' => 31, '9' => 30, '10' => 31, '11' => 30, '12' => 31);
$date = $y . '-' . $m . '-01';
$d_m = date('t', strtotime($date));
$startday = array_search(date('D', strtotime($date)), $days_array);
$next_y = (($m + 1) > 12) ? ($y + 1) : $y;
$next_m = (($m + 1) > 12) ? 1 : ($m + 1);
$prev_y = (($m - 1) <= 0) ? ($y - 1) : $y;
$prev_m = (($m - 1) <= 0) ? 12 : ($m - 1);
?>
<div class="mb-3">
	@foreach($m_array as $key => $val)
	<a class="btn btn-success" href="{{ route('event.view', ['m' => $key, 'y' => $y]) }}">{{ $val }}</a>
	@endforeach
</div>

<div>
	<table class="table table-bordered">
		<tr>
			<th colspan="7">{{ $m_array[$m] }} {{ $y }}</th>
		</tr>
		<tr>
			@foreach($days_array as $key => $val)
			<th>{{ $val }}</th>
			@endforeach
		</tr>
		<tr>
			<?php for ($i = 1; $i < $d_m + $startday; $i++) :
				$day = ($i - $startday + 1 <= 9) ? '0' . ($i - $startday + 1) : $i - $startday + 1;
			?>
				<td class="{{ $i%7 == 0 ?'bg-danger':'' }}">
					<?php if ($i >= $startday) : ?>
						<?php if (isset($events[$y . '-' . $m . '-' . $i])) : ?>
							<a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="{{ implode(', ',$events[$y . '-' . $m . '-' . $i]) }}">{{ $day }}</a>
						<?php else : ?>
							{{ $day }}
						<?php endif ?>
					<?php endif ?>
				</td>
				<?php if ($i % 7 == 0) echo '</tr></tr>' ?>
			<?php endfor ?>
		</tr>
		<tr>
			<td colspan="7">
				<a class="btn btn-danger" href="{{ route('event.view', ['m' => $prev_m, 'y' => $prev_y]) }}">Sebelumnya</a>
				<a class="btn btn-danger float-right" href="{{ route('event.view', ['m' => $next_m, 'y' => $next_y]) }}">Berikutnya</a>
			</td>
		</tr>
	</table>
</div>
<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
@endsection