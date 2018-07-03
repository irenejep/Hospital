@extends("layouts.master")
<body onload = "generateRefreshToken()">
@section("content")
    <h3>User authentication</h3>
    <div id  = "allgroups"></div>
    <div id="form">
    <form action="#" name="inputform">
    @csrf
    <input type="hidden" name="applicationId" value={{$application_id}}/>
    <input type="hidden" name="applicationPhone" value="{{$application_phone}}"/>
    <input type="hidden" name="applicationSecret" value="{{$application_secret}}"/>
    <div class="inputItems">
        <label>PIN:</label>
        <input type="text" name="pin" placeholder="input pin"/>
        <button class='btn btn-primary btn-sm' type="submit"><b><i><i class="material-icons">verified_user</i>Verify pin</i></b></button>
    </div>
    <div class="inputButtons">
    <button class='btn btn-success btn-sm ' type="button" onclick='generatePin("{{$application_id}}","{{$application_phone}}","{{$application_secret}}")'><i class="material-icons">lock</i>Generate Pin</button>
    
    </div>
    </form>
    </div>
    <div id="groupForm">
    <form action="POST" name="groupinputform" id = "createGroup">
    @csrf
    <input type="hidden" id="accessToken" value="accessToken"/>
    <div class="inputItems">
        <label>Group Name:</label>
        <input type="text" name="groupName"/>
    </div>
    <div class="inputItems">
        <label>Welcome message:</label>
        <input type="text" name="welcomeMessage"/>
    </div>
    <div class="inputItems">
        <label>Group type:</label>
        <input type="text" name="groupType"/>
    </div>
    <div class="inputButtons">
    <button class='btn btn-primary' type="submit">create group</button>
    </div>
    </form>
    </div>
    <script src="/js/kaizala.js"></script>
@endsection
</body>