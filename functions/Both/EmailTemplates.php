<?php
class EmailTemplates
{

    public function accountCreated($accountName, $tpassword, $link, $username)
    {
        return '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        
        <head>
            <!--[if gte mso 9]>
        <xml>
          <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <!--[if !mso]><!-->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--<![endif]-->
            <title></title>
        
            <style type="text/css">
                @media only screen and (min-width: 570px) {
                    .u-row {
                        width: 550px !important;
                    }
        
                    .u-row .u-col {
                        vertical-align: top;
                    }
        
                    .u-row .u-col-100 {
                        width: 550px !important;
                    }
        
                }
        
                @media (max-width: 570px) {
                    .u-row-container {
                        max-width: 100% !important;
                        padding-left: 0px !important;
                        padding-right: 0px !important;
                    }
        
                    .u-row .u-col {
                        min-width: 320px !important;
                        max-width: 100% !important;
                        display: block !important;
                    }
        
                    .u-row {
                        width: calc(100% - 40px) !important;
                    }
        
                    .u-col {
                        width: 100% !important;
                    }
        
                    .u-col>div {
                        margin: 0 auto;
                    }
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                table,
                tr,
                td {
                    vertical-align: top;
                    border-collapse: collapse;
                }
        
                p {
                    margin: 0;
                }
        
                .ie-container table,
                .mso-container table {
                    table-layout: fixed;
                }
        
                * {
                    line-height: inherit;
                }
        
                a[x-apple-data-detectors="true"] {
                    color: inherit !important;
                    text-decoration: none !important;
                }
        
                table,
                td {
                    color: #000000;
                }

                #u_body {
                    height: 450px;
                }
        
                #u_body a {
                    color: #0000ee;
                    text-decoration: none;
                    margin-top: 10px;
                    margin-bottom: 10px;
                }

