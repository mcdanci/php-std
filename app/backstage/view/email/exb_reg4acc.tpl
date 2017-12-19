<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title></title>
    <style type="text/css">
        table {
            width: 595px;
            margin: 0 auto;
        }

        table > tbody > tr:not(.c1) > td {
            padding: 0px 50px;
        }

        table > tbody > tr > td:not(.c2) {
            padding-bottom: 30px;
        }

        .c3 {
            line-height: 30px;
            text-align: justify;
        }
    </style>
</head>
<body>
<table>
    <tbody>
    <tr class="c1">
        <td><img src="img/banner.png" alt=""/></td>
    </tr>
    <tr>
        <td>Dear {{username}},</td>
    </tr>
    <tr>
        <td class="c3">Thank you for registering to exhibit at the FIS! Your account name is {{accName}}. We will review
            your registration details and respond within 48 business hours.
        </td>
    </tr>
    <tr>
        <td class="c2">Sincerely,</td>
    </tr>
    <tr>
        <td>FIS</td>
    </tr>


    </tbody>
</table>
</body>
</html>
