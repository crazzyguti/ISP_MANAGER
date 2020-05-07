
$inputPath = "L:\ISP_MANAGER\public\down";

$listFiles = Get-ChildItem $inputPath\*;

$outPath = "down"

$html;

foreach ($file in $listFiles) {
    $ext = $file.extension;
    if ($ext -eq ".css"){
        $outFile = "$outPath/" + $file.name
        $html += "<link href='{{ asset('$outFile') }}' rel='stylesheet'>";
    }
}

$html | Out-File "test.blade.php";
