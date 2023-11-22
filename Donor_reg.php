<?php 
include("config.php"); 
//include("functions.php"); 

error_reporting(0);?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("head.php");?>
</head>
<body>

<?php
include("top_nav.php");
?>
    <div class="container" style='margin-top:70px;'>
        <div class="row">
            <div class="col-md-12">
                <h3 class=" text-primary">
					<i class='fa fa-users'></i> New Donor Registration
                </h3><hr>
						<?php  include("blood_bread.php"); ?>

            </div>
        </div>
<div class="row centered-form ">
<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
<?php
if(isset($_POST["submit"]))
{															
$target_dir = "donor_image/";
$img="donor_image/noimage.jpg";
$target_file = $target_dir.rand(100,999). basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "";
        $uploadOk = 1;
    } else {
      //  echo "File is not an image.";
        $uploadOk = 0;
    }
// Check if file already exists
if (file_exists($target_file)) {
   // echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000000) {
   // echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
   // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $img=$target_file;
    } else {
     //   echo "Sorry, there was an error uploading your file.";
    }

$country="";
$state="";
}
$qry="SELECT COUNTRY_NAME FROM country WHERE COUNTRY_ID={$_POST["COUNTRY"]}";
$res=$con->query($qry);
if($res->num_rows>0)
{
	if($row=$res->fetch_assoc())
	{
		$country=$row["COUNTRY_NAME"];
	}
}

$qry="SELECT STATE_NAME FROM state WHERE STATE_ID={$_POST["STATE"]}";
$res=$con->query($qry);
if($res->num_rows>0)
{
	if($row=$res->fetch_assoc())
	{
		$state=$row["STATE_NAME"];
	}
}
$cityname=$_POST["CITY"];
$sql="
INSERT INTO blood_donor 
(NAME,FATHER_NAME, GENDER, DOB, BLOOD, BODY_WEIGHT, EMAIL, ADDRESS, AREA, CITY, STATE, CONTACT_1, VOLUNTARY, VOLUNTARY_GROUP,NEW_DONOR, LAST_D_DATE, DONOR_PIC,COUNTRY)
 VALUES 
 ('{$_POST["NAME"]}', '{$_POST["FATHER_NAME"]}', '{$_POST["GENDER"]}', '{$_POST["DOB"]}', '{$_POST["BLOOD"]}', '{$_POST["BODY_WEIGHT"]}', '{$_POST["EMAIL"]}', '{$_POST["ADDRESS"]}', '{$_POST["AREA"]}', '$cityname', '{$state}', '{$_POST["CONTACT_1"]}', '{$_POST["VOLUNTARY"]}', '{$_POST["VOLUNTARY_GROUP"]}', '{$_POST["NEW_DONOR"]}','{$_POST["LAST_D_DATE"]}', '{$img}','{$country}');";
						if($con->query($sql))
							{
								echo '
								<div class="alert alert-success">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Success!</strong> Thank you for adding you as donor.
								</div>
								';
							}
					}
				?>
				<style>
					.error{
						color: red;
					}
				 </style>
    <script>

function validateForm() {
            var isValid = true;

            // Clear previous error messages
            var errorElements = document.getElementsByClassName('error');
            for (var i = 0; i < errorElements.length; i++) {
                errorElements[i].innerHTML = '';
            }

            // Retrieve form input values
            var name = document.getElementById('NAME').value;
            var gender = document.getElementById('gen').value;
            var dob = document.getElementById('DOB').value;
            var bloodGroup = document.getElementById('blood').value;
            var bodyWeight = document.getElementById('BODY_WEIGHT').value;
            var email = document.getElementById('EMAIL').value;
            var country = document.getElementById('COUNTRY').value;
            var state = document.getElementById('STATE').value;
            var city = document.getElementById('CITY').value;
            var area = document.getElementById('AREA').value;
            var address = document.getElementById('ADDRESS').value;
            var contact = document.getElementById('CONTACT_1').value;

            // Validate name
            if (name.trim() === '') {
                document.getElementById('name_error').innerHTML = 'Full Name is required';
                isValid = false;
            }

            // Validate gender
            if (gender === '') {
                document.getElementById('gender_error').innerHTML = 'Gender is required';
                isValid = false;
            }

            // Validate date of birth
            if (dob.trim() === '') {
                document.getElementById('dob_error').innerHTML = 'D.O.B is required';
                isValid = false;
            }

            // Validate blood group
            if (bloodGroup === '') {
                document.getElementById('blood_group_error').innerHTML = 'Blood Group is required';
                isValid = false;
            }

            // Validate body weight
            if (bodyWeight.trim() === '') {
                document.getElementById('body_weight_error').innerHTML = 'Body Weight is required';
                isValid = false;
            }

            // Validate email
            if (email.trim() === '') {
                document.getElementById('email_error').innerHTML = 'Email ID is required';
                isValid = false;
            }

            // Validate country
            if (country === '') {
                document.getElementById('country_error').innerHTML = 'Country is required';
                isValid = false;
            }

            // Validate state
            if (state === '') {
                document.getElementById('state_error').innerHTML = 'State is required';
                isValid = false;
            }

            // Validate city
            if (city === '') {
                document.getElementById('city_error').innerHTML = 'City is required';
                isValid = false;
            }

            // Validate area
            if (area.trim() === '') {
                document.getElementById('area_error').innerHTML = 'Area is required';
                isValid = false;
            }

            // Validate address
            if (address.trim() === '') {
                document.getElementById('address_error').innerHTML = 'Address is required';
                isValid = false;
            }

            // Validate contact
            if (contact.trim() === '') {
                document.getElementById('contact_error').innerHTML = 'Contact is required';
                isValid = false;
            }

            return isValid;
        }
    </script>
