@extends("layouts.master")

@section("content")
    <div id="inputForm">
        <form class="form-horizontal" action="#" method="POST"id="savePatient" name="patients">
        @csrf
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
                <input class='form-control' type="date" name="patientDob"/>
            </div>
            <div class="inputItems">
                Gender:
                <SELECT class='form-control'name="patientGender">
                <OPTION Value="1">Male</OPTION>
                <OPTION Value="2">Female</OPTION>
                </SELECT>         
            </div>
            <div class="inputButtons">
                <button class='btn btn-warning'type="button"onclick='getPatients()'>Cancel</button>
                <button class='btn btn-primary'type="submit">Save Patient</button>
            </div>
        </form>
    </div>
    <div id="updateForm">
        <form class='form-horizontal' action="#" method="POST" id="updateForm1" name="upForm">
        @csrf
            <input class= "form-control" type="hidden" name="patientId" required>
                <label>Patient's Name:</label>
                <input class='form-control' type="text" id="patientFullName" />
                <label>ID Number:</label>
                <input class='form-control' type="text" name="patientNationalId"/>
                <label>Date of birth:</label>
                <input class='form-control' type="date" name="patientDob"/>
                Gender:
                <SELECT class='form-control'name="patientGender">
                <OPTION Value="1">Male</OPTION>
                <OPTION Value="2">Female</OPTION>
                </SELECT>         
            <button class='btn btn-info' type="submit">Update</button>
            <button class='btn btn-warning'type="button" onclick="hideInputForm()">Cancel</button>
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
                
                tableData += "<button class = 'btn btn-primary' type='button' onclick= 'showInputForm()'>Add Patient</button><table class='table table-bordered table-striped table-condensed'><tr><th>id</th><th>Patient's name</th><th>ID Number</th><th>Date of Birth</th><th>Gender</th><th colspan='4' align='center'>Actions</th></tr>";

                for (x in responseObj){
                tableData +="<tr><td>" + responseObj[x].patient_id + "</td>";
                tableData +="<td>" + responseObj[x].patient_fullname + "</td>";
                tableData +="<td>" + responseObj[x].patient_national_id + "</td>";
                tableData +="<td>" + responseObj[x].patient_dob + "</td>";
                if(responseObj[x].patient_gender == 1){
                tableData +="<td>" + "Male" + "</td>";
                }
                else if(responseObj[x].patient_gender == 2){
                tableData +="<td>" + "Female" + "</td>";
                }
                tableData +="<td><a href='#' class='btn btn-info btn-sm' onclick= 'showPatient(" + responseObj[x].patient_id + ")'>View</a></td>";
                tableData +="<td><a href='#' class= 'btn btn-success btn-sm' onclick='editPatient("+ responseObj[x].patient_id +",\""+ responseObj[x].patient_fullname +"\",\""+ responseObj[x].patient_national_id +"\",\""+ responseObj[x].patient_dob +"\",\""+ responseObj[x].patient_gender+
                "\")'>Edit</a></td>";
                tableData +="<td><a href='#' class= 'btn btn-danger btn-sm'onclick='deletePatient(" + responseObj[x].patient_id + ",\"" + responseObj[x].patient_fullname + "\")'>Delete</a></td>";
                } 
                "</table>";
                document.getElementById("allPatients").innerHTML = tableData;

            }
            function getPatients()
            {
                createObject(displayPatients, method[1], baseUrl + "/getPatients");
                document.getElementById("allPatients").style.display="block"; 
                document.getElementById("inputForm").style.display="none";
                document.getElementById("updateForm").style.display="none";

            }
            function showInputForm(){
                document.getElementById("inputForm").style.display="block";
                document.getElementById("allPatients").style.display="none";
            }
            function hideInputForm(){
                document.getElementById("inputForm").style.display="none";
                document.getElementById("allPatients").style.display="block";
                document.getElementById("updateForm").style.display="none";
            }
            function showPatient(patient_id){
                createObject(displaySinglePatient, method[1], baseUrl + "getSinglePatient/" + patient_id);
            }
            function submitPatient(e)
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
                    var sendData = "patient_fullname="+patientFullName+"&patient_national_id="+patientNationalId+"&patient_dob="+patientDob+"&patient_gender="+patientGender;
                    console.log(sendData);
                    createObject(getPatients, method[0], baseUrl + "savePatient", sendData);
                    // console.log(JSON.stringify(sendData));
                }
                else{
                    alert("invalid input");
                }
            }
            function displaySinglePatient(jsonResponse)
        {
            var responseObj = JSON.parse(jsonResponse);
            var tData, count = 0;
            var tableData ="<table class='table'><tr><th>Patient's name</th><th>ID Number</th><th>Date of Birth</th><th>Gender</th></tr>";
            tableData +="<tr><td>" + responseObj.patient_fullname +"</td>";
            tableData +="<td>" + responseObj.patient_national_id +"</td>";
            tableData +="<td>" + responseObj.patient_dob +"</td>";
            if(responseObj.patient_gender == 1){
                tableData +="<td>" + "Male" + "</td>";
            }
            else if(responseObj.patient_gender == 2){
                tableData +="<td>" + "Female" + "</td>";
            }
            tableData +="<button class='btn btn-warning'type='button' onclick='getPatients()'>Back</button>";
            document.getElementById("allPatients").innerHTML = tableData;
         tableData +="</table>"
        }
        function editPatient(patient_id, patient_fullname, patient_national_id,patient_dob,patient_gender){
            document.getElementById("allPatients").style.display="none";
            document.getElementById("updateForm").style.display="block";
            document.forms["upForm"]["patientId"].value = patient_id;
            document.getElementById('patientFullName').value = patient_fullname;
            document.forms["upForm"]["patientNationalId"].value = patient_national_id;
            document.forms["upForm"]["patientDob"].value = patient_dob;
            document.forms["upForm"]["patientGender"].value = patient_gender;
        }
        function updatePatient(e){
            e.preventDefault();
            var patientId = document.forms["upForm"]["patientId"].value;
            var patientFullname = document.getElementById('patientFullName').value;
            var patientNationalId = document.forms["upForm"]["patientNationalId"].value;
            var patientDob = document.forms["upForm"]["patientDob"].value;
            var patientGender= document.forms["upForm"]["patientGender"].value;
            var sendData = "patient_gender="+patientGender+"&patient_dob="+patientDob+"&patient_fullname="+patientFullname+"&patient_national_id="+patientNationalId+"&patient_id="+patientId;
            console.log(sendData);
            createObject(getPatients, method[0], baseUrl + "updatePatient", sendData);
        }
        function deletePatient(patient_id, patient_name){
            var txt;
            if (confirm("Are you sure you want to delete" +" "+patient_name +"?")) {
            txt = "You pressed OK!";
            createObject(getPatients, method[1], baseUrl + "deletePatient/" + patient_id)
            alert("you have deleted"+patient_name);
             }
            else {
                txt = "You pressed Cancel!";
            } 
        }
            document.getElementById("savePatient").addEventListener("submit", submitPatient);
            document.getElementById("updateForm1").addEventListener("submit", updatePatient);
        </script>

@endsection