Add-Type -AssemblyName System.speech
$speak = New-Object System.Speech.Synthesis.SpeechSynthesizer
$speak.SetOutputToDefaultAudioDevice()
$speak.Rate = 0.1;


$speak.Speak("My favorite color is blue.");
$speak.AddLexicon( ".\Blue.pls", "application/pls+xml");
$speak.Speak("Hi Beytula How are you?");