<div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center" style="padding:5px;font-size:16px;font-weight:bold"><span class="fa fa-user "> </span> JOIN AS BLOOD DONOR</h3>
                    </div>
					
                    <div class="panel-body">
						<form method="post" action="Donor_reg.php" autocomplete="off" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label text-primary" for="NAME">Full Name</label>
            <input type="text" placeholder="Full Name" id="NAME" name="NAME" required class="form-control input-sm">
            <span id="name_error" class="error"></span>
        </div>
       <div class="form-group">
            <label class="control-label text-primary" for="NAME">FATHER Name</label>
            <input type="text" placeholder="Father Name" id="NAME" name="Father Name" required class="form-control input-sm">
            <span id="name_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="control-label text-primary" for="GENDER">Gender</label>
            <select id="gen" name="GENDER" required class="form-control input-sm">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Others">Others</option>
            </select>
            <span id="gender_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="control-label text-primary" for="DOB">D.O.B</label>
            <input type="text" placeholder="YYYY/MM/DD" required id="DOB" name="DOB" class="form-control input-sm DATES">
            <span id="dob_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="control-label text-primary" for="BLOOD">Blood Group</label>
            <select id="blood" name="BLOOD" required class="form-control input-sm">
                <option value="">Select Blood</option>
                <option value="A+">A+</option>
                <option value="B+">B+</option>
                <option value="O+">O+</option>
                <option value="A-">A-</option>
                <option value="B-">B-</option>
                <option value="O-">O-</option>
                <option value="AB-">AB-</option>
            </select>
            <span id="blood_group_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="control-label text-primary" for="BODY_WEIGHT">Body Weight</label>
            <input type="text" placeholder="Weight In Kgs" required name="BODY_WEIGHT" id="BODY_WEIGHT" class="form-control input-sm">
            <span id="body_weight_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="control-label text-primary" for="EMAIL">Email ID</label>
            <input type="email" required name="EMAIL" id="EMAIL" class="form-control" placeholder="Email Address">
            <span id="email_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="control-label text-primary" for="COUNTRY">Country</label>
            <select name="COUNTRY" id="COUNTRY" required class="form-control">
                <option value="">Select Country</option>
              <option>Nepal</option>
              
                <!-- Country options -->
            </select>
            <span id="country_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="control-label text-primary" for="STATE">State</label>
            <select name="STATE" id="STATE" required class="form-control">
                <option value="">Select State</option>
                <!-- State options -->
            </select>
            <span id="state_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="control-label text-primary" for="CITY">City</label>
            <select name="CITY" id="CITY" required class="form-control">
                <option value="">Select City</option>
				</select>
            <span id="city_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="control-label text-primary" for="AREA">Area</label>
            <input type="text" required name="AREA" id="AREA" class="form-control" placeholder="Type your area">
            <span id="area_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="control-label text-primary" for="ADDRESS">Address</label>
            <textarea required name="ADDRESS" id="ADDRESS" rows="5" style="resize:none;" class="form-control" placeholder="Full Address"></textarea>
            <span id="address_error" class="error"></span>
        </div>
        <div class="form-group">
            <label class="control-label text-primary" for="CONTACT_1">Contact</label>
            <input type="text" required name="CONTACT_1" id="CONTACT_1" class="form-control" placeholder="Contact No">
            <span id="contact_error" class="error"></span>
        </div>
        <hr>
        <div class="form-group">
            <label class="control-label text-primary"><input type="checkbox" id="c1">&nbsp; Voluntary Donor</label>
        </div>
        <div id="volu">
            <div class="form-group">
                <select name="VOLUNTARY" id="VOLUNTARY" class="form-control input-sm">
                    <option value="">Select</option>
                    <option value="Yes">Yes</option>
                    <option selected value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="VOLUNTARY_GROUP" id="VOLUNTARY_GROUP" class="form-control" placeholder="Voluntary Group Name" value="Nill">
            </div>
            <div class="form-group">
                <label class="control-label text-primary" for="LAST_D_DATE">Last Blood Donated Date</label>
                <input type="text" name="LAST_D_DATE" value="0000/00/00" id="LAST_D_DATE" placeholder="YYYY/MM/DD" class="form-control input-sm DATES">

