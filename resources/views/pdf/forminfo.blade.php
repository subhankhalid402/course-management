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
            font-family: 'Helvetica', sans-serif;
            font-size: 15px;
            color: #333;
        }

        .page {
            /* width: 210mm; */
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        .subpage {
            padding: 8mm;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 32pt;
            margin: 0;
            color: #e15b64;
        }

        .header p {
            font-size: 16pt;
            color: #666;
        }

        table {
            width: 100%;
        }

        td {
            padding: 8px;
        }

        th,
        td {
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            /* font-weight: bold; */
        }

        .footer {
            text-align: right;
            margin-top: 50px;
        }

        .footer p {
            margin: 0;
            font-size: 12pt;
            color: #555;
        }

        .info {
            /* border: 1px solid #797474; */
            padding: 8px;
            font-weight: bold;
            width: 100% !important;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .label {
            /* font-weight: bold; */
            color: #555;
        }

        .data-cell {
            padding-top: 8px;
        }
    </style>
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="header">
                    <h1>Registration Form</h1>
                </div>
                <table>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td class="label">Name:</td>
                                </tr>
                                <tr>
                                    <td class="info">{{ $student->name ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td class="label">Date of Birth:</td>
                                </tr>
                                <tr>
                                    <td class="info">{{ $student->dob ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td class="label">Phone Number:</td>
                                </tr>
                                <tr>
                                    <td class="info">{{ $student->phone ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td class="label">Email:</td>
                                </tr>
                                <tr>
                                    <td class="info">{{ $student->email ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td class="label">Address:</td>
                                </tr>
                                <tr>
                                    <td class="info">{{ $student->address ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td class="label">CNIC:</td>
                                </tr>
                                <tr>
                                    <td class="info">{{ $student->cnic ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td class="label">Education:</td>
                                </tr>
                                <tr>
                                    <td class="info">{{ $student->education ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td class="label">Courses:</td>
                                </tr>
                                <tr>
                                    <td class="info">{{ $course[0]->title ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td class="label">Admission Date:</td>
                                </tr>
                                <tr>
                                    <td class="info">{{ $student->admission_date ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td class="label">Batch:</td>
                                </tr>
                                <tr>
                                    <td class="info">{{ $student->batch->title ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div class="footer">
                    {{-- <p>Date: __________</p> --}}
                    <br>
                    <br>
                    <p>Signature: __________</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
