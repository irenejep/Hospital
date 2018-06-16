@extends("layouts.master")

@section("content")
    <div id="inputForm">
        <form class="form-horizontal" action="#" method="POST" name="lessons">
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
                <input class='form-control' type="text" name="patientDob"/>
            </div>
            <div class="inputItems">
                    
                <input class='form-control' type="text" name="patientGender"/>
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
            function displayPatients(jsonResponse)
            {
                var responseObj = JSON.parse(jsonResponse);
                var tData, count = 0;
                var tableData ="<button class='btn btn-primary' type='button' onclick='showInputForm()'> Add Patient</button><table class='table table-bordered table-striped table-condensed'><tr><th>#</th><th>Name</th><th>Description</th><th colspan='3'>Action</th></tr>"
                for(tData in responseObj){
                    count++;
                    tableData +="<tr><td>" + count +"</td>";
                    tableData +="<td>" + responseObj[tData].patient_fullName +"</td>";
                    tableData +="<td>" + responseObj[tData].patient_national_id +"</td>";
                    tableData +="<td>" + responseObj[tData].patient_dob +"</td>";
                    tableData +="<td>" + responseObj[tData].patient_gender +"</td>";
                    tableData +="<td><a class='btn btn-info' href='#'>View</a></td>";
                    tableData +="<td><a class='btn btn-success' href='#'>Edit</a></td>";
                    tableData +="<td><a class='btn btn-danger' href='#'>Delete</a></td></tr>";
                }
                    tableData +="</table>"
                    document.getElementById("allPatients").innerHTML = tableData;
            }
            function getPatients()
            {
                createObject(displayPatients, method[1], baseUrl + "patients");
                document.getElementById("allLessons").style.display="block"; 
                document.getElementById("inputForm").style.display="none";
            }
            
            function showInputForm(){
                document.getElementById("inputForm").style.display="block";
                document.getElementById("allLessons").style.display="none";
            }
        </script>

@endsection