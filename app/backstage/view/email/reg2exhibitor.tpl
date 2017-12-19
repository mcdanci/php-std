<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <style type="text/css">
        <!--
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

        -->
    </style>
    <title><{$email.subject}></title>
</head>

<body>
<table>
    <tbody>
    <tr class="c1">
        <td><img src="<{$url.img_banner}>" alt="<{$project_name}>"/></td>
    </tr>
    <tr>
        <td>Dear <{$recipient_name_disp}>,</td>
    </tr>
    <tr>
        <td class="c3">
            Thank you for registering to exhibit at the <{$project_name}>!
            Your account name is <{$recipient_email_addr}>.
            We will review your registration details and respond within 48 business hours.
        </td>
    </tr>
    <tr>
        <td class="c2">Sincerely,</td>
    </tr>
    <tr>
        <td><{$project_name}></td>
    </tr>
    </tbody>
</table>
</body>
</html>
