@extends('customer.base_layout')

@section('content')

<br>

<div class="container  " style="height: 100vh;">

  <div class="mb-4 ">
    <h2>Manage Account</h2>
  </div>
  <div class="row text-pseudo" style="height: 100%;">

    <!-- Left Section: Navigation -->
    <div class="col-lg-4 col-md-5 col-sm-12 mb-4" style="background-color: #f8f9fa; border-right: 1px solid #dee2e6; height: 100%; padding: 20px; overflow-y: auto;">
      <div class="list-group " style="height: 100%;">
        <button class="list-group-item list-group-item-action active " id="btn-profile" style="font-weight: bold;">
          Profile Picture
        </button>
        <button class="list-group-item list-group-item-action" id="btn-location" style="font-weight: bold;">
          Location
        </button>
        <button class="list-group-item list-group-item-action" id="btn-id" style="font-weight: bold;">
          CIN/Government ID
        </button>
        <button class="list-group-item list-group-item-action" id="btn-password" style="font-weight: bold;">
          Password
        </button>
      </div>
    </div>

    <!-- Right Section: Content Display -->
    <div class="col-lg-8 col-md-7 col-sm-12" style="height: 100%; padding: 20px; overflow-y: auto;">
      <!-- Profile Picture Section -->
      <div id="content-profile" class="content-section">
        <h4 class="mb-4 fw-bold">Profile Picture</h4>
        <div class="text-center">
          <img id="profilePreview" src="{{ asset('images/logo_icon.png') }}" class="img-thumbnail mb-3" alt="Profile Preview" style="width:20%;height:15%; border: 0;">
          <div class="d-flex justify-content-center align-items-center mb-3">
            <label for="profilePicture" class="me-2" style="font-weight: bold;">Upload DP</label>
            <input type="file" id="profilePicture" class="form-control" style="max-width: 300px;" accept="image/*">
          </div>
          <button id="submitButton" type="button" class="btn btn-primary mx-2 fw-bold" style="max-width: 150px;">Submit</button>
        </div>
      </div>


      <!-- Location Section -->
      <div id="content-location" class="content-section d-none">
        <h4 class="mb-4 fw-bold">Location</h4>
        <form id="locationForm">
          <div class="mb-3">
            <label for="country" class="form-label" style="font-weight: bold;">Country</label>
            <select class="form-control form-select" id="country" onchange="populateCities();" required>
              <option value="India" selected>India</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="city" class="form-label" style="font-weight: bold;">City</label>
            <select class="form-control form-select" id="city" required>
              <option value="Delhi">Delhi</option>
              <option value="Mumbai">Mumbai</option>
              <option value="Kolkata">Kolkata</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="pincode" class="form-label" style="font-weight: bold;">Pincode</label>
            <input type="text" id="pincode" class="form-control" placeholder="Enter your pincode" value="110034">
          </div>
          <div class="mb-3">
            <label for="mailingAddress" class="form-label" style="font-weight: bold;">Mailing Address</label>
            <textarea id="mailingAddress" class="form-control" rows="3" placeholder="Enter your address">206e</textarea>
          </div>
        </form>
        <div class="w-25 mx-auto">
          <button id="submitLocation" type="button" class="btn btn-primary mx-2 fw-bold" style="max-width: 150px;">Submit</button>
        </div>
      </div>


      <!-- CIN/Government ID Section -->
      <div id="content-id" class="content-section d-none">
        <h4 class="mb-4 fw-bold">CIN/Government ID</h4>
        <div class="card-body">
          <div class="form-group">
            <label style="font-weight: bold; margin-bottom: 10px;">You are an</label>
            <div class="switch-field" style="display: flex; justify-content: center; width: 100%; border-radius: 25px; overflow: hidden; position: relative; height: 40px;">
              <input type="radio" id="radio-one" name="type" value="Organization" checked style="position: absolute; clip: rect(0, 0, 0, 0); height: 1px; width: 1px; border: 0; overflow: hidden;">
              <label for="radio-one" style="background-color: #007bff; color: white; font-size: 16px; text-align: center; border: 1px solid #007bff; border-radius: 25px 0 0 25px; cursor: pointer; display: flex; justify-content: center; align-items: center; width: 100%; height: 100%; transition: background-color 0.3s, color 0.3s;">
                Organization
              </label>

              <input type="radio" id="radio-two" name="type" value="Individual" style="position: absolute; clip: rect(0, 0, 0, 0); height: 1px; width: 1px; border: 0; overflow: hidden;">
              <label for="radio-two" style="background-color: #fff; color: #007bff; font-size: 16px; text-align: center; border: 1px solid #007bff; border-radius: 0 25px 25px 0; cursor: pointer; display: flex; justify-content: center; align-items: center; width: 100%; height: 100%; transition: background-color 0.3s, color 0.3s;">
                Individual
              </label>
            </div>
          </div>

          <div class="form-group" style="margin-top: 20px;">
            <label for="about" style="font-weight: bold;">About</label>
            <textarea class="form-control" id="about" required autocomplete="off" placeholder="Please describe about your work" name="about" rows="3" style=" margin-top: 5px;"></textarea>
          </div>

          <!-- Organization Fields -->
          <div id="organizationFields" style="margin-top: 20px;">
            <div class="form-group" style="margin-top: 20px;">
              <label for="cin" style="font-weight: bold;">CIN</label>
              <input class="form-control" id="cin" type="text" placeholder="Enter CIN" style="margin-top: 5px;">
            </div>
            <div class="form-group" style="margin-top: 20px;">
              <label for="gst" style="font-weight: bold;">GST Number</label>
              <input class="form-control" id="gst" type="text" placeholder="Enter GST Number" style="margin-top: 5px;">
            </div>
          </div>

          <!-- Individual Fields -->
          <div id="individualFields" style="display: none; margin-top: 20px;">
            <div class="form-group">
              <label style="font-weight: bold;">Any Government ID</label>
              <input class="form-control" id="govtID" type="file" accept="image/*" style=" margin-top: 5px;">
            </div>
          </div>


        </div>
        <div class="w-25 mx-auto">
          <button class="btn btn-primary mx-2 fw-bold" type="button" onclick="submitForm()">Submit</button>
        </div>
      </div>
      <!-- Change Password Section -->
      <div id="content-password" class="content-section d-none">
        <h4 class="mb-4 fw-bold">Change Password</h4>
        <form id="changePasswordForm">
          <div class="mb-3">
            <label for="currentPassword" class="form-label" style="font-weight: bold;">Current Password</label>
            <input type="password" id="currentPassword" class="form-control" placeholder="Enter your current password" required>
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label" style="font-weight: bold;">New Password</label>
            <input type="password" id="newPassword" class="form-control" placeholder="Enter a new password" required>
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label" style="font-weight: bold;">Confirm Password</label>
            <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm your new password" required>
          </div>
          <div class="w-25 mx-auto">
            <button type="submit" class="btn btn-primary mx-2 fw-bold" style="max-width: 150px;">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.list-group-item');
    const sections = document.querySelectorAll('.content-section');

    buttons.forEach(button => {
      button.addEventListener('click', function() {
        // Remove active class from all buttons
        buttons.forEach(btn => btn.classList.remove('active'));

        // Add active class to the clicked button
        this.classList.add('active');

        // Hide all sections
        sections.forEach(section => section.classList.add('d-none'));

        // Show the selected section
        const sectionId = this.id.replace('btn-', 'content-');
        document.getElementById(sectionId).classList.remove('d-none');
      });
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    // Handle changes to switch-field
    document.querySelectorAll('input[name="type"]').forEach(radio => {
      radio.addEventListener('change', function() {
        // Show/Hide fields based on selection
        document.getElementById('organizationFields').style.display = this.value === 'Organization' ? 'block' : 'none';
        document.getElementById('individualFields').style.display = this.value === 'Individual' ? 'block' : 'none';

        // Change the label background color when radio button is selected
        const labelOne = document.querySelector('label[for="radio-one"]');
        const labelTwo = document.querySelector('label[for="radio-two"]');

        if (this.value === 'Organization') {
          labelOne.style.backgroundColor = '#007bff';
          labelOne.style.color = 'white';
          labelTwo.style.backgroundColor = '#fff';
          labelTwo.style.color = '#007bff';
        } else if (this.value === 'Individual') {
          labelTwo.style.backgroundColor = '#007bff';
          labelTwo.style.color = 'white';
          labelOne.style.backgroundColor = '#fff';
          labelOne.style.color = '#007bff';
        }
      });
    });
  });

  function submitForm() {
    const requiredFields = [
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


  const changePasswordForm = document.getElementById('changePasswordForm');
  changePasswordForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const currentPassword = document.getElementById('currentPassword').value.trim();
    const newPassword = document.getElementById('newPassword').value.trim();
    const confirmPassword = document.getElementById('confirmPassword').value.trim();

    if (newPassword !== confirmPassword) {
      alert('New password and confirm password do not match.');
      return;
    }

    if (newPassword.length < 6) {
      alert('Password should be at least 6 characters long.');
      return;
    }

    // Add server-side logic here to handle password update
    alert('Password changed successfully!');
  });

  const profilePictureInput = document.getElementById('profilePicture');
  const profilePreview = document.getElementById('profilePreview');
  const submitButton = document.getElementById('submitButton');
  let originalImageSrc = profilePreview.src;

  // Event listener for file input change
  profilePictureInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        const newImageSrc = e.target.result;

        // Check if the new image is different from the current preview
        if (newImageSrc !== originalImageSrc) {
          // Prompt user to confirm change
          if (confirm('Are you sure you want to change your profile picture?')) {
            // Update preview with the new image
            profilePreview.src = newImageSrc;
            originalImageSrc = newImageSrc;
            alert('Profile picture updated successfully.');
          } else {
            // Reset the file input if user cancels
            profilePictureInput.value = '';
          }
        } else {
          alert('The uploaded image is the same as the current profile picture.');
          profilePictureInput.value = '';
        }
      };
      reader.readAsDataURL(file);
    }
  });

  // Event listener for submit button
  submitButton.addEventListener('click', () => {
    if (profilePreview.src !== originalImageSrc) {
      alert('Please confirm your changes before submitting.');
    } else {
      alert('No changes detected.');
    }
  });
  document.addEventListener('DOMContentLoaded', () => {
    // Store the initial values
    const initialValues = {
      country: document.getElementById('country').value,
      city: document.getElementById('city').value,
      pincode: document.getElementById('pincode').value,
      mailingAddress: document.getElementById('mailingAddress').value
    };

    const submitButton = document.getElementById('submitLocation');
    const updatedValuesContainer = document.getElementById('updatedValues');

    submitButton.addEventListener('click', () => {
      // Get the current values
      const currentValues = {
        country: document.getElementById('country').value,
        city: document.getElementById('city').value,
        pincode: document.getElementById('pincode').value.trim(),
        mailingAddress: document.getElementById('mailingAddress').value.trim()
      };

      // Check for changes
      let changes = [];
      for (const key in currentValues) {
        if (currentValues[key] !== initialValues[key]) {
          changes.push(`${key.charAt(0).toUpperCase() + key.slice(1)}: ${currentValues[key]}`);
        }
      }

      // Display changes or alert if no changes
      if (changes.length > 0) {
        updatedValuesContainer.innerHTML = `
          <h5>Updated Values:</h5>
          <ul>${changes.map(change => `<li>${change}</li>`).join('')}</ul>
        `;
        Object.assign(initialValues, currentValues); // Update initial values after submit
      } else {
        alert('No changes detected.');
      }
    });
  });
</script>
@endsection