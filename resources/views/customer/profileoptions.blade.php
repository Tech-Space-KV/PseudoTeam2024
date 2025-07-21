@extends('customer.base_layout')

@section('content')

<br>

<div class="container  " style="height: 100vh;">

  <div class="mb-4 ">
    <h2>Manage Account</h2>
  </div>
  <div class="row " style="height: 100%;">

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
      <!-- Profile Picture Section -->
      <div id="content-profile" class="content-section">
        <h4 class="mb-4 fw-bold text-pseudo">Profile Picture</h4>
        <!-- <p><span class="fs-1 fw-bold">Hi, </span><span class="fs-3">{{ session('user_id') }}</span></p> -->
        <div class="text-center">
          <img id="profilePreview" src="{{ route('profileController.get.dp') }}" class="img-thumbnail mb-3"
            alt="Profile Preview" style="border: 0;">

          <div class="d-flex justify-content-center align-items-center mb-3">
            <label for="profilePicture" class="me-2" style="font-weight: bold;">Upload DP</label>
            <input type="file" id="profilePicture" class="form-control" style="max-width: 300px;" accept="image/*">
          </div>
          <button id="submitButton" type="button" class="btn btn-primary mx-2 fw-bold"
            style="max-width: 150px;">Submit</button>
        </div>
      </div>
      <!-- Location Section -->
      <div id="content-location" class="content-section d-none">
        <h4 class="mb-4 fw-bold text-pseudo">Location</h4>
        <form id="locationForm">
          <div class="mb-3">
            <label for="country" class="form-label" style="font-weight: bold;">Country</label>
            <!-- <select class="form-control form-select" id="country" onchange="populateCities();" required>
              <option value="India" selected>India</option>
            </select> -->
            <input type="text" id="country" class="form-control" placeholder="Enter your country" value="{{ $user->pown_country }}">
          </div>
          <div class="mb-3">
            <label for="city" class="form-label" style="font-weight: bold;">City</label>
            <!-- <select class="form-control form-select" id="city" required>
              <option value="Delhi">Delhi</option>
              <option value="Mumbai">Mumbai</option>
              <option value="Kolkata">Kolkata</option>
            </select> -->

            <input type="text" id="city" class="form-control" placeholder="Enter your city" value="{{ $user->pown_state ?? 'N/A' }}">

          </div>
          <div class="mb-3">
            <label for="pincode" class="form-label" style="font-weight: bold;">Pincode</label>
            <input type="text" id="pincode" class="form-control" placeholder="Enter your pincode" value="{{ $user->pown_pincode ?? 'N/A' }}">
          </div>
          <div class="mb-3">  
            <label for="mailingAddress" class="form-label" style="font-weight: bold;">Mailing Address</label>
            <textarea id="mailingAddress" class="form-control" rows="3" placeholder="Enter your address">{{ $user->pown_address ?? 'N/A' }}</textarea>
          </div>
        </form>
        <div class="w-25 mx-auto">
          <button id="submitLocation" type="button" class="btn btn-primary mx-2 fw-bold"
            style="max-width: 150px;">Submit</button>
        </div>
      </div>
      <!-- CIN/Government ID Section -->
      <div id="content-id" class="content-section d-none">
        <h4 class="mb-4 fw-bold text-pseudo">CIN/Government ID</h4>
        <form id="cinGovIdForm" onsubmit="submitForm(event)">
          <div class="card-body">
            <div class="form-group">
              <label style="font-weight: bold; margin-bottom: 10px;">You are an</label>
              <div class="switch-field"
                style="display: flex; justify-content: center; width: 100%; border-radius: 25px; overflow: hidden; position: relative; height: 40px;">
                <input type="radio" id="radio-one" name="type" value="{{ $user->pown_type ?? 'N/A' }}" checked
                  style="position: absolute; clip: rect(0, 0, 0, 0); height: 1px; width: 1px; border: 0; overflow: hidden;">
                <label for="radio-one"
                  style="background-color: #007bff; color: white; font-size: 16px; text-align: center; border: 1px solid #007bff; border-radius: 25px 0 0 25px; cursor: pointer; display: flex; justify-content: center; align-items: center; width: 100%; height: 100%; transition: background-color 0.3s, color 0.3s;">
                  Organization
                </label>

                <input type="radio" id="radio-two" name="type" value="Individual"
                  style="position: absolute; clip: rect(0, 0, 0, 0); height: 1px; width: 1px; border: 0; overflow: hidden;">
                <label for="radio-two"
                  style="background-color: #fff; color: #007bff; font-size: 16px; text-align: center; border: 1px solid #007bff; border-radius: 0 25px 25px 0; cursor: pointer; display: flex; justify-content: center; align-items: center; width: 100%; height: 100%; transition: background-color 0.3s, color 0.3s;">
                  Individual
                </label>
              </div>
            </div>

            <div class="form-group" style="margin-top: 20px;">
              <label for="about" style="font-weight: bold;">About</label>
              <textarea class="form-control" id="about" required autocomplete="off"
                placeholder="Please describe about your work" name="about" rows="3" style="margin-top: 5px;"></textarea>
            </div>

            <!-- Organization Fields -->
            <div id="organizationFields" style="margin-top: 20px;">
              <div class="form-group" style="margin-top: 20px;">
                <label for="orgName" style="font-weight: bold;">Organization Name</label>
                <input class="form-control" id="orgName" name="orgName" type="text"
                  placeholder="Enter Organization Name">
              </div>
              <div class="form-group" style="margin-top: 20px;">
                <label for="cin" style="font-weight: bold;">CIN</label>
                <input class="form-control" id="cin" name="cin" type="text" placeholder="Enter CIN"
                  style="margin-top: 5px;">
              </div>
              <div class="form-group" style="margin-top: 20px;">
                <label for="gst" style="font-weight: bold;">GST Number</label>
                <input class="form-control" id="gst" name="gst" type="text" placeholder="Enter GST Number"
                  style="margin-top: 5px;">
              </div>
            </div>

            <!-- Individual Fields -->
            <div id="individualFields" style="display: none; margin-top: 20px;">
              <div class="form-group">
                <label style="font-weight: bold;">Any Government ID</label>
                <input class="form-control" id="govtID" name="govtID" type="file" accept="image/*"
                  style="margin-top: 5px;">

              </div>
            </div>
          </div>
          <div class="w-25 mx-auto">
            <button id="submitCinGovButton" class="btn btn-primary mx-2 fw-bold" type="submit">Submit</button>
          </div>
        </form>
      </div>
      <!-- Change Password Section -->
      <div id="content-password" class="content-section d-none">
        <h4 class="mb-4 fw-bold text-pseudo">Change Password</h4>
        <form id="changePasswordForm">
          <div class="mb-3">
            <label for="currentPassword" class="form-label" style="font-weight: bold;">Current Password</label>
            <input type="password" id="currentPassword" class="form-control" placeholder="Enter your current password"
              required>
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label" style="font-weight: bold;">New Password</label>
            <input type="password" id="newPassword" class="form-control" placeholder="Enter a new password" required>
          </div>
          <div class="mb-3">
            <label for="confirmPassword" class="form-label" style="font-weight: bold;">Confirm Password</label>
            <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm your new password"
              required>
          </div>
          <div class="w-25 mx-auto">
            <button type="submit" class="btn btn-primary mx-2 fw-bold" style="max-width: 150px;">Submit</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const buttons = document.querySelectorAll('.list-group-item');
      const sections = document.querySelectorAll('.content-section');

      buttons.forEach(button => {
        button.addEventListener('click', function () {
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
  </script>
  <script>
    $('#submitButton').click(function () {
      var formData = new FormData();
      var file = $('#profilePicture')[0].files[0];

      if (!file) {
        alert('Please select a file first!');
        return;
      }

      formData.append('profilePicture', file);

      $.ajax({
        url: "{{ route('profileController.upload.dp') }}",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (response) {
          alert(response.success);
          location.reload();
        },
        error: function (xhr) {
          if (xhr.responseJSON && xhr.responseJSON.error) {
            alert(xhr.responseJSON.error);
          } else {
            alert('Something went wrong!');
          }
        }
      });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Fetch location when page loads
      fetchLocationData();

      $('#submitLocation').click(function () {
        var locationData = {
          country: $('#country').val(),
          city: $('#city').val(),
          pincode: $('#pincode').val(),
          address: $('#mailingAddress').val()
        };

        $.ajax({
          url: "{{ route('profileController.update.location') }}",
          method: 'POST',
          data: locationData,
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          success: function (response) {
            alert(response.success);
            location.reload();
          },
          error: function (xhr) {
            if (xhr.responseJSON && xhr.responseJSON.error) {
              alert(xhr.responseJSON.error);
            } else {
              alert('Something went wrong while updating location!');
            }
          }
        });
      });

      function fetchLocationData() {
        $.ajax({
          url: "{{ route('profileController.get.location') }}",
          method: 'GET',
          success: function (data) {
            $('#country').val(data.country);
            $('#city').val(data.city);
            $('#pincode').val(data.pincode);
            $('#mailingAddress').val(data.address);
          },
          error: function () {
            console.error('Failed to fetch location data.');
          }
        });
      }
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      document.querySelectorAll('input[name="type"]').forEach(radio => {
        radio.addEventListener('change', function () {
          document.getElementById('organizationFields').style.display = this.value === 'Organization' ? 'block' : 'none';
          document.getElementById('individualFields').style.display = this.value === 'Individual' ? 'block' : 'none';

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

    function submitForm(event) {
      event.preventDefault();

      const form = document.getElementById('cinGovIdForm');
      const formData = new FormData(form);

      const about = document.getElementById('about').value.trim();
      if (!about) {
        alert('Please fill the About section.');
        return;
      }

      // Check Organization/Individual fields
      if (document.getElementById('radio-two').checked) {
        // Individual selected
        const govtIdInput = document.getElementById('govtID');
        if (!govtIdInput.files || govtIdInput.files.length === 0) {
          alert('Please upload a Government ID.');
          return;
        }
        formData.append('govtID', govtIdInput.files[0]);
      } else {
        // Organization selected
        const orgName = document.getElementById('orgName').value.trim();
        const cin = document.getElementById('cin').value.trim();
        const gst = document.getElementById('gst').value.trim();

        if (!orgName || !cin || !gst) {
          alert('Please fill all Organization details.');
          return;
        }
      }

      $.ajax({
        url: "{{ route('profileController.update.cinid') }}",  // make sure this route exists
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (response) {
          alert(response.success || 'Details updated successfully!');
          location.reload();
        },
        error: function (xhr) {
          if (xhr.responseJSON && xhr.responseJSON.error) {
            alert(xhr.responseJSON.error);
          } else {
            alert('Something went wrong!');
          }
        }
      });
    }

    document.addEventListener('DOMContentLoaded', function () {
      fetchCinGovIdData(); // call on page load

      function fetchCinGovIdData() {
        $.ajax({
          url: "{{ route('profileController.get.cinid') }}",  // You must create this route/controller if not already
          method: 'GET',
          success: function (data) {
            // Set About
            $('#about').val(data.about || '');

            // Set Type (Organization/Individual)
            if (data.type === 'Organization') {
              $('#radio-one').prop('checked', true).trigger('change');
              $('#orgName').val(data.orgName || '');
              $('#cin').val(data.cin || '');
              $('#gst').val(data.gst || '');
            } else if (data.type === 'Individual') {
              $('#radio-two').prop('checked', true).trigger('change');
              // No need to prefill Govt ID file input (files can't be prefilled for security reasons)
            }

            // Trigger UI adjustments
            document.querySelector(`input[name="type"][value="${data.type}"]`).dispatchEvent(new Event('change'));
          },
          error: function () {
            console.error('Failed to fetch CIN/Gov ID data.');
          }
        });
      }
    });

  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      $('#changePasswordForm').submit(function (event) {
        event.preventDefault(); // Stop normal form submission

        // Prepare the data
        var formData = {
          current_password: $('#currentPassword').val().trim(),
          new_password: $('#newPassword').val().trim(),
          new_password_confirmation: $('#confirmPassword').val().trim() // <<< Correct name
        };

        if (!formData.current_password || !formData.new_password || !formData.new_password_confirmation) {
          alert('All fields are required!');
          return;
        }

        if (formData.new_password !== formData.new_password_confirmation) {
          alert('New password and confirm password do not match!');
          return;
        }


        // Disable submit button
        var submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true).text('Updating...');

        var submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true).text('Updating...');

        $.ajax({
          url: "{{ route('profileController.changePassword') }}",
          method: 'POST',
          data: formData,
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          success: function (response) {
            alert(response.message || 'Password updated successfully!');
            window.location.href = response.redirect_url;
          },
          error: function (xhr) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
              let firstError = Object.values(xhr.responseJSON.errors)[0][0];
              alert(firstError);
            } else if (xhr.responseJSON && xhr.responseJSON.error) {
              alert(xhr.responseJSON.error);
            } else {
              alert('Something went wrong!');
            }
            submitButton.prop('disabled', false).text('Change Password');
          }
        });

      });
    });
  </script>
@endsection