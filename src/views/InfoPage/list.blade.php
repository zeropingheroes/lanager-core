@if(!empty($infoPages))
	@foreach($infoPages as $infoPage)
		<li><a href="{{route('info.show',$infoPage->id)}}">{{{$infoPage->title}}}</a></li>
	@endforeach
@endif