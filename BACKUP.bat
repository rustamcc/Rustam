@echo off

set source="E:\Sync\OSPanel\domains\wordpress\wp-content\themes\Rustam\"
set destination="E:\Sync\Google\Backup\"
set passwd=""

set dd=%DATE:~0,2%
set mm=%DATE:~3,2%
set yyyy=%DATE:~6,4%

set hour=%TIME:~0,2%
set minute=%TIME:~3,2%
set second=%TIME:~6,2%

set qdate=%dd%-%mm%-%yyyy%
set qtime=%hour%-%minute%-%second%

"C:\Program Files\7-Zip\7z.exe" a -tzip -ssw -mx0 -r0 %destination%\%qdate%\%qdate%_%qtime%.zip %source%