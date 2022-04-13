

@foreach($ramas as $idx => $rama)
    <label for="rama-{{$idx}}" class="{{($rama == $rama_actual) ? "text-success" : ''}}">
        <input type="radio" name="rama" id="rama-{{$idx}}" value="{{$rama}}" {{($rama == $rama_actual) ? "checked":''}}> {{$rama}}
    </label>
    <br>
@endforeach
