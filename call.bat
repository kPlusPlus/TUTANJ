@echo off
set _my_datet=%date%
rem @echo ┌───────────────────────────────────────────────────────────┐
rem echo -e "#BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBGB#"
rem echo -e "#GBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBGB#"
rem pause >null
ECHO  +---------------------------------------+

ECHO Start Measure %Time% %_my_datet%>> timer.txt
@rem php getbtc.php
ECHO MovieBloc
php getmbl.php
ECHO ETH
php geteth.php
ECHO TRX
php gettrx.php
ECHO AVAX
php getavax.php
ECHO Stop Measure  %Time% %_my_datet%>> timer.txt
ECHO  +---------------------------------------+ >> timer.txt
rem @echo └───────────────────────────────────────────────────────────┘
@rem php getariswap.php
@rem php getdoge.php

@rem php getshinu.php

@rem copy d:\*.csv K:\OneDrive\bitcoin\ /Y