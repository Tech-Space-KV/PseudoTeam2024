@extends('service-partner.base_layout')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2>Project Timeline: &lt;Project ID&gt;</h2>
    </div>
</br>

<div class="container mt-5">
    
    <form class="task-form text-pseudo bg-light p-4 rounded shadow-sm" method="POST" action="/update-task">
        <h4 class="text-center text-dark mb-4">
            Task: <span class="text-pseudo fw-bold">Hardware Market Place</span>
        </h4>
        <div class="mb-3 row align-items-center">
            <label for="status" class="col-sm-2 col-form-label fw-bold">Status:</label>
            <div class="col-sm-10">
                <select class="form-select form-select-sm" id="status" name="status" required>
                    <option value="" selected>Select Status</option>
                    <option value="not-started">Not Started</option>
                    <option value="in-progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row align-items-center">
            <label for="file" class="col-sm-2 col-form-label fw-bold">Proof of Completion:</label>
            <div class="col-sm-7">
                <input type="file" class="form-control" name="file" />
            </div>
            <div class="col-sm-3">
                <button type="button" class="btn btn-outline-secondary btn-sm view-img" data-img-url="https://via.placeholder.com/150">
                    View Attached Img
                </button>
            </div>
        </div>
        <div class="mb-3 row align-items-center">
            <label class="col-sm-2 col-form-label fw-bold">Date:</label>
            <div class="col-sm-10 text-dark">
                2024-08-27
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".task-form").forEach((form) => {
            form.addEventListener("submit", function(event) {
                event.preventDefault();
                const row = this.closest("tr");
                const status = row.querySelector("select[name='status']").value;
                const fileInput = row.querySelector("input[type='file']");
                const file = fileInput.files[0];

                const formData = new FormData(this);
                if (file) {
                    formData.append("file", file);
                }

                console.log("Form Data:", formData);
                alert("Task updated successfully!");
            });
        });

        document.querySelectorAll(".view-img").forEach((button) => {
            button.addEventListener("click", function() {
                const imageUrl = this.getAttribute("data-img-url");
                const popup = window.open("", "ImagePopup", "width=600,height=400");
                popup.document.write(`
                    <html>
                        <head><title>Image</title></head>
                        <body><img src="${imageUrl}" style="max-width:100%;max-height:100%;" /></body>
                    </html>
                `);
            });
        });
    });
</script>
@endsection