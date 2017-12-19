<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
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

        .c3 > a {
            color: #C7A06D !important;
        }

        .c1 {
            text-align: center;
        }

        .b1 {
            padding-bottom: 5px !important;
            font-weight: bold;
        }
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
            Welcome to the <{$project_name}> and thank you for your payment.
            An official confirmation letter of your payment has been attached in this email.
        </td>
    </tr>
    <tr>
        <td class="c3">
            It is our mission to showcase the best materials.
            Machinery.
            Manufacturing process and all NEW products from the best to international brands and footwear manufacturers
            in our show, so let us help you achieve your goals and expand your business.
        </td>
    </tr>
    <tr>
        <td class="c3">
            To begin preparing for your exhibition, please follow the instructions below:
        </td>
    </tr>
    <tr>
        <td class="b1">
            Exhibitor Kit
        </td>
    </tr>
    <tr>
        <td class="c3">
            Please order any equipment or services on our Exhibitor Kit here. (coming soon)
        </td>
    </tr>
    <tr>
        <td class="c3">
            List of items can be purchased on the Exhibitor Kit <br/>
            1）Booth Decorations<br/>
            2）Wi-Fi<br/>
            3）Electrical Setup <br/>
            4）Cleaning Service<br/>
    </tr>
    <tr>
        <td class="c3">
            If you need help or suggestion about purchasing from the kit,
            please contact us at <a href="<{$url.website}>"><{$website_name}></a>
            our US team or partners in China will come back to you.
        </td>
    </tr>
    <tr>
        <td class="b1">
            Machinery Evaluation
        </td>
    </tr>
    <tr>
        <td class="c3">
            If you are showcasing any machinery at the <{$project_name}>,
            you must inform us at least 3 months prior to the event date by June 30, 2018,
            so we can evaluate your machinery and provide you with international freight
            forwarder contact list.
        </td>
    </tr>
    <tr>
    <tr>
        <td class="b1">
            Advertisement Opportunities
        </td>
    </tr>
    <tr>
        <td class="c3">
            There are various advertising channels at the <{$project_name}>.
            Please email us at <a href="mailto:<{$email_reply}>"><{$email_reply}></a> for more
            information If you would like to advertise your company/your brand
        </td>
    </tr>
    <tr>
        <td class="b1">
            Keep up with the Deadlines.
        </td>
    </tr>
    <tr>
        <td class="c3">
            We have provided you a list of deadline for various in this email.
        </td>
    </tr>
    <tr>
        <td class="c3">
            Thank you for exhibiting at the <{$project_name}>,
            we are very exited to help you showcase your best materials to the
            world of footwear professionals!
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
