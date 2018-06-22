@extends("layouts.visitmaster")

@section("content")

    <div id="updateForm">
        <form class='form-horizontal' action="#" method="POST" id="updateForm1" name="upForm">
        @csrf
            <!-- <div class="inputItems">
                <input class= "form-control" type="hidden" name="patientId">
            </div> -->
            <div class="inputItems">
                <input class= "form-control" type="hidden" name="visitId">
            </div>
            <div class="inputItems">
                <label>Date of visit:</label>
                <input class='form-control' type="datetime" name="visitDate"/>
            </div>
            <div class="inputItems">
                Type of visit:
                <SELECT class='form-control'name="visitType">
                <OPTION Value="1">Insurance</OPTION>
                <OPTION Value="2">NHIF</OPTION>
                <OPTION Value="3">Cash</OPTION>
                </SELECT>         
            </div>
            <div class="inputItems">
                <label>Time of exit:</label>
                <input class='form-control' type="datetime" name="visitExitTime"/>
            </div>
            <div class="inputItems">
                Visit Status:
                <SELECT class='form-control'name="visitStatus">
                <OPTION Value="1">Done</OPTION>
                <OPTION Value="2">In process</OPTION>
                <OPTION Value="3">Admitted to ward</OPTION>
                </SELECT>         
            </div>       
            <button class='btn btn-info' type="submit">Update</button>
            <button class='btn btn-warning'type="button" onclick="getVisits()">Cancel</button>
        </form>
    </div>
    <div id="allVisits"></div>
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
            function displayVisits(jsonResponse){
                var responseObj = JSON.parse(jsonResponse);
                var tableData = " ";
                
                tableData += "<table class='table table-bordered table-striped table-condensed'><tr><th>id</th><th>Patient Id</th><th>Visit date</th><th>Visit type</th><th>Exit time</th><th>Visit status</th><th colspan='4' text-align='center'>Actions</th></tr>";

                for (x in responseObj){
                    tableData +="<tr><td>" + responseObj[x].visit_id + "</td>";
                    tableData +="<td>" + responseObj[x].patient_id + "</td>";
                    tableData +="<td>" + responseObj[x].visit_date + "</td>";
                    if(responseObj[x].visit_type == 1){
                        tableData +="<td>" + "Insurance" + "</td>";
                    }
                    else if(responseObj[x].visit_type == 2){
                        tableData +="<td>" + "NHIF" + "</td>";
                    }
                    else if(responseObj[x].visit_type == 3){
                    tableData +="<td>" + "Cash" + "</td>";
                    }
                    tableData +="<td>" + responseObj[x].visit_exit_time + "</td>";
                    if(responseObj[x].visit_status == 1){
                        tableData +="<td>" + "Done" + "</td>";
                    }
                    else if(responseObj[x].visit_status == 2){
                        tableData +="<td>" + "In process" + "</td>";
                    }
                    else if(responseObj[x].visit_status == 3){
                        tableData +="<td>" + "Admitted to ward" + "</td>";
                    }
                    // tableData +="<td><a href='#' class='btn btn-info btn-sm' onclick= 'showVisitInputForm(" + responseObj[x].patient_id + ")'>Create Visit</a></td>";
                    tableData +="<td><a href='#' class='btn btn-info btn-sm' onclick= 'showVisit(" + responseObj[x].visit_id + ")'>View</a></td>";
                    tableData +="<td><a href='#' class= 'btn btn-success btn-sm' onclick='editVisit("+ responseObj[x].visit_id +",\""+ responseObj[x].visit_date +"\",\""+ responseObj[x].visit_type +"\",\""+ responseObj[x].visit_exit_time +"\",\""+ responseObj[x].visit_status+
                    "\")'>Edit</a></td>";
                    tableData +="<td><a href='#' class= 'btn btn-danger btn-sm'onclick='deleteVisit(" + responseObj[x].visit_id + ",\"" + responseObj[x].visit_type+ "\")'>Delete</a></td>";
                } 
                "</table>";
                document.getElementById("allVisits").innerHTML = tableData;

            }
            function getVisits()
            {
                createObject(displayVisits, method[1], baseUrl + "/getVisits");
                document.getElementById("allVisits").style.display="block"; 
                // document.getElementById("inputForm").style.display="none";
                document.getElementById("updateForm").style.display="none";
                // document.getElementById("visitInputForm").style.display="none";
            }

            // function showInputForm(){
            //     document.getElementById("inputForm").style.display="block";
            //     document.getElementById("allVisits").style.display="none";
                // document.getElementById("visitInputForm").style.display="none";
            // }

            // function showVisitInputForm(patient_id){
            //     document.getElementById("visitInputForm").style.display="block";
            //     document.getElementById("inputForm").style.display="none";
            //     document.getElementById("allPatients").style.display="none";
            //     document.forms["visits"]["patientId"].value = patient_id;
            // }

            // function hideInputForm(){
            //     document.getElementById("inputForm").style.display="none";
            //     document.getElementById("visitInputForm").style.display="none";
            //     document.getElementById("allPatients").style.display="block";
            //     document.getElementById("updateForm").style.display="none";
            // }
            function showVisit(visit_id){
                document.getElementById("allVisits").style.display="block"; 
                document.getElementById("updateForm").style.display="none";
                createObject(displaySingleVisit, method[1], baseUrl + "getSingleVisit/" + visit_id);
            }
            
            function displaySingleVisit(jsonResponse)
            {
                var responseObj = JSON.parse(jsonResponse);
                var tData, count = 0;
                var tableData ="<table class='table table-bordered table-striped table-condensed'><tr><th>Id</th><th>Patient Id</th><th>Visit Date</th><th>Visit type</th><th>Exit time</th><th>Status</th></tr>";
                    tableData +="<tr><td>" + responseObj.visit_id + "</td>";
                    tableData +="<tr><td>" + responseObj.patient_id + "</td>";
                    tableData +="<td>" + responseObj.visit_date + "</td>";
                    if(responseObj.visit_type == 1){
                        tableData +="<td>" + "Insurance" + "</td>";
                    }
                    else if(responseObj.visit_type == 2){
                        tableData +="<td>" + "NHIF" + "</td>";
                    }
                    else if(responseObj.visit_type == 3){
                    tableData +="<td>" + "Cash" + "</td>";
                    }
                    tableData +="<td>" + responseObj.visit_exit_time + "</td>";
                    if(responseObj.visit_status == 1){
                        tableData +="<td>" + "Done" + "</td>";
                    }
                    else if(responseObj.visit_status == 2){
                        tableData +="<td>" + "In process" + "</td>";
                    }
                    else if(responseObj.visit_status == 3){
                        tableData +="<td>" + "Admitted to ward" + "</td>";
                    }
                tableData +="<button class='btn btn-warning'type='button' onclick='getVisits()'>Back</button>";
                document.getElementById("allVisits").innerHTML = tableData;
            tableData +="</table>"
            }       
            function editVisit(visit_id, visit_date, visit_type, visit_exit_time, visit_status){
                document.getElementById("allVisits").style.display="none";
                document.getElementById("updateForm").style.display="block";
                document.forms["upForm"]["visitId"].value = visit_id;
                document.forms["upForm"]["visitDate"].value = visit_date;
                document.forms["upForm"]["visitType"].value = visit_type;
                document.forms["upForm"]["visitExitTime"].value = visit_exit_time;
                document.forms["upForm"]["visitStatus"].value = visit_status;
            }
            function updateVisit(e){
                e.preventDefault();
                var visitId = document.forms["upForm"]["visitId"].value;
                var visitDate = document.forms["upForm"]["visitDate"].value;
                var visitType = document.forms["upForm"]["visitType"].value;
                var visitExitTime = document.forms["upForm"]["visitExitTime"].value;
                var visitStatus= document.forms["upForm"]["visitStatus"].value;
                var sendData = "visit_date="+visitDate+"&visit_type="+visitType+"&visit_exit_time="+visitExitTime+"&visit_status="+visitStatus+"&visit_id="+visitId;
                console.log(sendData);
                createObject(getVisits, method[0], baseUrl + "updateVisit", sendData);
            }
            function deleteVisit(visit_id, visit_type){
                var txt;
                if (confirm("Are you sure you want to delete" +" "+visit_type +"?")) {
                txt = "You pressed OK!";
                createObject(getVisits, method[1], baseUrl + "deleteVisit/" + visit_id)
                alert("you have deleted"+visit_type);
                }
                else {
                    txt = "You pressed Cancel!";
                } 
            }
            // function submitVisit(e)
            // {
            //     e.preventDefault();
            //     //get values submitted
            //     var patientId = document.forms["visits"]["patientId"].value;
            //     var visitDate = document.forms["visits"]["visitDate"].value;
            //     var visitType = document.forms["visits"]["visitType"].value;
            //     var visitExitTime = document.forms["visits"]["visitExitTime"].value;
            //     var visitStatus = document.forms["visits"]["visitStatus"].value;
            //         //validate values
            //     if((visitDate !="") && (visitType !="") && (visitExitTime !="") && (visitStatus !=""))
            //     {
            //         var sendData = "patient_id="+patientId+"&visit_date="+visitDate+"&visit_type="+visitType+"&visit_exit_time="+visitExitTime+"&visit_status="+visitStatus;
            //         console.log(sendData);
            //         createObject(getvisits, method[0], baseUrl + "saveVisit", sendData);
            //         // console.log(JSON.stringify(sendData));
            //     }
            //     else{
            //         alert("invalid input");
            //     }
            // }
            // document.getElementById("savePatient").addEventListener("submit", submitPatient);
            // document.getElementById("saveVisit").addEventListener("submit", submitVisit);
            document.getElementById("updateForm1").addEventListener("submit", updateVisit);
        </script>

@endsection