@extends('service-partner.base_layout')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2>Project Timeline: &lt;Project ID&gt;</h2>
    </div>
    <br><br>
    <table class="table table-hover" id="myTable" >
        <thead>
            <tr class="text-pseudo">
                <th scope="col">Task</th>
                <th scope="col">Status</th>
                <th scope="col">Proof of Completion</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody >
            <tr>
                <form class="task-form" method="POST" action="/update-task">
                    @csrf
                    <td>Hardware Market Place</td>
                    <td>
                        <select class="form-select" name="status" required>
                            <option value="" selected></option>
                            <option value="not-started">Not Started</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </td>
                    <td>
                        <input type="file" class="form-control" name="file" />
                        <button type="button" class="btn btn-link view-img" data-img-url="https://via.placeholder.com/150">View attached Img</button>
                    </td>
                    <td>2024-08-27</td>
                    <td><button type="submit" class="btn btn-primary update-btn">Update</button></td>
                </form>
            </tr>
            <tr>
                <form class="task-form" method="POST" action="/update-task">
                    @csrf
                    <td>ABCD Place</td>
                    <td>
                        <select class="form-select" name="status" required>
                            <option value="" selected></option>
                            <option value="not-started">Not Started</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </td>
                    <td>
                        <input type="file" class="form-control" name="file" />
                        <button type="button" class="btn btn-link view-img" data-img-url="https://via.placeholder.com/150">View attached Img</button>
                    </td>
                    <td>2024-08-27</td>
                    <td><button type="submit" class="btn btn-primary update-btn">Update</button></td>
                </form>
            </tr>
            <!-- Add similar rows for other tasks, repeating the form structure -->
        </tbody>
    </table>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Handle individual form submission
    document.querySelectorAll(".task-form").forEach(form => {
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Prevent default form submission

            const row = this.closest("tr");
            const status = row.querySelector("select[name='status']").value;
            const fileInput = row.querySelector("input[type='file']");
            const file = fileInput.files[0];

            

            // Simulate form submission
            const formData = new FormData(this);
            if (file) {
                formData.append("file", file);
            }

            // Log data for debugging
            console.log("Form Data:", formData);

            // Simulate a successful form submission
            alert("Task updated successfully!");

            // You can add a real form submission here if required
            // fetch(this.action, {
            //     method: 'POST',
            //     body: formData,
            //     headers: {
            //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            //     }
            // }).then(response => {
            //     console.log(response);
            //     alert('Form submitted successfully!');
            // }).catch(error => {
            //     console.error('Error submitting form:', error);
            // });
        });
    });

    // Handle view image button click
    document.querySelectorAll(".view-img").forEach(button => {
        button.addEventListener("click", function () {
            const imageUrl = this.getAttribute("data-img-url");
            const popup = window.open("", "ImagePopup", "width=600,height=400");
            popup.document.write(`<html><head><title>Image</title></head><body><img src="${imageUrl}" style="max-width:100%;max-height:100%;" /></body></html>`);
        });
    });
});
</script>
@endsection
