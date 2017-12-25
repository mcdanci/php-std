<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <style type="text/css">
        <!--
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
            The <{$project_name}> has reviewed your registration and we need to request more information from you.
        </td>
    </tr>
    <tr>
        <td class="c3">
            Please provide the following requested materials: <br/>
            <{*TODO*}>
            <ul>
                <{*<label for="a">AAA: </label><input id="a" type="text"/><br/>*}>
                <{*<label for="b">BBB: </label><input id="b" type="text"/><br/>*}>
                <{foreach from=$reason item="reason_entry" key="k"}>
                    <li id="a<{$k + 1}>"><{$k + 1}>: <{$reason_entry}></li>
                <{/foreach}>
            </ul>
        </td>
    </tr>
    <tr>
    <td class="c3">
            Please email requested material to <a href="mailto:<{$email_reply}>"><{$email_reply}></a> with your name and company name in the subject
            line. <br/>
            <label for="n">Name: </label><input id="n" type="text" value="<{$recipient_name_disp}>"/><br/>
            <label for="c">Company : </label><input id="c" type="text" value="<{$company}>"/><br/>
        </td>
    </tr>
    <tr>
        <td class="c3">
            We will review your submitted documents and response within 48 hours.
        </td>
    </tr>
    <tr>
        <td class="c4">
            Please email us your questions and enquires to <a href="mailto:<{$email_reply}>"><{$email_reply}></a>.
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
        <td><{$project_name}></td>
    </tr>
    </tbody>
</table>
</body>
</html>
