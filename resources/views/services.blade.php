@extends("layouts.master")
<body onload="getServices()">
@section("content")
    <div id="inputForm">
        <form class="form-horizontal" action="#" method="POST"id="saveService" name="services">
        @csrf
            <div class="inputItems">
            <input class= "form-control" type="hidden" name="serviceId" required>
            </div>
            <div class="inputItems">
                <label>Service Name:</label>
                <input class='form-control' type="text" name="serviceName"/>
            </div>
            <div class="inputItems">
                <label>Amount:</label>
                <input class='form-control' type="text" name="serviceAmount"/>
            </div>
            <div class="inputButtons">
                <button class='btn btn-warning'type="button"onclick='getServices()'>Cancel</button>
                <button class='btn btn-primary'type="submit">Save Service </button>
            </div>
        </form>
    </div>

    <div id="updateForm">
        <form class='form-horizontal' action="#" method="POST" id="updateForm1" name="upForm">
        @csrf
            <input class= "form-control" type="hidden" name="serviceId" required>
            <label>Service Name:</label>
            <input class='form-control' type="text" id="serviceName"/>
            <label>Amount:</label>
            <input class='form-control' type="text" name="serviceAmount"/>   
            <button class='btn btn-info' type="submit">Update</button>
            <button class='btn btn-warning'type="button" onclick="hideInputForm()">Cancel</button>
        </form>
    </div>

    <div id="allServices"></div>

        <script type ="text/javascript">
            var method = ["POST", "GET"];
            var baseUrl = "http://localhost:8000/"
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
                    obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    obj.setRequestHeader("X-CSRF-Token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    obj.send(sendData);
                }
                else{
                    obj.send();
                }
            }
         
            function displayServices(jsonResponse){
                var responseObj = JSON.parse(jsonResponse);
                var tableData = " ";
                tableData += "<button class = 'btn btn-primary' type='button' onclick= 'showInputForm()'>Add Service</button><table class='table table-bordered table-striped table-condensed'><tr><th>id</th><th>Service name</th><th>Amount</th><th colspan='4' align='center'>Action</th></tr>";
                for (x in responseObj){
                tableData +="<tr><td>" + responseObj[x].service_id + "</td>";
                tableData +="<td>" + responseObj[x].service_name + "</td>";
                tableData +="<td>" + responseObj[x].service_amount + "</td>";
                
                tableData +="<td><a href='#' class='btn btn-info btn-sm' onclick= 'showService(" + responseObj[x].service_id + ")'>View</a></td>";
                tableData +="<td><a href='#' class= 'btn btn-success btn-sm' onclick='editService("+ responseObj[x].service_id +",\""+ responseObj[x].service_name +"\",\""+ responseObj[x].visit_amount +"\")'>Edit</a></td>";
                tableData +="<td><a href='#' class= 'btn btn-danger btn-sm'onclick='deleteService(" + responseObj[x].service_id + ",\"" + responseObj[x].service_name + "\")'>Delete</a></td>";
            }
             
                "</table>";
                document.getElementById("allServices").innerHTML = tableData;
            }
            function getServices()
            {
                createObject(displayServices, method[1], baseUrl + "getServices");
                document.getElementById("allServices").style.display="block"; 
                document.getElementById("inputForm").style.display="none";
                document.getElementById("updateForm").style.display="none";
            }

            function showInputForm(){
                document.getElementById("inputForm").style.display="block";
                document.getElementById("allServices").style.display="none";
            }

            function hideInputForm(){
                document.getElementById("inputForm").style.display="none";
                document.getElementById("allServices").style.display="block";
                document.getElementById("updateForm").style.display="none";
            }

            function showService(service_id){
                createObject(displaySingleService, method[1], baseUrl + "getSingleService/" + service_id);
            }

            function submitService(e)
            {
                e.preventDefault();
                //get values submitted
                var serviceName = document.forms["services"]["serviceName"].value;
                var serviceAmount = document.forms["services"]["serviceAmount"].value;
                    //validate values
                if((serviceName !="") && (serviceAmount !=""))
                {
                    var sendData = "service_name="+serviceName+"&service_amount="+serviceAmount;
                    console.log(sendData);
                    createObject(getServices, method[0], baseUrl + "saveService", sendData);
                    // console.log(JSON.stringify(sendData));
                }
                else{
                    alert("invalid input");
                }
            }
            
            function displaySingleService(jsonResponse) {
                var responseObj = JSON.parse(jsonResponse);
                var tData, count = 0;
                var tableData ="<table class='table'><tr><th>Service name</th><th>Amount</th></tr>";
                tableData +="<tr><td>" + responseObj.service_name +"</td>";
                tableData +="<td>" + responseObj.service_amount +"</td>";
                tableData +="<button class='btn btn-warning'type='button' onclick='getServices()'>Back</button>";
                document.getElementById("allServices").innerHTML = tableData;
                tableData +="</table>"
            }

            function editService(service_id, service_name){
                document.getElementById("allServices").style.display="none";
                document.getElementById("updateForm").style.display="block";
                document.forms["upForm"]["serviceId"].value = service_id;
                document.getElementById('serviceName').value = service_name;
            }

            function updateService(e){
                e.preventDefault();
                var serviceId = document.forms["upForm"]["serviceId"].value;
                var serviceName = document.getElementById('serviceName').value;
                var serviceAmount = document.forms["upForm"]["serviceAmount"].value;
                var sendData = "service_name="+serviceName+"&service_amount="+serviceAmount+"&service_id="+serviceId;
                console.log(sendData);
                createObject(getServices, method[0], baseUrl + "updateService", sendData);
            }

            function deleteService(service_id, service_name){
                var txt;
                if (confirm("Are you sure you want to delete" +" "+service_name +"?")) {
                txt = "You pressed OK!";
                createObject(getServices, method[1], baseUrl + "deleteService/" + service_id)
                alert("you have deleted"+service_name);
                }
                else {
                    txt = "You pressed Cancel!";
                } 
            }
            document.getElementById("saveService").addEventListener("submit", submitService);
            document.getElementById("updateForm1").addEventListener("submit", updateService);
        </script>
        </body>
@endsection
