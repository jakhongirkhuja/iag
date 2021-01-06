@if(Session::has('success'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
            @endif
            @if(isset($pars))
            @foreach ($pars as $par)
                <div style="display: flex">
                    <div class="n" style="margin-right: 0.5rem; width: 250px;">
                        {{ $par->city }} {{ $par->id }}
                    </div>
                    <div class="n" style="margin-right: 0.5rem; width: 150px;">
                        {{ $par->housingtype }}
                    </div>
                    <div class="reg" style="width: 200px; margin-right:0.5rem">
                        {{ $par->region }}
                    </div>
                    <div class="url" style="overflow:hidden; width: 900px; height:20px;">
                        <a target="_blank" href="{{$par->url}}">{{$par->url}}</a>
                    </div>
                </div>    
            @endforeach
            @endif
            <div>

            </div>
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
                                    <div style="margin-right: 0.4rem">
                                        {{ $item->id }}: 
                                    </div>
                                    <div>
                                        <a href="{{ $item->url }}">{{ $item->title }}</a>
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



            <a href="{{ route('redirectauth',['name'=>'github']) }}" >GITHUB</a>
            <a href="{{ route('redirectauth',['name'=>'telegram']) }}">Telegram</a>
            <a href="{{ route('redirectauth',['name'=>'google']) }}">Google</a>
            <a href="{{ route('redirectauth',['name'=>'facebook']) }}">facebook</a>