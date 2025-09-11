@extends('service-partner.base_layout')

@section('content')
    <div class="container">
        <div class="mb-4">
            <h2 class="fw-bold">Project Timeline: {{ $projectPlannerTasks->plist_projectid }}</h2>
        </div>
        </br>

        <div class="container mt-5">
            <form class="task-form text-pseudo bg-light p-4 rounded shadow-sm" method="POST"
                action="{{ route('update.task') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="pptasks_id" value="{{ $task->pptasks_id }}">

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

                <h4 class="text-center text-dark mb-4">
                    Task: <span class="text-pseudo fw-bold">{{ $task->pptasks_task_title }}</span>
                </h4>

                <!-- Status Dropdown -->
                <div class="mb-3 row align-items-center">
                    <label for="status" class="col-sm-2 col-form-label fw-bold">Status:</label>
                    <div class="col-sm-10">
                        <select class="form-select form-select-sm" id="status" name="pptasks_sp_status" required>
                            <option value="" {{ $task->pptasks_sp_status == '' ? 'selected' : '' }}>Select Status</option>
                            <option value="Not Started" {{ $task->pptasks_sp_status == 'Not Started' ? 'selected' : '' }}>Not
                                Started</option>
                            <option value="On Going" {{ $task->pptasks_sp_status == 'On Going' ? 'selected' : '' }}>On Going
                            </option>
                            <option value="Fullfilled" {{ $task->pptasks_sp_status == 'Fullfilled' ? 'selected' : '' }}>
                                Fullfilled</option>
                            <option value="Scrapped" {{ $task->pptasks_sp_status == 'Scrapped' ? 'selected' : '' }}>Scrapped
                            </option>
                        </select>
                    </div>
                </div>

                <!-- File Upload -->
                <div class="mb-3 row align-items-center">
                    <label for="file" class="col-sm-2 col-form-label fw-bold">Proof of Completion:</label>
                    <div class="col-sm-7">
                        <input type="file" class="form-control" name="pptasks_proof_of_completion" id="fileUpload" />
                    </div>
                    <div class="col-sm-3 d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="viewFileBtn">
                            Preview New File
                        </button>
                        @if($task->pptasks_proof_of_completion)
                            <a href="{{ route('task.proof', $task->pptasks_id) }}" target="_blank"
                                class="btn btn-outline-success btn-sm">
                                View Existing File
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Date Display -->
                <div class="mb-3 row align-items-center">
                    <label class="col-sm-2 col-form-label fw-bold">Date:</label>
                    <div class="col-sm-10 text-dark">
                        {{ $currentDate }}
                    </div>
                </div>

                <!-- Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

            <!-- New File Preview -->
            <div id="filePreviewArea" class="mt-3 text-center" style="display: none;"></div>

            <!-- Existing File Preview -->
            @if($task->pptasks_proof_of_completion)
                <div id="existingFilePreviewArea" class="mt-4 text-center">
                    <h5 class="fw-bold text-success">Existing File Preview:</h5>
                    @php
                        $base64 = base64_encode($task->pptasks_proof_of_completion);
                        $finfo = new finfo(FILEINFO_MIME_TYPE);
                        $mime = $finfo->buffer($task->pptasks_proof_of_completion) ?? 'application/octet-stream';
                        $src = "data:$mime;base64,$base64";
                    @endphp

                    @if(str_starts_with($mime, 'image/'))
                        <img src="{{ $src }}" alt="Existing Proof" style="max-width: 100%; max-height: 500px;" />
                    @elseif($mime === 'application/pdf')
                        <iframe src="{{ $src }}" style="width: 100%; height: 500px; border: none;"></iframe>
                    @else
                        <p class="text-muted">Cannot preview this file type directly.
                            <a href="{{ route('task.proof', $task->pptasks_id) }}" target="_blank">Download</a> instead.
                        </p>
                    @endif
                </div>
            @endif

        </div>

        <br><br>

        <!-- Comments Section -->
        <p class="text-pseudo fw-bold">Comments :</p>
        <div class="w-100 p-2" style="height: 400px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;">
            <div class="card p-2 mb-2">
                <form action="{{ route('sp.comment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="tconv_comment_by_sp_id" value="{{ session('sp_user_id') }}">
                    <input type="hidden" name="tconv_task_id" value="{{ $task->pptasks_id }}">
                    <div class="mb-2">
                        <textarea class="form-control w-100" name="tconv_comment" rows="3"
                            placeholder="Write a comment"></textarea>
                    </div>
                    <input class="btn btn-sm btn-outline-primary mt-1 w-25" type="submit" value="Post">
                </form>
            </div>

            @foreach ($SpComments as $comment)
                <div class="card p-2 mb-2">
                    <p class="fw-bold">{{ $comment->tconv_sp_name }} :</p>
                    <p class="fw-bold">{{ $comment->tconv_comment_date_time }}</p>
                    <p>{{ $comment->tconv_comment }}</p>
                </div>
            @endforeach
        </div>

        <!-- Styles -->
        <style>
            #filePreviewArea {
                max-height: 500px;
                overflow: auto;
                border: 1px solid #ddd;
                padding: 10px;
                background-color: #fff;
                margin-top: 20px;
                width: 100%;
            }

            iframe {
                width: 100% !important;
                height: 500px;
                border: none;
            }

            #filePreviewArea table {
                min-width: 800px;
                width: max-content;
                border-collapse: collapse;
                margin: auto;
            }

            #filePreviewArea th,
            #filePreviewArea td {
                white-space: nowrap;
                padding: 6px 12px;
                border: 1px solid #ccc;
                text-align: left;
            }

            body {
                overflow-x: hidden;
            }
        </style>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/papaparse@5.4.1/papaparse.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
        <script>
            document.getElementById('viewFileBtn').addEventListener('click', function () {
                const fileInput = document.getElementById('fileUpload');
                const previewArea = document.getElementById('filePreviewArea');
                previewArea.innerHTML = '';  // Clear previous preview

                if (!fileInput.files.length) {
                    // No new file selected: hide preview area & note
                    previewArea.style.display = 'none';
                    return;
                }

                // Show preview area & insert the note
                previewArea.style.display = 'block';

                const note = document.createElement('h5');
                note.className = 'fw-bold text-danger mb-3';
                note.textContent = 'Note: Uploading a new file will replace the existing file.';
                previewArea.appendChild(note);

                const file = fileInput.files[0];
                const fileType = file.type;
                const fileName = file.name.toLowerCase();

                // PDF preview
                if (fileType === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const iframe = document.createElement('iframe');
                        iframe.src = e.target.result;
                        iframe.style.width = '100%';
                        iframe.style.height = '500px';
                        iframe.style.border = 'none';
                        previewArea.appendChild(iframe);
                    };
                    reader.readAsDataURL(file);
                }

                // CSV preview
                else if (fileName.endsWith('.csv')) {
                    Papa.parse(file, {
                        header: true,
                        complete: function (results) {
                            if (results.data.length === 0) {
                                previewArea.innerHTML += '<p class="text-muted">CSV is empty.</p>';
                                return;
                            }

                            let table = '<table class="table table-bordered table-sm"><thead><tr>';
                            const headers = Object.keys(results.data[0]);
                            headers.forEach(header => table += `<th>${header}</th>`);
                            table += '</tr></thead><tbody>';

                            results.data.slice(0, 10).forEach(row => {
                                table += '<tr>';
                                headers.forEach(header => table += `<td>${row[header] ?? ''}</td>`);
                                table += '</tr>';
                            });

                            table += '</tbody></table>';
                            previewArea.innerHTML += table;
                        }
                    });
                }

                // XLSX preview
                else if (fileName.endsWith('.xlsx')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const data = new Uint8Array(e.target.result);
                        const workbook = XLSX.read(data, { type: 'array' });
                        const sheetName = workbook.SheetNames[0];
                        const sheet = workbook.Sheets[sheetName];
                        const json = XLSX.utils.sheet_to_json(sheet, { header: 1 });

                        if (json.length === 0) {
                            previewArea.innerHTML += '<p class="text-muted">XLSX is empty.</p>';
                            return;
                        }

                        let table = '<table class="table table-bordered table-sm"><thead><tr>';
                        json[0].forEach(header => table += `<th>${header}</th>`);
                        table += '</tr></thead><tbody>';

                        json.slice(1, 11).forEach(row => {
                            table += '<tr>';
                            row.forEach(cell => table += `<td>${cell ?? ''}</td>`);
                            table += '</tr>';
                        });

                        table += '</tbody></table>';
                        previewArea.innerHTML += table;
                    };
                    reader.readAsArrayBuffer(file);
                }

                // Image preview
                else if (fileType.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100%';
                        img.style.maxHeight = '500px';
                        previewArea.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }

                // Fallback for unsupported files
                else {
                    previewArea.innerHTML += `
                        <p class="text-muted">File cannot be previewed, but will be uploaded.</p>
                        <p><strong>File Name:</strong> ${file.name}</p>
                        <p><strong>File Type:</strong> ${file.type || 'Unknown'}</p>
                    `;
                }
            });
        </script>
    </div>
@endsection