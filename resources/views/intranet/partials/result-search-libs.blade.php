<table class="table">
    <thead>
    <tr>
        <th> Title </th>
        <th> Content </th>
        <th> Description </th>
        <th> Category </th>
    </tr>
    </thead>
    <tbody>
    @foreach($libs as $lib)
        <tr>
            <td> {{ $lib -> title }} </td>
            <td width="30%">
                @if($lib->asset_id)
                    <img src="{{asset('assets/dist/img/intranet/library/'.$lib->asset->type.'-icon.png')}}"
                         alt="icon">
                    <a href="../{{ $lib->asset->getMedia()[0]->getUrl() }}" download>
                        {{ $lib->title }}
                    </a> <br>
                @endif
            </td>
            <td>@if($lib->description){{ $lib->description }}@endif</td>
            <td>
                <a href="{{ url('intranet/libs/category/' . $lib->category->id) }}">{{ $lib -> category->title }}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tr>

    </tr>
</table>