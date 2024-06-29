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
    </style>
</head>

<body>
    <div class="container">
        <h2>STATEMENT OF RECEIPT</h2>
        <div class="form-group">
            <label for="amount">Amount:</label>
            <div id="amount" class="value">{{ $pay->amount }}</div>
        </div>
        <div class="form-group">
            <label for="paid-to">Paid to:</label>
            <div id="paid-to" class="value">{{ $pay->paid_to }}</div>
        </div>
        <div class="form-group">
            <label for="paid-by">Paid by:</label>
            <div id="paid-by" class="value">{{ $pay->paid_by }}</div>
        </div>
        <div class="form-group">
            <label for="for">For (item/service):</label>
            <div id="for" class="value">{{ $pay->item_service }}</div>
        </div>
        <div class="form-group">
            <label for="program">Name of program:</label>
            <div id="program" class="value">{{ $pay->program_name }}</div>
        </div>
        <div class="form-footer">
            <div class="signature">
                <label for="recipient-signature">Signature of Recipient:</label>
                <div id="recipient-signature" class="value">{{ $student->name }}</div>
            </div>
            <div class="date">
                <label for="date">Date:</label>
                <div id="date" class="value">{{ $pay->date }}</div>
            </div>
        </div>
        <div class="form-group">
            <label for="recipient-name">Printed Name of Recipient:</label>
            <div id="recipient-name" class="value">{{ $student->name }}</div>
        </div>
    </div>
</body>

</html>
