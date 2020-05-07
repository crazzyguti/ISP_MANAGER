You can try this:
# Create message
$Message = New-Object System.Net.Mail.MailMessage

# P1 address
$Message.From = New-Object System.Net.Mail.MailAddress ‘p1sender@domain.com’,’P1 Sender’

# P2 address
$Message.Sender = New-Object System.Net.Mail.MailAddress ‘p2sender@domain.com’,’P2 Sender’

$Message.To.Add(‘recipient@company.com’)
$Message.Subject = ‘Test senders’
$Message.Body = @’
Check out my sender names!

-I’m P1 or P2, but you’ll never know
‘@

# Send using SmtpClient
$SmtpClient = New-Object System.Net.Mail.SmtpClient ‘mailhost.domain.com’
$SmtpClient.Send($Message)
