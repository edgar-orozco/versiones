

@foreach($ramas as $idx => $rama)
    <label for="rama-{{$idx}}" class="{{(substr($rama, strpos($rama, $rama_original)) == $rama_original) ? "text-success" : ''}}">
        <input type="radio" name="rama" id="rama-{{$idx}}" value="{{$rama}}" {{(substr($rama, strpos($rama, $rama_original)) == $rama_original) ? "checked":''}}> {{$rama}}
    </label>
    <br>
@endforeach
