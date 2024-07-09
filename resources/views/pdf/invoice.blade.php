<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
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


        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group .value {
            padding: 5px 10px;
            background-color: #eaeef1;
            border-radius: 3px;
        }

        .form-footer {
            margin-top: 20px;
        }

        .form-footer .signature,
        .form-footer .date {
            display: inline-block;
            width: 48%;
        }

        .form-footer .signature {
            margin-right: 4%;
        }

        .form-footer .date {
            text-align: right;
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

    </style>
</head>

<body>
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
                <td><img src="<?php echo $base64Image; ?>" alt="Taleem Dost Forum" class="logo"></td>
                <td><img src="<?php echo $sum64Image; ?>" alt="Sumsols Technologies Logo" class="sumlogo"></td>
                <td class="company-details">
                    <p class="web"><img src="<?php echo $web64Image; ?>" alt="Web Icon" class="icon"> www.sumsols.com
                        <span style="color: white;"> .......................</span></p>
                    <p><img src="<?php echo $mail64Image; ?>" alt="Email Icon" class="icon1"> sumsolstechnologies@gmail.com</p>
                </td>
            </tr>

        </table>
    </div>
    <div class="container">
        <h2>STATEMENT OF RECEIPT</h2>
        <div class="form-group">
            <label for="amount">Amount:</label>
            <div id="amount" class="value">{{ $pay->amount ?? '' }}</div>
        </div>
        <div class="form-group">
            <label for="paid-to">Paid to:</label>
            <div id="paid-to" class="value">{{ $pay->paid_to ?? '' }}</div>
        </div>
        <div class="form-group">
            <label for="paid-by">Paid by:</label>
            <div id="paid-by" class="value">{{ $pay->paid_by ?? '' }}</div>
        </div>
        <div class="form-group">
            <label for="for">For (item/service):</label>
            <div id="for" class="value">{{ $pay->item_service ?? 'Course' }}</div>
        </div>
        <div class="form-group">
            <label for="program">Name of Course:</label>
            <div id="program" class="value">{{ $course[0]->title ?? '' }}</div>
        </div>
        <div class="form-footer">
            <div class="signature">
                <label for="recipient-signature">Signature of Recipient:</label>
                <div id="recipient-signature" class="value">{{ '' }}</div>
            </div>
            <div class="date">
                <label for="date">Date: {{ $pay->created_at ? $pay->created_at->format('F j, Y') : '' }}</label>
                {{-- <div id="date" class="value"> {{ $pay->created_at ? $pay->created_at->format('F j, Y, g:i a') : '' }}</div> --}}
            </div>
        </div>
        <div class="form-group">
            <label for="recipient-name">Printed Name of Recipient:</label>
            <div id="recipient-name" class="value">{{ $student->name ?? '' }}</div>
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
</body>

</html>
