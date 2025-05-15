@extends('service-partner.base_layout')

@section('content')
    <div class="container">
        <div class="mb-4">
            {{-- <h2>Project Timeline: <Project ID: {{ $projectPlannerTasks->plist_projectid }}> </h2> --}}
            <h2>Project Timeline: {{ $projectPlannerTasks->plist_projectid }}</h2>
        </div>
        </br>

        <div class="container mt-5">
            <form class="task-form text-pseudo bg-light p-4 rounded shadow-sm" method="POST"
                action="{{ route('update.task') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="pptasks_id" value="{{ $task->pptasks_id }}">

                <h4 class="text-center text-dark mb-4">
                    Task: <span class="text-pseudo fw-bold">{{  $task->pptasks_task_title }}</span>
                </h4>

                <!-- Status -->
                <div class="mb-3 row align-items-center">
                    <label for="status" class="col-sm-2 col-form-label fw-bold">Status:</label>
                    <div class="col-sm-10">
                        <select class="form-select form-select-sm" id="status" name="pptasks_sp_status" required>
                            <option value="" selected>Select Status</option>
                            <option value="Not Started">Not Started</option>
                            <option value="On Going">On Going</option>
                            <option value="Fullfilled">Fullfilled</option>
                            <option value="Scrapped">Scrapped</option>
                        </select>
                    </div>
                </div>

                <!-- File Upload -->
                <div class="mb-3 row align-items-center">
                    <label for="file" class="col-sm-2 col-form-label fw-bold">Proof of Completion:</label>
                    <div class="col-sm-7">
                        <input type="file" class="form-control" name="pptasks_proof_of_completion" id="fileUpload"
                            accept=".pdf,.csv,.xlsx" />
                    </div>
                    <div class="col-sm-3">
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="viewFileBtn">
                            View Attached File
                        </button>
                    </div>
                </div>

                <!-- Static Date Display -->
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

            <!-- File preview area -->
            <div id="filePreviewArea" class="mt-3 text-center" style="display: none;"></div>
        </div>

        <!-- File Preview Styles -->
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

            iframe {
                width: 100% !important;
                height: 500px;
                border: none;
            }

            body {
                overflow-x: hidden;
            }
        </style>

        <!-- File Preview Logic -->
        <script>
            document.getElementById('viewFileBtn').addEventListener('click', function () {
                const fileInput = document.getElementById('fileUpload');
                const previewArea = document.getElementById('filePreviewArea');
                const file = fileInput.files[0];

                previewArea.innerHTML = '';

                if (!file) {
                    previewArea.style.display = 'none';
                    previewArea.innerHTML = '<p class="text-danger fw-bold">No file has been uploaded. Please upload a file.</p>';
                    return;
                }

                previewArea.style.display = 'block';

                const fileType = file.type;
                const fileName = file.name.toLowerCase();

                if (fileType === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const iframe = document.createElement('iframe');
                        iframe.src = e.target.result;
                        previewArea.appendChild(iframe);
                    };
                    reader.readAsDataURL(file);

                } else if (fileName.endsWith('.csv')) {
                    Papa.parse(file, {
                        header: true,
                        complete: function (results) {
                            if (results.data.length === 0) {
                                previewArea.innerHTML = '<p class="text-muted">CSV is empty.</p>';
                                return;
                            }

                            let table = '<table class="table table-bordered table-sm"><thead><tr>';
                            const headers = Object.keys(results.data[0]);

                            headers.forEach(header => {
                                table += `<th>${header}</th>`;
                            });
                            table += '</tr></thead><tbody>';

                            results.data.slice(0, 10).forEach(row => {
                                table += '<tr>';
                                headers.forEach(header => {
                                    table += `<td>${row[header] ?? ''}</td>`;
                                });
                                table += '</tr>';
                            });

                            table += '</tbody></table>';
                            previewArea.innerHTML = table;
                        }
                    });

                } else if (fileName.endsWith('.xlsx')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const data = new Uint8Array(e.target.result);
                        const workbook = XLSX.read(data, { type: 'array' });
                        const sheetName = workbook.SheetNames[0];
                        const sheet = workbook.Sheets[sheetName];
                        const json = XLSX.utils.sheet_to_json(sheet, { header: 1 });

                        if (json.length === 0) {
                            previewArea.innerHTML = '<p class="text-muted">XLSX is empty.</p>';
                            return;
                        }

                        let table = '<table class="table table-bordered table-sm"><thead><tr>';
                        json[0].forEach(header => {
                            table += `<th>${header}</th>`;
                        });
                        table += '</tr></thead><tbody>';

                        json.slice(1, 11).forEach(row => {
                            table += '<tr>';
                            row.forEach(cell => {
                                table += `<td>${cell ?? ''}</td>`;
                            });
                            table += '</tr>';
                        });

                        table += '</tbody></table>';
                        previewArea.innerHTML = table;
                    };
                    reader.readAsArrayBuffer(file);

                } else {
                    previewArea.innerHTML = '<p class="text-warning">Unsupported file type.</p>';
                }
            });
        </script>

        <!-- CSV & XLSX Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/papaparse@5.4.1/papaparse.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
@endsection
