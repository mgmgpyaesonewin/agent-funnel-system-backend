<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie">
<![endif]-->

<!--[if !IE]>
<html style="margin: 0;padding: 0;" xmlns="http://www.w3.org/1999/xhtml">
<![endif]-->
@include('email.partials.htmlheader')

<body class="full-padding" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;">

    <table class="wrapper"
        style="border-collapse: collapse;table-layout: fixed;min-width: 320px;width: 100%;background-color: #f5f7fa;"
        cellpadding="0" cellspacing="0" role="presentation">
        <tbody>
            <tr>
                <td>
                    <!-- Logo -->
                    @include('email.partials.logo')

                    <div role="section">
                        <div class="layout one-col fixed-width"
                            style="margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);">

                            <div class="layout one-col fixed-width"
                                style="Margin: 0 auto;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);">
                                <div class="layout__inner"
                                    style="border-collapse: collapse;display: table;width: 100%;background-color: #ffffff;">

                                    <div class="column"
                                        style='text-align: left;color: #60666d;font-size: 14px;line-height: 21px;font-family: "Open Sans",sans-serif;max-width: 600px;min-width: 320px; width: 320px;width: calc(28000% - 167400px);'>

                                        <div style="Margin-left: 20px;Margin-right: 20px;Margin-top: 24px;">
                                            <div style="line-height:10px;font-size:1px">&nbsp;</div>
                                        </div>

                                        <div style="margin-left: 20px;Margin-right: 20px;Margin-bottom: 24px;">

                                            @yield('main-content')
                                            @yield('action-trouble')

                                        </div>

                                        <!-- Footer -->
                                        @include('email.partials.footer')

                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>


    <div id="fb-root"></div>

</body>

</html>