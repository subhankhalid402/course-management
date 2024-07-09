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
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
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

        .header img {
            max-width: 100px;
            height: auto;
        }

        .header .company-details {
            text-align: right;
            font-size: 14px;
        }

        .header .company-details p {
            margin: 0;
        }

        h1 {
            font-size: 32pt;
            margin: 0;
            color: #e15b64;
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
            margin-right: auto
        }

        th {
            background-color: #f2f2f2;
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
            padding: 8px;
            font-weight: bold;
            width: 100% !important;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .label {
            color: #555;
        }

        .data-cell {
            padding-top: 8px;
        }
        .logo {
            width: 65px;
            /* height: 10%; */ 
        }
        .sumlogo {
            width: 170px;
            /* height: 10%; */ 
        }
        .icon {
            width: 10px;
            margin-bottom: -1px;
            /* height: 10%; */ 
        }
        .icon1 {
            width: 15px;
            margin-bottom: -2px;
            /* height: 10%; */ 
        }
        .mainhead {
            /* width: 15px; */
            /* height: 10%; */
            border: 1px solid rgb(156, 155, 155); 
            padding: 20px;
            border-radius: 4px;
        }
        .footer {
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #fff;
            color: #333;
            font-family: Arial, sans-serif;
            font-size: 14px;
            border-top: 1px solid #ccc;
        }
        .web{
            margin-left: -10px;
        }
    </style>
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="header">
                    <table class="mainhead">
                        <tr>
                            <?php 
                                $imagePath = public_path('uploads\taleem.jpg');
                                $imageData = base64_encode(file_get_contents($imagePath));
                                $base64Image = 'data:image/jpeg;base64,' . $imageData;

                                $sumsols = public_path('uploads\sumsols.jpg');
                                $sum64 = base64_encode(file_get_contents($sumsols));
                                $sum64Image = 'data:image/jpeg;base64,' . $sum64;

                                $web = public_path('uploads\web.jpg');
                                $web64 = base64_encode(file_get_contents($web));
                                $web64Image = 'data:image/jpeg;base64,' . $web64;

                                $mail = public_path('uploads\mail.jpg');
                                $mail64 = base64_encode(file_get_contents($mail));
                                $mail64Image = 'data:image/jpeg;base64,' . $mail64;
                            ?>
                            <td><img src="<?php echo $base64Image ?>" alt="Taleem Dost Forum"  class="logo"></td>
                            <td><img src="<?php echo $sum64Image ?>" alt="Sumsols Technologies Logo" class="sumlogo"></td>
                            <td class="company-details">
                                <p class="web"><img src="<?php echo $web64Image ?>" alt="Web Icon" class="icon"> www.sumsols.com <span style="color: white;"> .......................</span></p>
                                <p><img src="<?php echo $mail64Image ?>" alt="Email Icon" class="icon1"> sumsolstechnologies@gmail.com</p>
                            </td>
                        </tr>
                        
                    </table>
                </div>
                <h1>Registration Form</h1>
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
                                    <td class="info">{{ $courses[0]->title ?? 'N/A' }}</td>
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
                    <br>
                    <br>
                    <p>Signature: __________</p>
                </div>
            </div>
            <htmlpagefooter name="page-footer">
                <table class="footer">
                    <tr>
                        <td style="text-align: left;">
                            <p>Sumsols Technologies</p>
                        </td>
                        <td style="text-align: right;">
                            <p>Taleem Dost Forum</p>
                        </td>
                    </tr>
                </table>
                {{-- <div class="footer">
                    <div class="left" style="margin-right: auto; text-align:left; width: 50%;">Sumsols Technologies</div>
                    <div class="right" style="margin-bottom: 15px;">Taleem Dost Forum</div>
                </div> --}}
            </htmlpagefooter>
            <sethtmlpagefooter name="page-footer" value="on" />
        </div>
    </div>
</body>

</html>
