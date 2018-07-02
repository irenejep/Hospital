            var method = ["POST", "GET"];
            var appUrl = "https://api.kaiza.la";
            var contenttype= ['application/json','application/x-www-form-urlencoded'];
            function createObject(readyStateFunction, requestMethod, requestUrl,contenttype, sendData = null, refreshToken=null, accessToken = null, vars=null)
            {
                var obj = new XMLHttpRequest();
                obj.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                    readyStateFunction(this.responseText);
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
                if(requestMethod == 'POST'){
                    obj.setRequestHeader("Content-type", contenttype);
                    obj.setRequestHeader("X-CSRF-Token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    obj.send(sendData);
                }
                else{
                    obj.send();
                }
            }
            function generatePin(application_id,application_phone,application_secret){
                document.forms["inputform"]["applicationSecret"].value=application_secret;
                document.forms["inputform"]["applicationPhone"].value=application_phone;
                document.forms["inputform"]["applicationId"].value=application_id;
                var sendData = '{"mobileNumber":"'+application_phone+'", applicationId:"'+application_id+'"}';
                createObject(generateRefreshToken, method[0], appUrl + "/v1/generatePin",contenttype[0], sendData);
            }
            function generateRefreshToken(){

            }
            function submitPin(e){
                e.preventDefault();
                var pin=document.forms['inputform']['pin'].value;
                var application_id=document.forms['inputform']['applicationId'].value;
                var applicationPhone= document.forms['inputform']['applicationPhone'].value;
                var application_secret=document.forms['inputform']['applicationSecret'].value;
                if(pin !="")
                {
                var sendData='{"mobileNumber":"'+applicationPhone+'","applicationId":"'+application_id+'","applicationSecret":"'+application_secret+'", "pin":"'+pin+'"}';
                createObject(refreshToken, method[0], appUrl + "/v1/loginWithPinAndApplicationId",contenttype[0], sendData,null,null,null);
                console.log(sendData);
                console.log(appUrl);
                }
            }
            function refreshToken(jsonResponse){
                var responseObj = JSON.parse(jsonResponse);
                console.log(jsonResponse);
                var applicationId=document.forms["inputform"]["applicationId"].value;
                var applicationSecret=document.forms["inputform"]["applicationSecret"].value;
                var vars = [applicationId, applicationSecret];
                var refreshToken=responseObj.refreshToken;
                createObject(accessGroup, method[1], appUrl +'/v1/accessToken', contenttype[0], null, refreshToken, null, vars); 
            }
            function accessGroup(jsonResponse){
                var responseObj = JSON.parse(jsonResponse);
                var accessToken = responseObj.accessToken;
                createObject(fetchGroups,method[1], appUrl + 'v1/groups?fetchAllGroups=true&showDetails=true' ,contenttype[0] , null,null, null, accessToken);
           }
           
           var tableData = '';
           tableData += "<table class='table table-bordered table-striped table-condensed'><tr><th class='text-centre'>Group Name</th><th class='text-centre'>Sub Groups</th>";
           tableData += "<th class='text-centre'>Group Type</th><th class='text-centre'>Welcome Message</th></tr><tbody id='tbody'></tbody></table>";
           
           function fetchGroups(jsonResponse) {
                var responseObj = JSON.parse(jsonResponse);
                var groups = responseObj.groups
                var tbody = '';
                for (var i = 0; i < groups.length; i++) {
                    tbody += '<tr><td>' + groups[i].groupName + '</td>';
                    tbody += '<td>' + groups[i].hasSubGroups + '</td>';
                    tbody += '<td>' + groups[i].groupType + '</td>';
                    tbody += '<td>' + groups[i].welcomeMessage + '</td></tr>';
                
                document.getElementById('inputForm').innerHTML = tableData;
                document.getElementById('tbody').innerHTML = tbody;
                }
           }
           
           function showGroup(){

           }
            document.getElementById('form').addEventListener("submit",submitPin);
