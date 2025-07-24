@extends('service-partner.base_layout')

@section('content')
  <style>
    #skillSuggestions {
    position: absolute;
    /* Ensure it overlaps the input field */
    top: 100%;
    /* Position directly below the input */
    left: 0;
    width: 100%;
    z-index: 1050;
    /* Ensure it appears above other elements */
    max-height: 200px;
    overflow-y: auto;
    background-color: #fff;
    /* Match background for consistency */
    border: 1px solid #dee2e6;
    /* Subtle border for visibility */
    display: none;
    /* Default to hidden */
    }
  </style>
  <br>

  <div class="container  " style="height: 100vh;">

    <div class="mb-4 ">
    <h2>Manage Account</h2>
    </div>
    <div class="row " style="height: 100%;">

    <!-- Left Section: Navigation -->
    <div class="col-lg-4 col-md-5 col-sm-12 mb-4"
      style="background-color: #f8f9fa; border-right: 1px solid #dee2e6; height: 100%; padding: 20px; overflow-y: auto;">
      <div class="list-group " style="height: 100%;">
      <button class="list-group-item list-group-item-action active " id="btn-profile" style="font-weight: bold;">
        Profile Picture
      </button>
      <button class="list-group-item list-group-item-action" id="btn-location" style="font-weight: bold;">
        Location
      </button>
      <button class="list-group-item list-group-item-action" id="btn-id" style="font-weight: bold;">
        CIN/Government ID/Skills
      </button>
      <button class="list-group-item list-group-item-action" id="btn-password" style="font-weight: bold;">
        Password
      </button>
      </div>
    </div>

    <!-- Right Section: Content Display -->
    <div class="col-lg-8 col-md-7 col-sm-12" style="height: 100%; padding: 20px; overflow-y: hidden; overflow-y: auto;">
      <!-- Profile Picture Section -->
      <div id="content-profile" class="content-section">
      <h4 class="mb-4 fw-bold text-pseudo">Profile Picture</h4>
      <div class="text-center">
        <img id="profilePreview" src="{{ route('profileController.get.dp.sp') }}" class="img-thumbnail mb-3"
        alt="Profile Preview" style="width:20%;height:15%; border: 0;">
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
        <input type="text" name="country" id="country" value="{{ $user->sprov_country }}" class="form-control"
          placeholder="Enter your country" required>
        </div>
        <div class="mb-3">
        <label for="city" class="form-label" style="font-weight: bold;">City</label>
        <!-- <select class="form-control form-select" id="city" required>
      <option value="Delhi">Delhi</option>
      <option value="Mumbai">Mumbai</option>
      <option value="Kolkata">Kolkata</option>
      </select> -->
        <input type="text" name="city" id="city" value="{{ $user->sprov_state }}" class="form-control"
          placeholder="Enter your city" required>
        </div>
        <div class="mb-3">
        <label for="pincode" class="form-label" style="font-weight: bold;">Pincode</label>
        <input type="text" id="pincode" class="form-control" placeholder="Enter your pincode"
          value="{{ $user->sprov_pincode }}">
        </div>
        <div class="mb-3">
        <label for="mailingAddress" class="form-label" style="font-weight: bold;">Mailing Address</label>
        <textarea id="mailingAddress" class="form-control" rows="3"
          placeholder="Enter your address">{{ $user->sprov_address }}</textarea>
        </div>
      </form>
      <div class="w-25 mx-auto">
        <button id="submitLocation" type="button" class="btn btn-primary mx-2 fw-bold"
        style="max-width: 150px;">Submit</button>
      </div>
      </div>


      <!-- CIN/Government ID Section -->
      <div id="content-id" class="content-section d-none" style="overflow-y: hidden;">

      <h4 class="mb-4 fw-bold text-pseudo">CIN/Government ID/Skills</h4>
      <form id="cinGovIdForm" onsubmit="submitForm(event)">
        <div class="card-body">
        <div class="form-group">
          <label style="font-weight: bold; margin-bottom: 10px;">You are an</label>
          <div class="switch-field"
          style="display: flex; justify-content: center; width: 100%; border-radius: 25px; overflow: hidden; position: relative; height: 40px;">
          <input type="radio" id="radio-one" name="type" value="Organization" checked
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
        <br>
        <!-- Skills section -->
        <div class="form-group d-flex align-items-center" style="gap: 10px; margin: 0; padding: 0;">
          <label for="skills" class="mb-0" style="font-weight: bold; margin-right: 0;">Key Skills</label>
          <button type="button" style="padding: 0; border: none; background: transparent; margin: 0;"
          data-bs-toggle="modal" data-bs-target="#skillsModal">
          <i class="fa fa-pencil" style="font-size: 1.2rem; color: #007bff; cursor: pointer;"></i>
          </button>
        </div>
        <div id="skillsWrapper" class="d-flex flex-wrap"></div>

        <input type="hidden" name="skill1" id="skill1">
        <input type="hidden" name="skill2" id="skill2">
        <input type="hidden" name="skill3" id="skill3">


        <br>


        <!-- Organization Fields -->
        <div id="organizationFields" style="margin-top: 20px;">
          <div class="form-group" style="margin-top: 20px;">
          <label for="orgName" style="font-weight: bold;">Organization Name</label>
          <input class="form-control" id="orgName" name="orgName" type="text"
            placeholder="Enter Organization Name">
          </div>
          <div class="form-group" style="margin-top: 20px;">
          <label for="cin" style="font-weight: bold;">CIN</label>
          <input class="form-control" id="cin" name="cin" type="text" value="{{ $user->sprov_cin  }}"
            placeholder="Enter CIN" style="margin-top: 5px;">
          </div>
          <div class="form-group" style="margin-top: 20px;">
          <label for="gst" style="font-weight: bold;">GST Number</label>
          <input class="form-control" id="gst" name="gst" type="text" value="#" placeholder="Enter GST Number"
            style="margin-top: 5px;">
          </div>
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
        <br>
        <div class="w-25 mx-auto">
        <button id="submitButton" class="btn btn-primary mx-2 fw-bold" type="submit">Submit</button>
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
  <!-- Modal for Managing Skills -->
  <div class="modal fade" id="skillsModal" tabindex="-1" aria-labelledby="skillsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 50%; height: 40%;">
    <div class="modal-content" style="height: 100%;">
      <div class="modal-header">
      <h5 class="modal-title" id="skillsModalLabel">Manage Your Skills</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" style="overflow-y: auto;">
      <!-- Add Skill Section -->
      <div class="form-group mb-3 d-flex justify-content-between" style="gap: 10px;">
        <div class="w-50 position-relative">
        <label for="addSkill" class="mb-0" style="font-weight: bold;">Add Skill</label>
        <input type="text" class="form-control" id="addSkill" placeholder="Enter a skill"
          oninput="showSkillSuggestions(this.value)" autocomplete="off" />
        <ul id="skillSuggestions" class="list-group mt-2"
          style="max-height: 200px; overflow-y: auto; display: none;"></ul>
        </div>
        <div class="w-50">
        <label for="yearsOfExperience" class="mb-0" style="font-weight: bold;">Years of Experience</label>
        <input type="number" class="form-control" id="yearsOfExperience" placeholder="Enter years of experience"
          min="0" oninput="validateExperience(this)">
        </div>
      </div>

      <!-- Add Skill Button -->
      <div class="text-center mt-3">
        <button class="btn btn-primary mx-auto btn-lg d-flex justify-content-center align-items-center" type="button"
        onclick="addSkill()">
        <i class="fa fa-plus"></i>&nbsp;&nbsp;Add
        </button>
      </div>

      <!-- List of Selected Skills -->
      <h6 class="mt-4">Selected Skills:</h6>
      <ul id="selectedSkills" class="list-group"></ul>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-success" onclick="saveSkills()">Save</button>
      </div>
    </div>
    </div>
  </div>