</div>
        </div>
        <hr>
        <div class="form-group" id="new">
            <label class="control-label text-primary" for="NEW_DONOR">New Donor</label>
            <select name="NEW_DONOR" id="NEW_DONOR" class="form-control input-sm">
                <option value="">Select</option>
                <option value="Yes">Yes</option>
                <option value="No" selected>No</option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label text-success" for="fileToUpload">Upload Photo</label>
            <input type="file" class="form-control" name="fileToUpload">
        </div>
        <div class="form-group">
            <label class="control-label text-success"><input type="checkbox" checked id="c2">&nbsp; I have read the eligibility criteria and confirm that I am eligible to donate blood.</label>
            <label class="control-label text-success"><input type="checkbox" checked id="c3">&nbsp; I agree to the Terms and Conditions and consent to have my contact and donor information published to potential blood recipients.</label>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit" name="submit" onclick="return validateForm()">Register Now</button>
        </div>
    </form>
                    </div>
                </div>
            </div>
			 
            
        </div>
        </div>    

 <?php include("footer.php"); ?>
 <script>
// JavaScript code for form validation
document.addEventListener('Donor_reg.php', function() {
  // Get form elements
  var form = document.querySelector('form');
  var nameInput = document.getElementById('NAME');
  var genderSelect = document.getElementById('gen');
  var dobInput = document.getElementById('DOB');
  var bloodSelect = document.getElementById('blood');
  var weightInput = document.getElementById('BODY_WEIGHT');
  var emailInput = document.getElementById('EMAIL');
  var countrySelect = document.getElementById('COUNTRY');
  var stateSelect = document.getElementById('STATE');
  var citySelect = document.getElementById('CITY');

  // Validate form on submit
  form.addEventListener('submit', function(event) {
    // Validate name field
    if (nameInput.value.trim() === '') {
      event.preventDefault();
      alert('Please enter your full name.');
      nameInput.focus();
      return false;
    }

    // Validate gender field
    if (genderSelect.value === '') {
      event.preventDefault();
      alert('Please select your gender.');
      genderSelect.focus();
      return false;
    }

    // Validate dob field
    if (dobInput.value.trim() === '') {
      event.preventDefault();
      alert('Please enter your date of birth.');
      dobInput.focus();
      return false;
    }

    // Validate blood group field
    if (bloodSelect.value === '') {
      event.preventDefault();
      alert('Please select your blood group.');
      bloodSelect.focus();
      return false;
    }

// Validate weight field
    if (weightInput.value.trim() === '') {
      event.preventDefault();
      alert('Please enter your body weight.');
      weightInput.focus();
      return false;
    }

    // Validate email field
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(emailInput.value)) {
      event.preventDefault();
      alert('Please enter a valid email address.');
      emailInput.focus();
      return false;
    }

    // Validate country field
    if (countrySelect.value === '') {
      event.preventDefault();
      alert('Please select your country.');
      countrySelect.focus();
      return false;
    }

    // Validate state field
    if (stateSelect.value === '') {
      event.preventDefault();
      alert('Please select your state.');
      stateSelect.focus();
      return false;
    }

    // Validate city field
    if (citySelect.value === '') {
      event.preventDefault();
      alert('Please select your city.');
      citySelect.focus();
      return false;
    }

    // Form is valid, allow submission
    return true;
  });
});

	$(document).ready(
				function(){
						$("#volu").hide();
						$("#c1").click(function(){
							if($("#c1").is(':checked'))
							{
								$("#volu").show(1000);
								$("#new").hide(100);
							}
							else
							{
								$("#volu").hide(1000);
								$("#new").show(100);
							}
						});
						
						/*
						$("#CITY").change(function(){
							var city=$("#CITY").val();
							//alert(city);
							$.post('functions.php',{G_CITY_ID:city},function(data){
							//	alert(data);
								$("#STATE").html(data);
							});
							
						});*/
						
						
						$("#COUNTRY").change(function(){
							var countr=$("#COUNTRY").val();
							//alert(city);
							$.post('get_state.php',{G_STATE_ID:countr},function(data){
							//	alert(data);
								$("#STATE").html(data);
							});
							
						});

$("#STATE").change(function(){
							var stid=$("#STATE").val();
							//alert(city);
							$.post('get_city.php',{G_STATE_ID:stid},function(data){
							//	alert(data);
								$("#CITY").html(data);
							});
							
						});
					
						
							
				});
	
	
  $(function() {
    var availableTags = [
      <?php 
	  $sql="SELECT AREA_NAME FROM area";
							$result=$con->query($sql);
							
							if($result->num_rows>0)
							{
								$i=0;
								$n=$result->num_rows;
								while($row=$result->fetch_assoc())
								{   
									$i++;
									if($n!=$i)
									{
										echo '"'.$row['AREA_NAME'].'",';
									}
									else
									{
										echo '"'.$row['AREA_NAME'].'"';
									}
								}
								
							}
	  
	  
	  ?>
    ];
    $( "#AREA" ).autocomplete({
      source: availableTags
    });
  });

 </script>
 
</body>
</html>