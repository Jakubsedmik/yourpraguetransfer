<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang='cs' xml:lang='cs' xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta http-equiv='content-type' content='text/html; charset=utf-8' />
    <title>Payments protocol simple</title>
</head>
<body>

<h1>Payments protocol simple</h1>

<table border="1">
    <tr>
        <th>Example name</th>
        <th>Transaction creation mode</th>
        <th>Transaction check status mode</th>
    </tr>
    <tr>
        <td><a href="background_check_status/">background_check_status</a></td>
        <td style="background-color: #afa;">Form data are sent on background to the payments system.<br />User cannot modify payment parameters.</td>
        <td style="background-color: #afa;">Transaction status is checked before the confirmation page is displayed.<br />User cannot fake the result.</td>
    </tr>
    <tr>
        <td><a href="directly_check_status/">directly_check_status</a></td>
        <td style="background-color: #faa;">Form data are sent directly to the payments system.<br />User can modify payment parameters.</td>
        <td style="background-color: #afa;">Transaction status is checked before the confirmation page is displayed.<br />User cannot fake the result.</td>
    </tr>
    <tr>
        <td><a href="background_no_check/">background_no_check</a></td>
        <td style="background-color: #afa;">Form data are sent on background to the payments system.<br />User cannot modify payment parameters.</td>
        <td style="background-color: #faa;">Transaction status is not checked.<br />User can fake the result.</td>
    </tr>
    <tr>
        <td><a href="directly_no_check/">directly_no_check</a></td>
        <td style="background-color: #faa;">Form data are sent directly to the payments system.<br />User can modify payment parameters.</td>
        <td style="background-color: #faa;">Transaction status is not checked.<br />User can fake the result.</td>
    </tr>
</table>

</body>
</html>