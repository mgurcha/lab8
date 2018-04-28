<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <script>
        
            function validateForm() {
                if($("#pwd").val() == $("#pwd2").val()){
                    $("#pwdMSG").html("");
                } else {
                    $("#pwdMSG").html("Passwords do not match!");
                }
                return false;
           
            }
            
        </script>
        
        <script>
            $(document).ready(  function(){
                
                $("#username").change(function()
                {
                    $.ajax({
                        type: "GET",
                        url: "checkUsername.php",
                        dataType: "json",
                        data: { "username": $("#username").val() },
                        success: function(data,status) {
                        

                            if (!data) {  //data == false
                                
                                // alert("Username is AVAILABLE!");
                                $("#userMSG").html("Username is available!");
                                $("#userMSG").css("color", "green");
                                
                            } else {
                                
                                // alert("Username ALREADY TAKEN!");
                                $("#userMSG").html("Username is NOT available!");
                                $("#userMSG").css("color", "red");
                                
                            }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                    
                });
                
                 $("#zipCode").change( function(){ 
                    //  alert($("#zipCode").val() ); } );
                    $.ajax({
                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
                        dataType: "json",
                        data: { "zip": $("#zipCode").val() },
                        success: function(data,status) {
                            
                        
                            //alert(data);
                            if(!data){
                                $("#zipMSG").html("Zip-Code not found!");
                                $("#zipMSG").css("color", "red");
                                $("#city").html("");
                                $("#latitude").html("");
                                $("#longitude").html("");
                            }
                            else
                            {
                                $("#zipMSG").html("");
                                $("#city").html(data.city);
                                $("#latitude").html(data.latitude);
                                $("#longitude").html(data.longitude);
                            }
                            
                            
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                 });
                 
                 $("#state").change( function(){
                    //  alert($("#state").val() ); } );
                   $.ajax({
                       
                       type:"GET",
                       url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
                       dataType: "json",
                       data: { "state": $("#state").val() },
                       success: function(data,status){
                        
                            // alert(data[0].county); 
                            $("#county").html("<option> - Select One - </option>");
                            for(var i=0; i<data.length; i++)
                            {
                              $("#county").append("<option>" + data[i].county + "</option>"); 
                            }
                        
                       },
                       complete: function(data,success){
                           
                       }
                   }); 
                    
                });
            
                
            }); //documentReady
            
        </script>


    </head>

    <body id="body">
    
       <h1 id="title"> Sign Up Form </h1>
        <div id="container">
        <form onsubmit="return validateForm()">
            <fieldset>
               <!--<legend>Sign Up</legend>-->
               <h3> Sign Up </h3>
               <hr id="line">
               <div id="inside">
                First Name:  <input class="form-control" type="text"><br> 
                Last Name:   <input class="form-control" type="text"><br> 
                Email:       <input class="form-control" type="text"><br> 
                Phone Number:<input class="form-control" type="text"><br><br>
                Zip Code:    <input class="form-control" type="text" id="zipCode">
                            <span id="zipMSG"></span>
                                                <br>
                City:        <span id="city"></span>
                <br>
                Latitude:    <span id="latitude"></span>
                <br>
                Longitude:   <span id="longitude"></span>
                <br><br>
                State: 
                <select class="form-control" id="state">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />
                
                Select a County: <select class="form-control" id="county"></select><br>
                
                Desired Username: <input class="form-control" type="text" id="username">
                                <span class="error" id="userMSG"></span>
                                <br>
                Password: <input type="password" id="pwd"><br><br>
                
                Type Password Again: <input type="password" id="pwd2"><br>
                    <span class="error" id="pwdMSG" style="color:red"></span><br>
                    <!--<span id="pwdMSG"></span><br>-->
                    
                
                </div>
                <input type="submit" value="Sign up!">
            </fieldset>
        </form>
    </div>
    </body>
</html>