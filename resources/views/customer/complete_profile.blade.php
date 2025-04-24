<!DOCTYPE html>
<html lang="en">

<head>
  <title>Customer - PseudoTeam</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('css/customer/layout.css') }}">
  <link rel="stylesheet" href="{{ asset('css/customer/reports.css') }}">
  <link rel="stylesheet" href="{{ asset('css/customer/project_upload.css') }}">
  <link rel="stylesheet" href="{{ asset('css/customer/complete_profile.css') }}">
</head>

<body>

  <!-- Navbar -->
  <div class="header">
    <!-- Left Section - Logo -->
    <div class="left-section border px-4 py-4" style="background-color: white;">
      <a href="/">
        <img src="http://127.0.0.1:8000/images/logopt.png" class="logo" alt="Logo">
      </a>
    </div>

    <!-- Right Section - Logout Button -->
    <a type="button" class="btn btn-outline-danger position-relative mx-4 my-4" style="float: right;  border: 1px solid #ccc;">
      Logout <i class="fa fa-sign-out"></i>
    </a>
  </div>

  <!-- Profile Section -->
  <div class="container">
    <p>
      <span class="fs-1 fw-bold">Hi, {{ session('pown_name') }}</span><br><br>
      <span class="fs-4 " style="color: black;"> Please complete your Profile</span>
    </p>
  </div>

  <!-- Profile Form -->
  <div class="container mt-3">
    <div class="card" id="card-one">
      <div class="card-body">
        <fieldset class="active">
          <div class="form-group">
            <label>Country</label>
            <select class="form-control form-select" id="country" onchange="populateCities();" required>
              <option value="" disabled selected>--Select Country--</option>
              <option value="India">India</option>
            </select>
          </div>
          <div class="form-group">
            <label>City</label>
            <select class="form-control form-select" id="city" required>
              <option value="" disabled selected>--Select City--</option>
            </select>
          </div>
          <div class="form-group">
            <label>Piwwncode</label>
            <input class="form-control" id="pincode" type="text" placeholder="Area Pincode" required>
          </div>
          <div class="form-group">
            <label>Mailing Address</label>
            <textarea class="form-control" id="address" rows="3" placeholder="Your address" required></textarea>
          </div>
          <div class="btn-group  w-25 mx-auto">
            <button class="btn btn-primary fw-bold" type="button" onclick="nextStep()">Next</button>
          </div>
        </fieldset>
      </div>
    </div>

    <div class="card" id="card-two" style="display: none;">
      <div class="card-body">
        <div class="form-group">
          <label>You are an</label>
          <div class="switch-field">
            <input type="radio" id="radio-one" name="type" value="Organization" checked>
            <label for="radio-one">Organization</label>
            <input type="radio" id="radio-two" name="type" value="Individual">
            <label for="radio-two">Individual</label>
          </div>
        </div>
        <div class="form-group">
          <label for="about">About</label>
          <textarea class="form-control" id="about" required autocomplete="off" placeholder="Please describe about your work" name="about" rows="3"></textarea>
        </div>
        <div id="organizationFields">
          <div class="form-group">
            <label for="cin">CIN</label>
            <input class="form-control" id="cin" type="text" placeholder="Enter CIN">
          </div>
          <div class="form-group">
            <label for="gst">GST Number</label>
            <input class="form-control" id="gst" type="text" placeholder="Enter GST Number">
          </div>
        </div>
        <div id="individualFields" style="display: none;">
          <div class="form-group">
            <label>Any Government ID</label>
            <input class="form-control" id="govtID" type="file" accept="image/*">
          </div>
        </div>
        <div class="btn-group">
          <button class="btn btn-secondary mx-2 fw-bold" type="button" onclick="prevStep()">Prev</button>
          <button class="btn btn-primary mx-2 fw-bold" type="button" onclick="submitForm()">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    let step = 1;

    function nextStep() {
      document.getElementById('card-one').style.display = 'none';
      document.getElementById('card-two').style.display = 'block';
      step = 2;
    }

    function prevStep() {
      document.getElementById('card-one').style.display = 'block';
      document.getElementById('card-two').style.display = 'none';
      step = 1;
    }

    function populateCities() {
      const country = document.getElementById('country').value;
      const city = document.getElementById('city');
      city.innerHTML = country === 'India' ?
        `<option value="Delhi">Delhi</option><option value="Mumbai">Mumbai</option><option value="Kolkata">Kolkata</option>` :
        `<option value="" disabled selected>--Select City--</option>`;
    }

    document.querySelectorAll('input[name="type"]').forEach(radio => {
      radio.addEventListener('change', function() {
        document.getElementById('organizationFields').style.display = this.value === 'Organization' ? 'block' : 'none';
        document.getElementById('individualFields').style.display = this.value === 'Individual' ? 'block' : 'none';
      });
    });

    function submitForm() {
      const requiredFields = [
        document.getElementById('country'),
        document.getElementById('city'),
        document.getElementById('pincode'),
        document.getElementById('address'),
        document.getElementById('about'),
      ];

      if (document.getElementById('radio-two').checked) {
        requiredFields.push(document.getElementById('govtID'));
      } else {
        requiredFields.push(document.getElementById('cin'), document.getElementById('gst'));
      }

      const isFormValid = requiredFields.every(field => field.value.trim() !== '');

      if (isFormValid) {
        alert('Form submitted successfully!');
        // Submit form logic here
      } else {
        alert('Please fill all required fields.');
      }
    }
  </script>
</body>

</html>