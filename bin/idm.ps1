$baseUrl = "https://getbootstrapadmin.com/remark/material";

$json = Get-Content '.\assets.json' | ConvertFrom-Json

$downPath = "L:\ISP_MANAGER\bin\Down";

foreach ($script in $json.scripts){
    $fullUrl = "$baseUrl/$script"
    $filename = $fullUrl.Substring($fullUrl.LastIndexOf("/") + 1)
    Invoke-WebRequest -Uri $fullUrl -OutFile "$downPath\$filename"
}





