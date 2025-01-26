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
    <div class="col-lg-4 col-md-5 col-sm-12 mb-4" style="background-color: #f8f9fa; border-right: 1px solid #dee2e6; height: 100%; padding: 20px; overflow-y: auto;">
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
        <h4 class="mb-4 fw-bold text-pseudo">Location</h4>
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
      <div id="content-id" class="content-section d-none" style="overflow-y: hidden;">

        <h4 class="mb-4 fw-bold text-pseudo">CIN/Government ID/Skills</h4>
        <form id="cinGovIdForm" onsubmit="submitForm(event)">
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
              <textarea class="form-control" id="about" required autocomplete="off" placeholder="Please describe about your work" name="about" rows="3" style="margin-top: 5px;"></textarea>
            </div>
            <br>
            <!-- Skills section -->
            <div class="form-group d-flex align-items-center" style="gap: 10px; margin: 0; padding: 0;">
              <label for="skills" class="mb-0" style="font-weight: bold; margin-right: 0;">Key Skills</label>
              <button type="button" style="padding: 0; border: none; background: transparent; margin: 0;" data-bs-toggle="modal" data-bs-target="#skillsModal">
                <i class="fa fa-pencil" style="font-size: 1.2rem; color: #007bff; cursor: pointer;"></i>
              </button>
            </div>
            <div id="skillsWrapper" class="d-flex flex-wrap"></div>


            <br>
             

              <!-- Organization Fields -->
              <div id="organizationFields" style="margin-top: 20px;">
              <div class="form-group" style="margin-top: 20px;">
                <label for="orgName" style="font-weight: bold;">Organization Name</label>
                <input
                  class="form-control"
                  id="orgName"
                  name="orgName"
                  type="text"
                  placeholder="Enter Organization Name">
              </div>
                <div class="form-group" style="margin-top: 20px;">
                  <label for="cin" style="font-weight: bold;">CIN</label>
                  <input class="form-control" id="cin" name="cin" type="text" placeholder="Enter CIN" style="margin-top: 5px;">
                </div>
                <div class="form-group" style="margin-top: 20px;">
                  <label for="gst" style="font-weight: bold;">GST Number</label>
                  <input class="form-control" id="gst" name="gst" type="text" placeholder="Enter GST Number" style="margin-top: 5px;">
                </div>
              </div>
            </div>

            <!-- Individual Fields -->
            <div id="individualFields" style="display: none; margin-top: 20px;">
              <div class="form-group">
                <label style="font-weight: bold;">Any Government ID</label>
                <input class="form-control" id="govtID" name="govtID" type="file" accept="image/*" style="margin-top: 5px;">
              </div>
            </div>
         
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
            <input
              type="text"
              class="form-control"
              id="addSkill"
              placeholder="Enter a skill"
              oninput="showSkillSuggestions(this.value)"
              autocomplete="off" />
            <ul id="skillSuggestions" class="list-group mt-2" style="max-height: 200px; overflow-y: auto; display: none;"></ul>
          </div>
          <div class="w-50">
            <label for="yearsOfExperience" class="mb-0" style="font-weight: bold;">Years of Experience</label>
            <input type="number" class="form-control" id="yearsOfExperience" placeholder="Enter years of experience" min="0" oninput="validateExperience(this)">
          </div>
        </div>

        <!-- Add Skill Button -->
        <div class="text-center mt-3">
          <button class="btn btn-primary mx-auto btn-lg d-flex justify-content-center align-items-center" type="button" onclick="addSkill()">
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


