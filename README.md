# COMP310P_GroupA

## Cookies:

| Cookie Name   | Contents    | Allowed Values | Expiry Time |
| :----------| :---------- | :---------- | :-----------| :------------- |
| username  | Current user's username | valid username | 15 minutes, refreshed every time a new page is visited |
| adminPriveleges | Current user's adminPriveleges | True | 15 minutes, refreshed every time a new page is visited |
| skippedInterests | Whether the user has skipped the select interests page | True | 24 hours from skipping the interests page |

## Changes to sql database:

#### 31st Oct
* Changed admin_priveleges to be 0 by default
