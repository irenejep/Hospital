@extends("layouts.master")
@section("content")
    <h1>Hello Kaizala</h1>
    <div id="form">
    <form action="#" name="inputform">
    @csrf
    <input type="hidden" name="applicationId" value={{$application_id}}/>
    <input type="hidden" name="applicationPhone" value="{{$application_phone}}"/>
    <input type="hidden" name="applicationSecret" value="{{$application_phone}}"/>
    <div class="inputItems">
        <label>PIN:</label>
        <input type="text" name="pin" placeholder="input pin"/>
    </div>
    <div class="inputButtons">
    <button class='btn btn-primary' type="button" onclick='generatePin("{{$application_id}}","{{$application_phone}}")'>Generate Pin</button>
    <button class='btn btn-primary' type="submit">Submit</button>
    </div>
    </form>
    </div>
    <script src="/js/kaizala.js"></script>
@endsection