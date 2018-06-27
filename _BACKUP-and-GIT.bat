set source="E:\Sync\OSPanel\domains\word.press\wp-content\themes\Rustam\"
set destination="E:\Sync\Google\Backup"
set passwd=""

set dd=%DATE:~0,2%
set mm=%DATE:~3,2%
set yyyy=%DATE:~6,4%

set h=%TIME:~0,2%
if "%h:~0,1%" == " " set h=0%h:~1,1%
set m=%TIME:~3,2%
set s=%TIME:~6,2%

set qdate=%dd%-%mm%-%yyyy%
set qtime=%dd%-%mm%-%yyyy%_%h%-%m%-%s%

echo time - %qtime%

"C:\Program Files\7-Zip\7z.exe" a -tzip -ssw -mx0 -r0 %destination%\%qdate%\%qtime%.zip %source%

cd E:\Sync\OSPanel\domains\wordpress\wp-content\themes\Rustam
git add .
git commit -v
git pull
git push
git pull