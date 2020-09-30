<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body >
        <div id="app">
            @if(Session::has('success'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
            @endif
           
            <br>
            <form method="post"  action="{{ route('import_excel') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="site" value="2">
                <input type="file" name="excel">
                <input type="submit" value="Import Excel Uybor">
            </form>
            <form method="post" style="margin-top:1rem" action="{{ route('import_excel') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="site" value="1">
                <input type="file" name="excel">
                <input type="submit" value="Import Excel OLX">
            </form>
            <div class="owner" style="margin-top:30px; display:flex;">
                <div>
                    @if(isset($estate))
                    <div style="margin-bottom:1rem">
                        {{ $count }}
                    </div>
                            @foreach ($estate as $item)
                                <div style="display: flex">
                                    <div>
                                        {{ $item->id }}
                                    </div>
                                    <div>
                                        {{ $item->title }}
                                    </div>
                                    <div>
                                        {{ $item->owner()->first()->number }}
                                    </div>
                                </div>
                            @endforeach
                            {{ $estate->links('vendor.pagination.semantic-ui') }}
                    @endif
                </div>
                <div>
                    @if(isset($owner))
                    <div style="margin-bottom:1rem">
                        {{ $counto }}
                    </div>
                    @foreach($owner as $own)
                        <div style="display: flex;">
                            <div>
                                {{ $own->number }} - {{ $own->name }} - {{ $own->announcement }} : 
                            </div>
                            @if(count($own->estates()->get())>0)
                                <span>| Ссылки: </span>
                                @foreach($own->estates()->get() as $k=>$w)
                                    <a href="{{ $w->url }}">{{ $k+1 }}- </a>
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                    {{ $owner->links('vendor.pagination.semantic-ui') }}
                @endif
                </div>
                
                
            </div>
        </div>
        <script src="{{ asset('js.app.js') }}"></script>
    </body>
</html>
