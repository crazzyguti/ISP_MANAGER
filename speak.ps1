Add-Type -AssemblyName System.Speech
$SpeechSynthesizer = New-Object -TypeName System.Speech.Synthesis.SpeechSynthesizer
$SpeechSynthesizer.Speak('Hello, World!');



$Timer = New-Object Timers.Timer
$Timer.Interval = 500
$Timer.Enabled = $True
$objectEventArgs = @{
    InputObject = $Timer
    EventName = 'Elapsed'
    SourceIdentifier = 'Timer.Random'
    Action = {$Random = Get-Random -Min 0 -Max 100}
}
$Job = Register-ObjectEvent @objectEventArgs
$Job | Format-List -Property *