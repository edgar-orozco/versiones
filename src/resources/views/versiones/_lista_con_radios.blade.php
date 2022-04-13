

@foreach($ramas as $idx => $rama)
    <label for="rama-{{$idx}}" class="{{(substr($rama, strpos($rama, $rama_actual)) == $rama_actual) ? "text-success" : ''}}">
        <input type="radio" name="rama" id="rama-{{$idx}}" value="{{$rama}}" {{(substr($rama, strpos($rama, $rama_actual)) == $rama_actual) ? "checked":''}}> {{$rama}}
    </label>
    <br>
@endforeach
