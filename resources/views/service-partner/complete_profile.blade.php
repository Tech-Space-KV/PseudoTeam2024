<!DOCTYPE html>
<html lang="en">

<head>
  <title>Service-Partner - PseudoTeam</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/service/layout.css') }}">
  <link rel="stylesheet" href="{{ asset('css/service/reports.css') }}">
  <link rel="stylesheet" href="{{ asset('css/service/project_upload.css') }}">
  <link rel="stylesheet" href="{{ asset('css/service/complete_profile.css') }}">
</head>

<body>
  <!-- Navbar -->
  <div class="header">
    <div class="left-section border px-4 py-4" style="background-color: white;">
      <a href="/">
        <img src="http://127.0.0.1:8000/images/logopt.png" class="logo" alt="Logo">
      </a>
    </div>
    <a type="button" class="btn btn-outline-danger position-relative mx-4 my-4" style="float: right; border: 1px solid #ccc;">
      Logout <i class="fa fa-sign-out"></i>
    </a>
  </div>

  <!-- Welcome Message -->
  <div class="container">
    <p>
      <span class="fs-1 fw-bold">Hi, Kunal</span><br><br>
      <span class="fs-4" style="color: black;"> Please complete your Profile</span>
    </p>
  </div>

  <!-- Profile Form -->
  <div class="container">
    <form id="profileForm" onsubmit="return submitForm(event)">
      <!-- Step 1 -->
      <div class="card mb-4" id="step1">
        <div class="card-body">
          <h5 class="card-title">Step 1: Basic Information</h5>
          <div class="form-group">
            <label for="country">Country</label>
            <select class="form-control" id="country" name="country" onchange="populateCities();" required>
              <option value="" disabled selected>--Select Country--</option>
              <option value="India">India</option>
            </select>
          </div>
          <div class="form-group">
            <label for="city">City</label>
            <select class="form-control" id="city" name="city" required>
              <option value="" disabled selected>--Select City--</option>
            </select>
          </div>
          <div class="form-group">
            <label for="pincode">Pincode</label>
            <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Area Pincode" required>
          </div>
          <div class="form-group">
            <label for="address">Mailing Address</label>
            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Your address" required></textarea>
          </div>
          <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="card mb-4" id="step2" style="display: none;">
        <div class="card-body">
          <h5 class="card-title">Step 2: Profile Details</h5>
          <div class="form-group">
            <label>You are an:</label>
            <div class="switch-field">
              <input type="radio" id="radio-one" name="type" value="Organization" checked>
              <label for="radio-one">Organization</label>
              <input type="radio" id="radio-two" name="type" value="Individual">
              <label for="radio-two">Individual</label>
            </div>
          </div>
          <div class="form-group">
            <label for="about">About</label>
            <textarea class="form-control" id="about" name="about" placeholder="Please describe your work" rows="3" required></textarea>
          </div>
          <!-- Skills section -->
          <div class="form-group d-flex align-items-center" style="gap:10px; margin: 0; padding: 0;">
            <label for="skills" class="mb-0" style="font-weight: bold; margin-right: 0;">Key Skills</label>
            <button type="button" style="padding: 0; border: none; background: transparent; margin: 0;" data-bs-toggle="modal" data-bs-target="#skillsModal">
              <i class="fa fa-pencil" style="font-size: 1.2rem; color: #007bff; cursor: pointer;"></i>
            </button>
          </div>
          <div id="skillsWrapper" class="d-flex flex-wrap"></div>

          <!-- Organization/Individual Fields -->
          <div id="organizationFields">
            <div class="form-group position-relative">
              <label for="orgName">Organization Name</label>
              <input
                class="form-control"
                id="orgName"
                name="orgName"
                type="text"
                placeholder="Enter Organization Name"
                oninput="showSuggestions(this.value)"
                onfocus="showSuggestions(this.value)">

              <ul class="list-group position-absolute w-100" id="orgSuggestions" style="z-index: 1050;"></ul>
            </div>




            <div class="form-group">
              <label for="cin">CIN</label>
              <input class="form-control" id="cin" name="cin" type="text" placeholder="Enter CIN">
            </div>
            <div class="form-group">
              <label for="gst">GST Number</label>
              <input class="form-control" id="gst" name="gst" type="text" placeholder="Enter GST Number">
            </div>
          </div>
          <div id="individualFields" style="display: none;">
            <div class="form-group">
              <label>Any Government ID</label>
              <input class="form-control" id="govtID" name="govtID" type="file" accept="image/*">
            </div>
          </div>
          <div class="btn-group">
            <button class="btn btn-secondary mx-2 fw-bold" type="button" onclick="prevStep()">Prev</button>
            <button class="btn btn-primary mx-2 fw-bold" type="submit">Submit</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- Modal for Managing Skills -->
  <div class="modal fade" id="skillsModal" tabindex="-1" aria-labelledby="skillsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="skillsModalLabel">Manage Your Skills</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3 position-relative">
            <label for="addSkill">Add Skill</label>
            <div class="input-group">
              <input type="text" class="form-control" id="addSkill" placeholder="Enter a skill" oninput="showSkillSuggestions(this.value)">
              <button class="addskillbtn" type="button" onclick="addSkill()" style="padding: 0 12px;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <div id="skillSuggestions" class="list-group position-absolute w-100 skillSuggestions" style="z-index: 1050;"></div>
          </div>
          <div class="form-group mb-3">
            <label for="yearsOfExperience">Years of Experience</label>
            <input type="number" class="form-control" id="yearsOfExperience" placeholder="Enter years of experience" min="0" oninput="validateExperience(this)">
          </div>
          <h6>Selected Skills:</h6>
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
    function populateCities() {
      const country = document.getElementById('country').value;
      const citySelect = document.getElementById('city');
      citySelect.innerHTML = '<option value="" disabled selected>--Select City--</option>';
      if (country === 'India') {
        const cities = ['Mumbai', 'Delhi', 'Bangalore', 'Hyderabad', 'Chennai', 'Kolkata'];
        cities.forEach(city => {
          const option = document.createElement('option');
          option.value = city;
          option.textContent = city;
          citySelect.appendChild(option);
        });
      }
    }

    function nextStep() {
      document.getElementById('step1').style.display = 'none';
      document.getElementById('step2').style.display = 'block';
    }

    function prevStep() {
      document.getElementById('step2').style.display = 'none';
      document.getElementById('step1').style.display = 'block';
    }

    document.querySelectorAll('input[name="type"]').forEach(radio => {
      radio.addEventListener('change', (event) => {
        const isOrg = event.target.value === 'Organization';
        document.getElementById('organizationFields').style.display = isOrg ? 'block' : 'none';
        document.getElementById('individualFields').style.display = isOrg ? 'none' : 'block';
      });
    });

    function validateExperience(input) {
      if (input.value < 0) {
        input.value = '';
        alert("Years of experience cannot be negative!");
      }
    }

    let selectedSkills = [];
    let tempSkills = [];

    function addSkill() {
      const skillInput = document.getElementById('addSkill');
      const experienceInput = document.getElementById('yearsOfExperience');
      const skill = skillInput.value.trim();
      const experience = experienceInput.value;

      if (skill && experience) {
        // Check for duplicates
        const isDuplicate = selectedSkills.some(item => item.skill.toLowerCase() === skill.toLowerCase());
        if (isDuplicate) {
          alert('This skill has already been added.');
          return;
        }

        selectedSkills.push({
          skill,
          experience
        });
        updateSelectedSkillsUI();
        skillInput.value = '';
        experienceInput.value = '';
      } else {
        alert('Please enter both skill and experience.');
      }
    }

    function updateSelectedSkillsUI() {
      const selectedSkillsList = document.getElementById('selectedSkills');
      selectedSkillsList.innerHTML = '';
      selectedSkills.forEach(({
        skill,
        experience
      }, index) => {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
        listItem.textContent = `${skill} - ${experience} years`;
        const deleteButton = document.createElement('button');
        deleteButton.className = 'btn btn-danger btn-sm';
        deleteButton.textContent = 'Remove';
        deleteButton.onclick = () => removeSkill(index);
        listItem.appendChild(deleteButton);
        selectedSkillsList.appendChild(listItem);
      });
    }

    function removeSkill(index) {
      selectedSkills.splice(index, 1);
      updateSelectedSkillsUI();
    }

    function saveSkills() {
      const skillsWrapper = document.getElementById('skillsWrapper');
      skillsWrapper.innerHTML = '';
      selectedSkills.forEach(({
        skill,
        experience
      }) => {
        const skillBadge = document.createElement('span');
        skillBadge.className = 'badge bg-primary text-white m-1';
        skillBadge.textContent = `${skill} (${experience} years)`;
        skillsWrapper.appendChild(skillBadge);
      });
      $('#skillsModal').modal('hide');
    }

    function showSkillSuggestions(input) {
      const skillSuggestions = document.getElementById('skillSuggestions');
      skillSuggestions.innerHTML = '';
      const skills = ['JavaScript', 'Python', 'Java', 'C++', 'HTML', 'CSS', 'React', 'Angular'];
      if (input) {
        const filteredSkills = skills.filter(skill => skill.toLowerCase().includes(input.toLowerCase()));
        filteredSkills.forEach(skill => {
          const suggestion = document.createElement('button');
          suggestion.className = 'list-group-item list-group-item-action';
          suggestion.textContent = skill;
          suggestion.onclick = () => {
            document.getElementById('addSkill').value = skill;
            skillSuggestions.innerHTML = '';
          };
          skillSuggestions.appendChild(suggestion);
        });
      }
    }


    function showSuggestions(input) {
      const orgSuggestions = document.getElementById('orgSuggestions');
      orgSuggestions.innerHTML = ''; // Clear previous suggestions

      const organizations = ['PseudoTech', 'TechSavvy', 'CodeCraft', 'InnovateInc']; // Example organizations

      if (input) {
        const filteredOrgs = organizations.filter(org =>
          org.toLowerCase().includes(input.toLowerCase())
        );

        if (filteredOrgs.length > 0) {
          filteredOrgs.forEach(org => {
            const suggestion = document.createElement('button');
            suggestion.className = 'list-group-item list-group-item-action';
            suggestion.textContent = org;

            // When the suggestion is clicked, update the input field and clear the suggestions
            suggestion.onclick = () => {
              document.getElementById('orgName').value = org;
              orgSuggestions.innerHTML = '';
            };

            orgSuggestions.appendChild(suggestion);
          });
        } else {
          // Display "No matching organizations found."
          const noResult = document.createElement('div');
          noResult.className = 'list-group-item text-muted';
          noResult.textContent = 'No matching organizations found.';
          orgSuggestions.appendChild(noResult);
        }
      } else {
        // Show all suggestions if input is empty
        organizations.forEach(org => {
          const suggestion = document.createElement('button');
          suggestion.className = 'list-group-item list-group-item-action';
          suggestion.textContent = org;

          suggestion.onclick = () => {
            document.getElementById('orgName').value = org;
            orgSuggestions.innerHTML = '';
          };

          orgSuggestions.appendChild(suggestion);
        });
      }
    }
    // Hide organization suggestions when the skills modal is opened
$('#skillsModal').on('show.bs.modal', function () {
  document.getElementById('orgSuggestions').innerHTML = ''; // Clear suggestions
});

// Hide organization suggestions when clicking outside the input field
document.addEventListener('click', function (event) {
  const orgInput = document.getElementById('orgName');
  const orgSuggestions = document.getElementById('orgSuggestions');
  if (!orgInput.contains(event.target) && !orgSuggestions.contains(event.target)) {
    orgSuggestions.innerHTML = ''; // Clear suggestions if clicked outside
  }
});

  </script>
</body>

</html>