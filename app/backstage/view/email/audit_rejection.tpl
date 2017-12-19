<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title></title>
    <style type="text/css">
        * {
            font-size: 14px;
        }

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
            line-height: 22px;
            text-align: justify;
        }

        .c4 {
            line-height: 22px;
            white-space: nowrap;
        }

        .c3 > a {
            color: #C7A06D !important;
        }

        .c3 input {
            border: none;
            border-bottom: 1px solid;
            outline: none;
            width: 90px;
        }

        .c1 {
            text-align: center;
        }
    </style>
</head>
<body>
<table>
    <tbody>
    <tr class="c1">
        <td><img src="img/banner.png" alt="FIS"/></td>
    </tr>
    <tr>
        <td>Dear {{username}},</td>
    </tr>
    <tr>
        <td class="c3">
            The FIS has reviewed your registration and we need to request more information from you.
        </td>
    </tr>
    <tr>
        <td class="c3">
            Please provide the following requested materials: <br/>
            <input type="text"/><br/>
            <input type="text"/><br/>
        </td>
    </tr>
    <tr>
        <td class="c3">
            Please email requested material to admin@sourcethefuture.com with your name and company name in the subject
            line. <br/>
            Name :<input type="text"/><br/>
            Company : <input type="text"/><br/>
        </td>
    </tr>
    <tr>
        <td class="c3">
            We will review your submitted documents and response within 48 hours.
        </td>
    </tr>
    <tr>
        <td class="c4">
            Please email us your questions and enquires to admin@sourcethefuture.cc
        </td>
    </tr>
    <tr>
        <td class="c3">
            Thank you!
        </td>
    </tr>
    <tr>
        <td class="c2">
            Sincerely,
        </td>
    </tr>
    <tr>
        <td>FIS</td>
    </tr>
    </tbody>
</table>
</body>
</html>
