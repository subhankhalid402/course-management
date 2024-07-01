<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <style>
        @font-face {
            font-family: 'Arialmt';
            src: url('vendor/mpdf/ttfonts/arial-mt/arialmt.ttf');
        }

        @font-face {
            font-family: 'Cambria';
            src: url('vendor/mpdf/ttfonts/cambria/Cambria.ttf');
        }

        @font-face {
            font-family: 'Helvetica';
            src: url('vendor/mpdf/ttfonts/Helvetica/Helvetica.ttf');
        }

        body {
            width: 100%;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            font-family: 'Helvetica';
            font-size: 12px;
            color: #333;
        }

        .page {
            width: 190mm;
            margin: 10mm auto;
            margin-top: 7px;
            padding: 20mm;
            background-color: #fff;
            border-radius: 8px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        .subpage {
            /* padding: 10mm; */
        }

        @page {
            header: page-header;
            footer: page-footer;
        }

        .form-group {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .form-group label {
            flex: 1 0 30%;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group p {
            flex: 1 0 70%;
            padding: 8px;
            font-size: 12pt;
            background-color: #eaeef1;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #555;
            margin: 0;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .form-column {
            flex: 0 0 48%;
        }

        .form-group ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .form-group ul li {
            background-color: #eaeef1;
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #555;
        }

        .text-center {
            text-align: center;
        }

        .contract-title {
            font-size: 24pt;
            border-bottom: 3px solid #9c27b0;
            margin-top: 30px;
            margin-bottom: 30px;
            text-align: center;
            color: #9c27b0;
        }
    </style>
</head>
<body>
<div class="book">
    <div class="page">
        <div class="subpage">
            <h1 class="contract-title">Student Information</h1>
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <p id="name">{{ $student->name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <p id="dob">{{ $student->dob ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <p id="phone">{{ $student->phone ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <p id="email">{{ $student->email ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <p id="address">{{ $student->address ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="cnic">CNIC:</label>
                        <p id="cnic">{{ $student->cnic ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="education">Education:</label>
                        <p id="education">{{ $student->education ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="courses">Courses:</label>
                        <ul>
                            <li>{{ $course[0]->title ?? 'N/A' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="admission_date">Admission Date:</label>
                        <p id="admission_date">{{ $student->admission_date ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="form-column">
                    <div class="form-group">
                        <label for="batch">Batch:</label>
                        <p id="batch">{{ $student->batch->title ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
