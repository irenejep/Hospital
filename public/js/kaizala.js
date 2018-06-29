            var method = ["POST", "GET"];
            var baseUrl = "https://api.kaiza.la";
            function createObject(readyStateFunction, requestMethod, requestUrl,sendData = null)
            {
                var obj = new XMLHttpRequest();
                obj.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                    readyStateFunction(this.responseText);
                    }
                };
                obj.open(requestMethod, requestUrl, true);
                if(requestMethod == 'POST'){
                    obj.setRequestHeader("Content-type", "application/json");
                    obj.setRequestHeader("X-CSRF-Token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    obj.send(sendData);
                }
                else{
                    obj.send();
                }
            }
            function generatePin(applicationId,applicationPhone){
                var sendData = '{"mobileNumber":"'+applicationPhone+'", applicationId:"'+applicationId+'"}';
                // console.log(sendData);
                createObject(generateRefreshToken, method[0], baseUrl + "/v1/generatePin", sendData);
            }
            function generateRefreshToken(e){
                e.preventDefault();
                var pin=document.forms['inputform']['applicationId'].value;
                var application_id=document.forms['inputform']['applicationId'].value;
                var applicationPhone= document.forms['inputform']['applicationPhone'].value;
                var applicationSecret=document.forms['inputform']['applicationSecret'].value;
                var sendData='{"mobileNumber":"'+applicationPhone+'","applicationId":"'+application_id+'","applicationSecret":"'+applicationSecret+'", "pin":"'+pin+'"}';
                createObject(getLoggedInUser, method[0], baseUrl + "/v1/loginWithPinAndApplicationId", sendData);
                if((applicationPhone !="") && (application_id !="") && (applicationSecret !="") && (pin !=""))
                {
                    createObject(getLoggedInUser, method[0], baseUrl + "/v1/loginWithPinAndApplicationId", sendData);
                }
                else{

                }
            }
            function getLoggedInUser(){
                
            }
            document.getElementById('form').addEventListener("submit",generateRefreshToken);
