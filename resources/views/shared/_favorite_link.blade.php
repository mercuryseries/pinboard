@if($favorited = in_array($pin->id, $favorites))
	<a href="{{ route('favorite_path', $pin->id) }}"
		class="btn btn-default {{ $favorited ? 'favorited' : 'not-favorited' }}" data-method="DELETE">
@else
	<a href="{{ route('favorite_path', $pin->id) }}"
		class="btn btn-default {{ $favorited ? 'favorited' : 'not-favorited' }}" data-method="PUT">
@endif
	<span class="glyphicon glyphicon-heart"></span>
			{{ $pin->favorites->count() }}
</a>