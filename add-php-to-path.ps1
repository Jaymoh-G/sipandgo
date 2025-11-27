# Script to add PHP to PATH permanently
# Run this script as Administrator

$phpPath = "C:\wamp64\bin\php\php8.2.29"
$currentPath = [Environment]::GetEnvironmentVariable("Path", "User")

if ($currentPath -notlike "*$phpPath*") {
    [Environment]::SetEnvironmentVariable("Path", "$currentPath;$phpPath", "User")
    Write-Host "PHP has been added to your user PATH." -ForegroundColor Green
    Write-Host "Please restart your PowerShell terminal for changes to take effect." -ForegroundColor Yellow
} else {
    Write-Host "PHP is already in your PATH." -ForegroundColor Yellow
}

