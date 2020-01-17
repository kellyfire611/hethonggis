<ul>
    @foreach(array_keys(config('locale.languages')) as $lang)
        <li>
        @if($lang != app()->getLocale())
            <small><a href="{{ '/lang/'.$lang }}" class="dropdown-item">@lang('menus.language-picker.langs.'.$lang)</a></small>
        @endif
        </li>
    @endforeach
</ul>
