@extends("layouts.master")

@section("content")
    <div id="inputForm">
        <form class="form-horizontal" action="#" method="POST"id="savePatient" name="patients">
            <div class="inputItems">
            <input class= "form-control" type="hidden" name="lessonId" required>
            </div>
            <div class="inputItems">
                <label>Patient's Name:</label>
                <input class='form-control' type="text" name="patientFullName"/>
            </div>
            <div class="inputItems">
                <label>ID Number:</label>
                <input class='form-control' type="text" name="patientNationalId"/>
            </div>
            <div class="inputItems">
                <label>Date of birth:</label>
                <input class='form-control' type="text" name="patientDob"/>
            </div>
            <div class="inputItems">
                <label>Gender:</label>
                <input class='form-control' name="patientGender"/>
                <SELECT>
                <OPTION Value="1">Male</OPTION>
                <OPTION Value="2">Female</OPTION>
                <OPTION Value="3">Other</OPTION>
                </SELECT>         
            </div>
            <div class="inputButtons">
                <button class='btn btn-warning'type="button">Cancel</button>
                <button class='btn btn-primary'type="submit">Save Patient</button>
            </div>
        </form>
    </div>
    <div id="allPatients"></div>
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
            function displayPatients(jsonResponse){
                var responseObj = JSON.parse(jsonResponse);
                var tableData = " ";
                
                tableData += "<button class = 'btn btn-primary' type='button' onclick= 'showInputForm()'>Add Patient</button><table class='table table-bordered table-striped table-condensed'><tr><th>id</th><th>Name</th><th>Description</th><th>Date of Birth</th><th>Gender</th><th colspan='4' align='center'>Actions</th></tr>";

                for (x in responseObj){
                tableData +="<tr><td>" + responseObj[x].patientId + "</td>";
                tableData +="<td>" + responseObj[x].patientFullName + "</td>";
                tableData +="<td>" + responseObj[x].patientNationalId + "</td>";
                tableData +="<td>" + responseObj[x].patientDob + "</td>";
                if(responseObj[x].patientGender == 1){
                tableData +="<td>" + "Male" + "</td>";
                }
                else if(responseObj[x].patientGender == 2){
                tableData +="<td>" + "Female" + "</td>";
                }
                tableData +="<td><a href='#' class='btn btn-info btn-sm' onclick= 'getSingleLesson(" + responseObj[x].id + ")'>View</a></td>";
                tableData +="<td><a href='#' class= 'btn btn-success btn-sm' onclick='updateSingleLesson(" + responseObj[x].id + ",\"" + responseObj[x].name + "\",\"" + responseObj[x].description + "\")'>Edit</a></td>";
                tableData +="<td><a href='#' class= 'btn btn-danger btn-sm'onclick='deleteSingleLesson(" + responseObj[x].id + ",\"" + responseObj[x].name + "\")'>Delete</a></td>";
                } 
                "</table>";
                document.getElementById("allPatients").innerHTML = tableData;

            }
            function getPatients()
            {
                createObject(displayPatients, method[1], baseUrl + "/getPatients");
                document.getElementById("allPatients").style.display="block"; 
                document.getElementById("inputForm").style.display="none";
            }
            function showInputForm(){
                document.getElementById("inputForm").style.display="block";
                document.getElementById("allPatients").style.display="none";
            }
            function submitLesson(e)
            {
                e.preventDefault();
                //get values submitted
                var patientFullName = document.forms["patients"]["patientFullName"].value;
                var patientNationalId = document.forms["patients"]["patientNationalId"].value;
                var patientDob = document.forms["patients"]["patientDob"].value;
                var patientGender = document.forms["patients"]["patientGender"].value;
                    //validate values
                if((patientFullName !="") && (patientNationalId !="") && (patientDob !="") && (patientGender !=""))
                {
                    var sendData = "patientFullName="+patientFullName+"&patientNationalId="
                    +patientNationalId+"patientDob="+patientDob+"patientGender="+patientGender+;
                    createObject(getPatients, method[0], baseUrl + "savePatient", sendData);
                    console.log(JSON.stringify(sendData));
                }
                else{
                    alert("invalid input");
                }
            }
            document.getElementById("savePatient").addEventListener("submit", submitPatient);
        </script>

@endsection