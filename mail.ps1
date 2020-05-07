
Param([string]$Computername = $env:COMPUTERNAME)

$head = @"
<Title>Process Report: $($computername.ToUpper())</Title>
<style>
Body {
font-family: "Tahoma", "Arial", "Helvetica", sans-serif;
background-color:#F0E68C;
}
table {
border-collapse:collapse;
width:60%
}
td {
font-size:12pt;
border:1px #0000FF solid;
padding:5px 5px 5px 5px;
}
th {
font-size:14pt;
text-align:left;
padding-top:5px;
padding-bottom:4px;
background-color:#0000FF;
color:#FFFFFF;
}
name tr{
color:#000000;
background-color:#0000FF;
}
</style>
"@

#convert output to html as a string
$html = Get-Process -ComputerName $Computername | Select-Object Handles, NPM, PM, WS, VM, ID, Name |
ConvertTo-Html -Head $head -PreContent "<h2>Process Report for $($Computername.ToUpper())</h2>" -PostContent "<h6> report run $(Get-Date)</h6>" |
Out-String
$groups = Get-Process -ComputerName $Computername | Select-Object Handles, NPM, PM, WS, VM, ID, Name | Group-Object Name
$groups

$Email =
"manyaka_88@abv.bg",
"manyaka_088@abv.bg",
"crazyguti@abv.bg",
"crazzyguti@abv.bg",
"manyaka0@gmail.com",
"manyaka_088@hotmail.com",
"manyaka_88@hotmail.com";

$mailServers = Get-Content  ".\mailServers.json" | ConvertFrom-Json;

$tto = $Email | Get-Random;

write-host $tto -backgroundColor "Yellow" -ForegroundColor "DarkRed";

$selectedMail = $mailServers.mails[0];

$gmailCred = Get-Credential -Credential $selectedMail.username
#send as mail body
$paramHash = @{
    To         = $tto
    from       = $selectedMail.email
    BodyAsHtml = $True
    Body       = $html
    Port       = $selectedMail.smtp.port;
    Subject    = "Daily Process Report for $Computername"
    SmtpServer = $selectedMail.smtp.server;
    #UseSsl = $True;
    Credential = $gmailCred
}

Send-MailMessage @paramHash



# 0ca81bb3238bcc