<script>
  document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.list-group-item');
    const sections = document.querySelectorAll('.content-section');
    const initialValues = {
      country: document.getElementById('country').value,
      city: document.getElementById('city').value,
      pincode: document.getElementById('pincode').value.trim(),
      mailingAddress: document.getElementById('mailingAddress').value.trim()
    };

    buttons.forEach(button =>
      button.addEventListener('click', () => {
        buttons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        sections.forEach(section => section.classList.add('d-none'));
        document.getElementById(button.id.replace('btn-', 'content-')).classList.remove('d-none');
      })
    );

    document.querySelectorAll('input[name="type"]').forEach(radio =>
      radio.addEventListener('change', () => {
        const isOrg = radio.value === 'Organization';
        document.getElementById('organizationFields').style.display = isOrg ? 'block' : 'none';
        document.getElementById('individualFields').style.display = isOrg ? 'none' : 'block';
        ['radio-one', 'radio-two'].forEach((id, idx) => {
          const label = document.querySelector(`label[for="${id}"]`);
          const active = idx === (isOrg ? 0 : 1);
          label.style.backgroundColor = active ? '#007bff' : '#fff';
          label.style.color = active ? 'white' : '#007bff';
        });
      })
    );

    document.getElementById('changePasswordForm').addEventListener('submit', e => {
      e.preventDefault();
      const [current, newPwd, confirm] = ['currentPassword', 'newPassword', 'confirmPassword'].map(id =>
        document.getElementById(id).value.trim()
      );
      if (newPwd !== confirm) alert('Passwords do not match.');
      else if (newPwd.length < 6) alert('Password must be at least 6 characters.');
      else alert('Password changed successfully!');
    });

    document.getElementById('profilePicture').addEventListener('change', e => {
      const file = e.target.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = ({
        target
      }) => {
        if (target.result !== profilePreview.src && confirm('Change profile picture?')) {
          profilePreview.src = target.result;
          alert('Profile picture updated successfully.');
        } else e.target.value = '';
      };
      reader.readAsDataURL(file);
    });

    document.getElementById('submitLocation').addEventListener('click', () => {
      const currentValues = {
        country: document.getElementById('country').value,
        city: document.getElementById('city').value,
        pincode: document.getElementById('pincode').value.trim(),
        mailingAddress: document.getElementById('mailingAddress').value.trim()
      };
      const changes = Object.keys(currentValues)
        .filter(key => currentValues[key] !== initialValues[key])
        .map(key => `${key.charAt(0).toUpperCase() + key.slice(1)}: ${currentValues[key]}`);
      if (changes.length) {
        alert('Location updated successfully.');
        Object.assign(initialValues, currentValues);
      } else alert('No changes detected.');
    });


    let selectedSkills = [];
    const updateSkillsUI = () => {
      const list = document.getElementById('selectedSkills');
      list.innerHTML = ''; // Clear existing list

      selectedSkills.forEach(({
        skill,
        experience
      }, index) => {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
        listItem.innerHTML = `
      ${skill} - ${experience} years
      <button class="btn btn-danger btn-sm" onclick="removeSkill(${index})">Remove</button>
    `;
        list.appendChild(listItem);
      });
    };

    window.addSkill = () => {
      console.log("Add Skill button clicked"); // Check if this is printed
      const skillInput = document.getElementById('addSkill');
      const experienceInput = document.getElementById('yearsOfExperience');
      const skill = skillInput.value.trim();
      const experience = experienceInput.value;

      if (!skill) {
        alert('Please enter a skill.');
        return;
      }
      if (!experience || isNaN(experience) || experience <= 0) {
        alert('Please enter a valid number of years of experience.');
        return;
      }
      if (selectedSkills.some(s => s.skill.toLowerCase() === skill.toLowerCase())) {
        alert('This skill is already added.');
        return;
      }

      // Add skill to the list
      selectedSkills.push({
        skill,
        experience
      });
      updateSkillsUI();

      // Clear inputs
      skillInput.value = '';
      experienceInput.value = '';
    };




    window.removeSkill = index => {
      selectedSkills.splice(index, 1);
      updateSkillsUI();
    };

    window.saveSkills = () => {
      document.getElementById('skillsWrapper').innerHTML = selectedSkills
        .map(({
          skill,
          experience
        }) => `<span class="badge bg-primary m-1">${skill} (${experience} years)</span>`)
        .join('');
      $('#skillsModal').modal('hide');
    };

    const suggestSkills = (input, suggestions) => {
      suggestions.innerHTML = ''; // Clear previous suggestions

      if (!input.trim()) {
        suggestions.style.display = 'none';
        return;
      }

      const skillList = ['JavaScript', 'Python', 'Java', 'C++', 'HTML', 'CSS', 'React', 'Angular'];
      const filteredSkills = skillList.filter(skill =>
        skill.toLowerCase().startsWith(input.trim().toLowerCase()) // Matches only if starts with input
      );

      if (filteredSkills.length === 0) {
        suggestions.style.display = 'none';
        return;
      }

      filteredSkills.forEach(skill => {
        const suggestion = document.createElement('button');
        suggestion.className = 'list-group-item list-group-item-action';
        suggestion.textContent = skill;
        suggestion.type = 'button'; // Prevent form submission on click

        suggestion.addEventListener('click', () => {
          document.getElementById('addSkill').value = skill;
          suggestions.innerHTML = '';
          suggestions.style.display = 'none';
        });

        suggestions.appendChild(suggestion);
      });

      suggestions.style.display = 'block'; // Show suggestions
    };

    document.getElementById('addSkill').addEventListener('input', e => {
      suggestSkills(e.target.value, document.getElementById('skillSuggestions'));
    });

    document.getElementById('addSkill').addEventListener('blur', () => {
      setTimeout(() => {
        document.getElementById('skillSuggestions').style.display = 'none';
      }, 200);
    });

    document.getElementById('addSkill').addEventListener('focus', e => {
      suggestSkills(e.target.value, document.getElementById('skillSuggestions'));
    });



  });
</script>

@endsection