<!--  -->
<script>
  let selectedSkills = [];

  document.addEventListener('DOMContentLoaded', function () {
    // Handle tab switching
    document.querySelectorAll('.list-group-item').forEach(button => {
      button.addEventListener('click', () => {
        document.querySelectorAll('.list-group-item').forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        document.querySelectorAll('.content-section').forEach(section => section.classList.add('d-none'));
        document.getElementById(button.id.replace('btn-', 'content-')).classList.remove('d-none');
      });
    });

    // Handle Organization/Individual toggle UI
    document.querySelectorAll('input[name="type"]').forEach(radio => {
      radio.addEventListener('change', function () {
        const isOrg = this.value === 'Organization';
        document.getElementById('organizationFields').style.display = isOrg ? 'block' : 'none';
        document.getElementById('individualFields').style.display = isOrg ? 'none' : 'block';

        document.querySelector(`label[for="radio-one"]`).style.backgroundColor = isOrg ? '#007bff' : '#fff';
        document.querySelector(`label[for="radio-one"]`).style.color = isOrg ? 'white' : '#007bff';
        document.querySelector(`label[for="radio-two"]`).style.backgroundColor = !isOrg ? '#007bff' : '#fff';
        document.querySelector(`label[for="radio-two"]`).style.color = !isOrg ? 'white' : '#007bff';
      });
    });

    // Auto-load location data
    fetchLocationData();

    // Auto-load CIN/ID data
    fetchCinGovIdData();

    // Location submit
    document.getElementById('submitLocation').addEventListener('click', function () {
      const locationData = {
        country: document.getElementById('country').value,
        city: document.getElementById('city').value,
        pincode: document.getElementById('pincode').value,
        address: document.getElementById('mailingAddress').value
      };

      $.ajax({
        url: "{{ route('profileController.update.location.sp') }}",
        method: 'POST',
        data: locationData,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        success: function (res) {
          alert(res.success);
          location.reload();
        },
        error: function (xhr) {
          alert(xhr.responseJSON?.error || 'Something went wrong!');
        }
      });
    });

    // Profile picture submit
    document.getElementById('submitButton').addEventListener('click', function () {
      const file = document.getElementById('profilePicture').files[0];
      if (!file) return alert('Please select a file!');

      const formData = new FormData();
      formData.append('profilePicture', file);

      $.ajax({
        url: "{{ route('profileController.upload.dp.sp') }}",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        success: res => {
          alert(res.success);
          location.reload();
        },
        error: xhr => {
          alert(xhr.responseJSON?.error || 'Something went wrong!');
        }
      });
    });

    // Change Password
    $('#changePasswordForm').submit(function (e) {
      e.preventDefault();

      const formData = {
        current_password: $('#currentPassword').val(),
        new_password: $('#newPassword').val(),
        new_password_confirmation: $('#confirmPassword').val()
      };

      if (!formData.current_password || !formData.new_password || !formData.new_password_confirmation)
        return alert('All fields are required!');
      if (formData.new_password !== formData.new_password_confirmation)
        return alert('New password and confirm password do not match!');

      const btn = $(this).find('button[type="submit"]');
      btn.prop('disabled', true).text('Updating...');

      $.ajax({
        url: "{{ route('profileController.spChangePassword') }}",
        method: 'POST',
        data: formData,
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        success: res => {
          alert(res.message || 'Password updated!');
          window.location.href = res.redirect_url;
        },
        error: xhr => {
          alert(xhr.responseJSON?.error || 'Error occurred!');
          btn.prop('disabled', false).text('Submit');
        }
      });
    });

    // Skill suggestions
    const skillList = ['JavaScript', 'Python', 'Java', 'C++', 'HTML', 'CSS', 'React', 'Angular'];
    const suggestionsEl = document.getElementById('skillSuggestions');
    const skillInput = document.getElementById('addSkill');

    skillInput.addEventListener('input', function () {
      const input = this.value.trim().toLowerCase();
      suggestionsEl.innerHTML = '';
      if (!input) return suggestionsEl.style.display = 'none';

      const matches = skillList.filter(skill => skill.toLowerCase().startsWith(input));
      if (!matches.length) return suggestionsEl.style.display = 'none';

      matches.forEach(skill => {
        const item = document.createElement('button');
        item.type = 'button';
        item.className = 'list-group-item list-group-item-action';
        item.textContent = skill;
        item.onclick = () => {
          skillInput.value = skill;
          suggestionsEl.innerHTML = '';
          suggestionsEl.style.display = 'none';
        };
        suggestionsEl.appendChild(item);
      });

      suggestionsEl.style.display = 'block';
    });

    skillInput.addEventListener('blur', () => setTimeout(() => suggestionsEl.style.display = 'none', 200));
  });

  function renderSkillBadge(name, years) {
    return `
      <span class="badge bg-primary me-2 mb-2 d-flex align-items-center">
        ${name} (${years} yrs)
        <i class="fa fa-times ms-2" style="cursor:pointer" onclick="removeSkill('${name}')"></i>
      </span>`;
  }

  function addSkill() {
    const name = document.getElementById('addSkill').value.trim();
    const years = document.getElementById('yearsOfExperience').value.trim();

    if (!name || !years) return alert("Enter both skill and experience.");
    if (selectedSkills.length >= 3) return alert("You can add up to 3 skills.");
    if (selectedSkills.find(s => s.name.toLowerCase() === name.toLowerCase())) return alert("Skill already added.");

    selectedSkills.push({ name, years });
    document.getElementById('skillsWrapper').insertAdjacentHTML('beforeend', renderSkillBadge(name, years));
    document.getElementById('selectedSkills').insertAdjacentHTML('beforeend',
      `<li class="list-group-item d-flex justify-content-between align-items-center">
        ${name} <span class="badge bg-secondary">${years} yrs</span>
      </li>`);

    document.getElementById('addSkill').value = '';
    document.getElementById('yearsOfExperience').value = '';
  }

  function removeSkill(name) {
    selectedSkills = selectedSkills.filter(s => s.name !== name);
    document.querySelectorAll('#skillsWrapper span').forEach(span => {
      if (span.textContent.includes(name)) span.remove();
    });
    document.querySelectorAll('#selectedSkills li').forEach(li => {
      if (li.textContent.includes(name)) li.remove();
    });
  }

  function saveSkills() {
    const [s1, s2, s3] = [...selectedSkills, {}, {}, {}];
    document.getElementById('skill1').value = s1.name || '';
    document.getElementById('skill2').value = s2.name || '';
    document.getElementById('skill3').value = s3.name || '';
    const modal = bootstrap.Modal.getInstance(document.getElementById('skillsModal'));
    modal.hide();
  }

  function submitForm(e) {
    e.preventDefault();

    const form = document.getElementById('cinGovIdForm');
    const formData = new FormData(form);

    const [s1, s2, s3] = [...selectedSkills, {}, {}, {}];
    formData.set('skill1', s1.name || '');
    formData.set('skill2', s2.name || '');
    formData.set('skill3', s3.name || '');

    const about = document.getElementById('about').value.trim();
    if (!about) return alert("Please fill the About section.");

    if (document.getElementById('radio-two').checked) {
      const govtID = document.getElementById('govtID');
      if (!govtID.files.length) return alert('Please upload Government ID.');
      formData.append('govtID', govtID.files[0]);
    } else {
      const orgName = document.getElementById('orgName').value.trim();
      const cin = document.getElementById('cin').value.trim();
      const gst = document.getElementById('gst').value.trim();
      if (!orgName || !cin || !gst) return alert('Please fill all Organization fields.');
    }

    $.ajax({
      url: "{{ route('profileController.update.cinid.sp') }}",
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
      success: res => {
        alert(res.success || 'Details updated!');
        location.reload();
      },
      error: xhr => {
        alert(xhr.responseJSON?.error || 'Something went wrong!');
      }
    });
  }

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
      error: () => console.error('Failed to fetch location.')
    });
  }

  function fetchCinGovIdData() {
    $.ajax({
      url: "{{ route('profileController.get.cinid.sp') }}",
      method: 'GET',
      success: function (data) {
        $('#about').val(data.about || '');
        if (data.type === 'Organization') {
          $('#radio-one').prop('checked', true).trigger('change');
          $('#orgName').val(data.orgName || '');
          $('#cin').val(data.cin || '');
          $('#gst').val(data.gst || '');
        } else {
          $('#radio-two').prop('checked', true).trigger('change');
        }

        ['skill1', 'skill2', 'skill3'].forEach(key => {
          if (data[key]) {
            selectedSkills.push({ name: data[key], years: '' });
            document.getElementById('skillsWrapper')
              .insertAdjacentHTML('beforeend', renderSkillBadge(data[key], ''));
            document.getElementById('selectedSkills')
              .insertAdjacentHTML('beforeend',
                `<li class="list-group-item d-flex justify-content-between align-items-center">
                  ${data[key]} <span class="badge bg-secondary">—</span>
                </li>`);
          }
        });
      },
      error: () => console.error('Failed to fetch CIN/Gov ID data.')
    });
  }
</script>


@endsection