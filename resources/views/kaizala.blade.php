

@extends("layouts.master")
<body>
   @section("content")
   <!-- <body onload= "hideform()"> -->
   <div class="flex-center position-ref full-height">
      <div class="content">
         <div class="title m-b-md">
            Grey-Sloan Memorial
         </div>
         <div class="links">
            <a href="#"onclick="authenticate('{{$moblenumber}}', '{{$applicationid}}' , '{{$secret}}')">Authentication</a>
            <a href="/patients">Patients</a>
         </div>
      </div>
   </div>
   <div id="PinForm" >
      <form action="#" class="form-horizontal form-control" method="POST" id="pinFormid" name="pForm">
         @csrf 
         <input type="hidden" name="secret" id="secretid">  
         <input type="hidden" name="mobile" id="mobileid"> 
         <input type="hidden" name="app" id="appid">
         <div class="inputTexts">
            <label>Enter your Pin:</label>
            <input type="number" class="form-control" name="pin" required/>
         </div>
         <br>
         <div class="inputButtons">
            <button type="submit" class="btn btn-warning">Submit</button>
         </div>
      </form>
   </div>
   <script>
      var methods = ['GET', 'POST'];
         var baseUrl = 'http://localhost:8000/';
         var apiRoot= 'https://api.kaiza.la';
         var contenttype= ['application/json','application/x-www-form-urlencoded'];
      
         function createAjaxObject(readyStateFunction, requestMethod, requestUrl,contenttype, sendData = null, refreshToken=null, vars=null, accessToken = null){
             var obj = new XMLHttpRequest();
      
             obj.onreadystatechange = function(){
                 if ((this.readyState == 4) && (this.status == 200)){
                         readyStateFunction(this.responseText, accessToken = null);
                 }
             };
             obj.open(requestMethod, requestUrl, true);
      
             if(refreshToken != null){
                 obj.setRequestHeader("applicationId", vars[0]);
                 obj.setRequestHeader("applicationSecret", vars[1]);
                 obj.setRequestHeader("refreshToken", refreshToken);
             }
             
             if(accessToken != null){
                 obj.setRequestHeader("accessToken", accessToken);
             }
             if (requestMethod == 'POST'){
                 obj.setRequestHeader("Content-type", contenttype);
                 //obj.setRequestHeader("X-CSRF-Token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                 obj.send(sendData);
             } else {
                 obj.send();
             }
         }
         function hideform()
         {
             document.getElementById("PinForm").style.display="none";
         }
      
         function authenticate(mobilenumber,applicationid,secret)
         {
             document.forms["pForm"]["secret"].value=secret;
             document.forms["pForm"]["mobile"].value=mobilenumber;
             document.forms["pForm"]["app"].value=applicationid;
             document.getElementById("PinForm").style.display="block";
             var url=apiRoot+'/v1/generatePin';
             var data='{"mobileNumber":"'+mobilenumber+'", applicationId:"'+applicationid+'"}';
             console.log(data);
             createAjaxObject(getPin,methods[1], url ,contenttype[0] , data );
         
         }
          function getPin()
          {
              
          }
           function getRefreshToken(e){
           e.preventDefault();
             var mobilenumber= document.forms["pForm"]["mobile"].value;
             var applicationid=document.forms["pForm"]["app"].value;
             var secret=document.forms["pForm"]["secret"].value;
             var pin=document.forms["pForm"]["pin"].value;
      
             var url=apiRoot+'/v1/loginWithPinAndApplicationId';
             var data='{"mobileNumber":"'+mobilenumber+'","applicationId":"'+applicationid+'", "applicationSecret":"'+secret+'", "pin":'+pin+'}';
             console.log(data);
             createAjaxObject(refreshtoken,methods[1], url ,contenttype[0] , data);
         
           }
           function refreshtoken(jsonResponse)
           {
             var responseObj = JSON.parse(jsonResponse);
             console.log(responseObj);
      
             var applicationid=document.forms["pForm"]["app"].value;
             var secret=document.forms["pForm"]["secret"].value;
      
             var vars = [applicationid, secret];
      
             createAjaxObject(getgroups,methods[0], responseObj.endpointUrl + 'v1/accessToken' ,contenttype[0] , null, responseObj.refreshToken, vars); 
           }
      
           function getgroups(jsonResponse)
           {
             var responseObj = JSON.parse(jsonResponse);
             createAjaxObject(fetchGroups,methods[0], responseObj.endpointUrl + 'v1/groups?fetchAllGroups=true&showDetails=true' ,contenttype[0] , null,null, null, responseObj.accessToken);
           }
      
           
      var table = '';
      table += "<table class='table table-bordered table-striped table-condensed'><tr><th class='text-centre'>Group Name</th><th class='text-centre'>Sub Groups</th>";
      table += "<th class='text-centre'>Group Type</th><th class='text-centre'>Welcome Message</th></tr><tbody id='tbody'></tbody></table>";
      
      function fetchGroups(jsonResponse) {
      const responseObj = JSON.parse(jsonResponse);
      
      var groups = responseObj.groups;
      
      console.log(groups);
      
      var tbody = '';
      for (var i = 0; i < groups.length; i++) {
      tbody += '<tr><td>' + responseObj.groups[i].groupName + '</td>';
      tbody += '<td>' + responseObj.groups[i].hasSubGroups + '</td>';
      tbody += '<td>' + responseObj.groups[i].groupType + '</td>';
      tbody += '<td>' + responseObj.groups[i].welcomeMessage + '</td></tr>';
      
      document.getElementById('PinForm').innerHTML = table;
      document.getElementById('tbody').innerHTML = tbody;
      }
      }
      
      
           document.getElementById("pinFormid").addEventListener("submit", getRefreshToken);
           
   </script>
   @endsection
</body>