                #u_body a > span > span {
                    padding: 10px 15px;
                    border: 2px solid white;
                    border-radius: 50px;
                    background-color: #1daf5e;
                    color: #eee;
                }
        
                @media (max-width: 480px) {
                    #u_content_image_2 .v-src-width {
                        width: auto !important;
                    }
        
                    #u_content_image_2 .v-src-max-width {
                        max-width: 55% !important;
                    }
                }
            </style>
        
        
        
            <!--[if !mso]><!-->
            <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" type="text/css">
            <!--<![endif]-->
        
        </head>
        
        <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #afc6f0;color: #000000">
            <!--[if IE]><div class="ie-container"><![endif]-->
            <!--[if mso]><div class="mso-container"><![endif]-->
            <table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #afc6f0;width:100%" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr style="vertical-align: top">
                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #afc6f0;"><![endif]-->
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="padding-top: 15px; Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: transparent;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table id="u_content_image_2" style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:25px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;" align="center">
        
                                                                                <img align="center" border="0" src="cid:image-1.png" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 29%;max-width: 145px;" width="145" class="v-src-width v-src-max-width" />
        
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #3b71ca;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #3b71ca;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:15px 10px 10px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <h1 style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: book antiqua,palatino; font-size: 35px;">
                                                                        Welcome! ' . $accountName . '
                                                                    </h1>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 10px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <h3 style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: book antiqua,palatino; font-size: 18px;">
                                                                        <div>your account has been created</div>
                                                                    </h3>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #3b71ca;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #3b71ca;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 40px 20px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <div style="color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
                                                                    <p style="font-size: 14px; line-height: 140%;">Username: ' . $username . '</p>
                                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px;">Temporary Password: ' . $tpassword . '</span></p>
                                                                        <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Please use the given temporary password above to activate your account.</span></p>
                                                                        <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Thank you.</span></p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table style="font-family:"Lato",sans-serif; margin-top: 15px; margin-bottom: 15px;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <!--[if mso]><style>.v-button {background: transparent !important;}</style><![endif]-->
                                                                    <div align="center">
                                                                        <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:40px; v-text-anchor:middle; width:272px;" arcsize="100%"  strokecolor="#ffffff" strokeweight="3px" fillcolor="#3b71ca"><w:anchorlock/><center style="color:#ffffff;font-family:"Lato",sans-serif;"><![endif]-->
                                                                        <a href="' . $link . '" target="_blank" class="v-button" style="box-sizing: border-box;display: inline-block;font-family:"Lato",sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #ffffff; background-color: #3b71ca; border-radius: 40px;-webkit-border-radius: 40px; -moz-border-radius: 40px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;border-top-width: 3px; border-top-style: solid; border-top-color: #ffffff; border-left-width: 3px; border-left-style: solid; border-left-color: #ffffff; border-right-width: 3px; border-right-style: solid; border-right-color: #ffffff; border-bottom-width: 3px; border-bottom-style: solid; border-bottom-color: #ffffff;">
                                                                            <span style="display:block;padding:10px 30px; margin-top: 15px; margin-bottom: 15px;line-height:120%;"><span style="font-size: 16px; line-height: 19.2px; font-family: Lato, sans-serif;">Click here to Activate Account</span></span>
                                                                        </a>
                                                                        <!--[if mso]></center></v:roundrect><![endif]-->
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        

                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #ffffff;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 15px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <div style="color: #7e8c8d; line-height: 100%; text-align: center; word-wrap: break-word;">
                                                                        <p style="font-size: 14px; line-height: 100%;">© 2022</p>
                                                                        <p style="font-size: 14px; line-height: 100%;"><span style="font-size: 10px; line-height: 10px;">CONFIDENTIALITY NOTICE: The contents of this email are confidential and privileged and is intended for the exclusive use of the original recipient. If you are not the intended recipient, please notify the sender immediately and do not disclose the contents to anyone and make copies thereof.</span></p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
        
                                        </div>
                                    </div>
                                </div>
        
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>
        
        </html>
        ';
    }

    public function accountDisabled($accountName)
    {
        return '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        
        <head>
            <!--[if gte mso 9]>
        <xml>
          <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <!--[if !mso]><!-->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--<![endif]-->
            <title></title>
        
            <style type="text/css">
                @media only screen and (min-width: 570px) {
                    .u-row {
                        width: 550px !important;
                    }
        
                    .u-row .u-col {
                        vertical-align: top;
                    }
        
                    .u-row .u-col-100 {
                        width: 550px !important;
                    }
        
                }
        
                @media (max-width: 570px) {
                    .u-row-container {
                        max-width: 100% !important;
                        padding-left: 0px !important;
                        padding-right: 0px !important;
                    }
        
                    .u-row .u-col {
                        min-width: 320px !important;
                        max-width: 100% !important;
                        display: block !important;
                    }
        
                    .u-row {
                        width: calc(100% - 40px) !important;
                    }
        
                    .u-col {
                        width: 100% !important;
                    }
        
                    .u-col>div {
                        margin: 0 auto;
                    }
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                table,
                tr,
                td {
                    vertical-align: top;
                    border-collapse: collapse;
                }
        
                p {
                    margin: 0;
                }
        
                .ie-container table,
                .mso-container table {
                    table-layout: fixed;
                }
        
                * {
                    line-height: inherit;
                }
        
                a[x-apple-data-detectors="true"] {
                    color: inherit !important;
                    text-decoration: none !important;
                }
        
                table,
                td {
                    color: #000000;
                }

                #u_body {
                    height: 450px;
                }
        
                #u_body a {
                    color: #0000ee;
                    text-decoration: none;
                    margin-top: 10px;
                    margin-bottom: 10px;
                }

                #u_body a > span > span {
                    padding: 10px 15px;
                    border: 2px solid white;
                    border-radius: 50px;
                    background-color: #1daf5e;
                    color: #eee;
                }
        
                @media (max-width: 480px) {
                    #u_content_image_2 .v-src-width {
                        width: auto !important;
                    }
        
                    #u_content_image_2 .v-src-max-width {
                        max-width: 55% !important;
                    }
                }
            </style>
        
        
        
            <!--[if !mso]><!-->
            <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" type="text/css">
            <!--<![endif]-->
        
        </head>
        
        <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #afc6f0;color: #000000">
            <!--[if IE]><div class="ie-container"><![endif]-->
            <!--[if mso]><div class="mso-container"><![endif]-->
            <table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #afc6f0;width:100%" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr style="vertical-align: top">
                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #afc6f0;"><![endif]-->
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="padding-top: 15px; Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: transparent;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table id="u_content_image_2" style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:25px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;" align="center">
        
                                                                                <img align="center" border="0" src="cid:image-2.png" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 29%;max-width: 145px;" width="145" class="v-src-width v-src-max-width" />
        
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #3b71ca;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #3b71ca;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:15px 10px 10px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <h1 style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: book antiqua,palatino; font-size: 35px;">
                                                                        Hello! ' . $accountName . '
                                                                    </h1>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 10px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <h3 style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: book antiqua,palatino; font-size: 18px;">
                                                                        <div>your account has been disabled</div>
                                                                    </h3>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #3b71ca;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #3b71ca;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 40px 20px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <div style="color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
                                                                        <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">We regret to inform you that your account has been temporarily disabled. Please contact our system administrator if you have any questions.</span></p>
                                                                        <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Thank you.</span></p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        

                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #ffffff;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 15px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <div style="color: #7e8c8d; line-height: 100%; text-align: center; word-wrap: break-word;">
                                                                        <p style="font-size: 14px; line-height: 100%;">© 2022</p>
                                                                        <p style="font-size: 14px; line-height: 100%;"><span style="font-size: 10px; line-height: 10px;">CONFIDENTIALITY NOTICE: The contents of this email are confidential and privileged and is intended for the exclusive use of the original recipient. If you are not the intended recipient, please notify the sender immediately and do not disclose the contents to anyone and make copies thereof.</span></p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
        
                                        </div>
                                    </div>
                                </div>
        
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>
        
        </html>
        ';
    }

    public function accountEnabled($accountName, $link)
    {
        return '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        
        <head>
            <!--[if gte mso 9]>
        <xml>
          <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <!--[if !mso]><!-->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--<![endif]-->
            <title></title>
        
            <style type="text/css">
                @media only screen and (min-width: 570px) {
                    .u-row {
                        width: 550px !important;
                    }
        
                    .u-row .u-col {
                        vertical-align: top;
                    }
        
                    .u-row .u-col-100 {
                        width: 550px !important;
                    }
        
                }
        
                @media (max-width: 570px) {
                    .u-row-container {
                        max-width: 100% !important;
                        padding-left: 0px !important;
                        padding-right: 0px !important;
                    }
        
                    .u-row .u-col {
                        min-width: 320px !important;
                        max-width: 100% !important;
                        display: block !important;
                    }
        
                    .u-row {
                        width: calc(100% - 40px) !important;
                    }
        
                    .u-col {
                        width: 100% !important;
                    }
        
                    .u-col>div {
                        margin: 0 auto;
                    }
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                table,
                tr,
                td {
                    vertical-align: top;
                    border-collapse: collapse;
                }
        
                p {
                    margin: 0;
                }
        
                .ie-container table,
                .mso-container table {
                    table-layout: fixed;
                }
        
                * {
                    line-height: inherit;
                }
        
                a[x-apple-data-detectors="true"] {
                    color: inherit !important;
                    text-decoration: none !important;
                }
        
                table,
                td {
                    color: #000000;
                }

                #u_body {
                    height: 450px;
                }
        
                #u_body a {
                    color: #0000ee;
                    text-decoration: none;
                    margin-top: 10px;
                    margin-bottom: 10px;
                }

                #u_body a > span > span {
                    padding: 10px 15px;
                    border: 2px solid white;
                    border-radius: 50px;
                    background-color: #1daf5e;
                    color: #eee;
                }
        
                @media (max-width: 480px) {
                    #u_content_image_2 .v-src-width {
                        width: auto !important;
                    }
        
                    #u_content_image_2 .v-src-max-width {
                        max-width: 55% !important;
                    }
                }
            </style>
        
        
        
            <!--[if !mso]><!-->
            <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" type="text/css">
            <!--<![endif]-->
        
        </head>
        
        <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #afc6f0;color: #000000">
            <!--[if IE]><div class="ie-container"><![endif]-->
            <!--[if mso]><div class="mso-container"><![endif]-->
            <table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #afc6f0;width:100%" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr style="vertical-align: top">
                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #afc6f0;"><![endif]-->
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="padding-top: 15px; Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: transparent;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table id="u_content_image_2" style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:25px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;" align="center">
        
                                                                                <img align="center" border="0" src="cid:image-3.png" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 29%;max-width: 145px;" width="145" class="v-src-width v-src-max-width" />
        
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #3b71ca;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #3b71ca;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:15px 10px 10px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <h1 style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: book antiqua,palatino; font-size: 35px;">
                                                                        Welcome Back! ' . $accountName . '
                                                                    </h1>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 10px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <h3 style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: book antiqua,palatino; font-size: 18px;">
                                                                        <div>your account has been re-enabled</div>
                                                                    </h3>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #3b71ca;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #3b71ca;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 40px 20px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <div style="color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
                                                                    <p style="font-size: 14px; line-height: 140%;"></p>
                                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px;"></p>
                                                                        <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">We\'re happy to inform you that your account had been re-enabled and is ready for you to use again.</span></p>
                                                                        <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Thank you.</span></p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table style="font-family:"Lato",sans-serif; margin-top: 15px; margin-bottom: 15px;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <!--[if mso]><style>.v-button {background: transparent !important;}</style><![endif]-->
                                                                    <div align="center">
                                                                        <!--[if mso]><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:40px; v-text-anchor:middle; width:272px;" arcsize="100%"  strokecolor="#ffffff" strokeweight="3px" fillcolor="#3b71ca"><w:anchorlock/><center style="color:#ffffff;font-family:"Lato",sans-serif;"><![endif]-->
                                                                        <a href="' . $link . '" target="_blank" class="v-button" style="box-sizing: border-box;display: inline-block;font-family:"Lato",sans-serif;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #ffffff; background-color: #3b71ca; border-radius: 40px;-webkit-border-radius: 40px; -moz-border-radius: 40px; width:auto; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;border-top-width: 3px; border-top-style: solid; border-top-color: #ffffff; border-left-width: 3px; border-left-style: solid; border-left-color: #ffffff; border-right-width: 3px; border-right-style: solid; border-right-color: #ffffff; border-bottom-width: 3px; border-bottom-style: solid; border-bottom-color: #ffffff;">
                                                                            <span style="display:block;padding:10px 30px; margin-top: 15px; margin-bottom: 15px;line-height:120%;"><span style="font-size: 16px; line-height: 19.2px; font-family: Lato, sans-serif;">Click here to Login</span></span>
                                                                        </a>
                                                                        <!--[if mso]></center></v:roundrect><![endif]-->
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        

                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #ffffff;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 15px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <div style="color: #7e8c8d; line-height: 100%; text-align: center; word-wrap: break-word;">
                                                                        <p style="font-size: 14px; line-height: 100%;">© 2022</p>
                                                                        <p style="font-size: 14px; line-height: 100%;"><span style="font-size: 10px; line-height: 10px;">CONFIDENTIALITY NOTICE: The contents of this email are confidential and privileged and is intended for the exclusive use of the original recipient. If you are not the intended recipient, please notify the sender immediately and do not disclose the contents to anyone and make copies thereof.</span></p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
        
                                        </div>
                                    </div>
                                </div>
        
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>
        
        </html>
        ';
    }

    public function fileShared($accountName, $link, $ekey, $file)
    {
        return '
        <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        
        <head>
            <!--[if gte mso 9]>
        <xml>
          <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
          </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <!--[if !mso]><!-->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--<![endif]-->
            <title></title>
        
            <style type="text/css">
                @media only screen and (min-width: 570px) {
                    .u-row {
                        width: 550px !important;
                    }
        
                    .u-row .u-col {
                        vertical-align: top;
                    }
        
                    .u-row .u-col-100 {
                        width: 550px !important;
                    }
        
                }
        
                @media (max-width: 570px) {
                    .u-row-container {
                        max-width: 100% !important;
                        padding-left: 0px !important;
                        padding-right: 0px !important;
                    }
        
                    .u-row .u-col {
                        min-width: 320px !important;
                        max-width: 100% !important;
                        display: block !important;
                    }
        
                    .u-row {
                        width: calc(100% - 40px) !important;
                    }
        
                    .u-col {
                        width: 100% !important;
                    }
        
                    .u-col>div {
                        margin: 0 auto;
                    }
                }
        
                body {
                    margin: 0;
                    padding: 0;
                }
        
                table,
                tr,
                td {
                    vertical-align: top;
                    border-collapse: collapse;
                }
        
                p {
                    margin: 0;
                }
        
                .ie-container table,
                .mso-container table {
                    table-layout: fixed;
                }
        
                * {
                    line-height: inherit;
                }
        
                a[x-apple-data-detectors="true"] {
                    color: inherit !important;
                    text-decoration: none !important;
                }
        
                table,
                td {
                    color: #000000;
                }

                #u_body {
                    height: 450px;
                }
        
                #u_body a {
                    color: #0000ee;
                    text-decoration: none;
                    margin-top: 10px;
                    margin-bottom: 10px;
                }

                #u_body a > span > span {
                    padding: 10px 15px;
                    border: 2px solid white;
                    border-radius: 50px;
                    background-color: #1daf5e;
                    color: #eee;
                }
        
                @media (max-width: 480px) {
                    #u_content_image_2 .v-src-width {
                        width: auto !important;
                    }
        
                    #u_content_image_2 .v-src-max-width {
                        max-width: 55% !important;
                    }
                }
            </style>
        
        
        
            <!--[if !mso]><!-->
            <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" type="text/css">
            <!--<![endif]-->
        
        </head>
        
        <body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #afc6f0;color: #000000">
            <!--[if IE]><div class="ie-container"><![endif]-->
            <!--[if mso]><div class="mso-container"><![endif]-->
            <table id="u_body" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #afc6f0;width:100%" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr style="vertical-align: top">
                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #afc6f0;"><![endif]-->
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="padding-top: 15px; Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: transparent;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table id="u_content_image_2" style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:25px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;" align="center">
        
                                                                                <img align="center" border="0" src="cid:image-4.png" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 29%;max-width: 145px;" width="145" class="v-src-width v-src-max-width" />
        
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #3b71ca;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #3b71ca;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:15px 10px 10px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <h1 style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: book antiqua,palatino; font-size: 35px;">
                                                                        Hello! ' . $accountName . '
                                                                    </h1>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 10px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <h3 style="margin: 0px; color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-family: book antiqua,palatino; font-size: 18px;">
                                                                        <div>a file has been shared with you</div>
                                                                    </h3>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #3b71ca;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #3b71ca;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 40px 20px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <div style="color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;">
                                                                    <p style="font-size: 14px; line-height: 140%;">Filename: ' . $file . '</p>
                                                                    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px;">Key: ' . $ekey . '</p>
                                                                        <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Please use the key above to download the file and please make sure that you are the one who is currently logged-in.</span></p>
                                                                        <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 14px; line-height: 19.6px;">Thank you.</span></p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        

                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                    <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:550px;"><tr style="background-color: #ffffff;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="550" style="width: 550px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
                                            <div style="height: 100%;width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div style="height: 100%; padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table style="font-family:"Lato",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 15px;font-family:"Lato",sans-serif;" align="left">
        
                                                                    <div style="color: #7e8c8d; line-height: 100%; text-align: center; word-wrap: break-word;">
                                                                        <p style="font-size: 14px; line-height: 100%;">© 2022</p>
                                                                        <p style="font-size: 14px; line-height: 100%;"><span style="font-size: 10px; line-height: 10px;">CONFIDENTIALITY NOTICE: The contents of this email are confidential and privileged and is intended for the exclusive use of the original recipient. If you are not the intended recipient, please notify the sender immediately and do not disclose the contents to anyone and make copies thereof.</span></p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
        
                                        </div>
                                    </div>
                                </div>
        
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>
        
        </html>
        ';
    }
}
