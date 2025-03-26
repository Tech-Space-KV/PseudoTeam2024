@extends('customer.base_layout')

@section('content')
<br>
<div class="container" style="height: calc(100vh - 200px); overflow: scrollable; max-height: 100%;">

  <h2>Refer a friend</h2>
  <div class="mb-4" id="message-container">
    @if(session('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
  @endif

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
      {{ session('error') }}
    </div>
  @endif
    </div>

  <!-- Main Content Container -->
  <div class="container mt-5" style="
      border-radius: 10px;
      background-color: #ffffff;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      /* padding: 30px; */
      overflow: hidden; /* Prevent scrolling */
      

    ">


    <form action="referandearnmail" id="referFriendForm" method="POST" style="margin-top: 20px;">
      @csrf
      <div class="form-group mb-4 mt-2">
        <label for="friendEmail" style="
                font-weight: 600;
                font-size: 14px;
                color: #444;">Friend's Email:</label>
        <input type="email" class="form-control" id="friendEmail" name="friend_email"
          style="border: 1px solid #ced4da; border-radius: 5px; padding: 10px;"
          placeholder="Enter your friend's email">
      </div>
      <div class="form-group mb-4">
        <label for="yourMessage" style="
                font-weight: 600;
                font-size: 14px;
                color: #444;">Message:</label>
        <textarea class="form-control" id="yourMessage" name="message" rows="4"
          style="border: 1px solid #ced4da; border-radius: 5px; padding: 10px; resize: none;"
          placeholder="Add a personal message (optional)"></textarea>
      </div>
      <button type="submit" class="btn btn-primary w-100" style="
            background-color: text-pseudo;
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;">Send Invite</button>
    </form>

    <div class="mt-5" style="
      bottom: 0;
      width: 100%;
      background-color: #f8f9fa;
      box-shadow: 0px -2px 6px rgba(0, 0, 0, 0.1);
      padding: 15px 10px;
      text-align: center;">
      <p style="
        font-family: 'Arial', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #444;
        margin-bottom: 10px;">Share invite via:</p>
      <div style="display: flex; justify-content: center; gap: 20px;">
        <!-- WhatsApp Button -->
        <a href="https://wa.me/?text=Check%20out%20this%20awesome%20platform!" target="_blank" style="
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
          <img src="{{ asset('images/whatsapp.png') }}" alt="WhatsApp" style="width: 40px; height: 40px;">
        </a>
        <!-- Instagram Button -->
        <a href="https://www.instagram.com/" target="_blank" style="
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
          <img src="{{ asset('images/instagram.jpg') }}" style="width: 40px; height: 40px;">
        </a>
        <!-- Facebook Button -->
        <a href="https://www.facebook.com/" target="_blank" style="
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
          <img src="{{ asset('images/facebook.jpg') }}" alt="Facebook" style="width: 40px; height: 40px;">
        </a>
      </div>
    </div>
    <br>
  </div>
</br>
</div>

<script>
  document.getElementById('referFriendForm').addEventListener('submit', function(event) {
    // Prevent the form submission initially
    event.preventDefault();

    const email = document.getElementById('friendEmail').value.trim();

    if (!email) {
      // Display an error message if no email is provided
      document.getElementById('message-container').innerHTML = `
        <div class="alert alert-warning" role="alert">
          Please provide an email.
        </div>
      `;
      return;
    }

    // Show confirmation message with "Yes" and "No" buttons
    document.getElementById('message-container').innerHTML = `
      <div class="alert alert-info" role="alert">
        Are you sure you want to send this invitation?
        <button id="confirm-invite" class="btn btn-primary btn-sm">Yes, send invitation</button>
        <button id="cancel-invite" class="btn btn-secondary btn-sm">No, cancel</button>
      </div>
    `;

    // Add event listener for the "Yes" button
    document.getElementById('confirm-invite').addEventListener('click', function() {
      // On confirmation, display success message and submit the form
      document.getElementById('message-container').innerHTML = `
        <div class="alert alert-success" role="alert">
          Invitation sent successfully!
        </div>
      `;
      // Now submit the form
      document.getElementById('referFriendForm').submit();
    });

    // Add event listener for the "No" button
    document.getElementById('cancel-invite').addEventListener('click', function() {
      // On cancel, just clear the message container and do nothing
      document.getElementById('message-container').innerHTML = '';
    });
  });
</script>


@endsection